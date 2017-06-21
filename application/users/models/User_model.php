<?php

class User_model extends Boone_Model
{
	/**
	 *	The table name.
	 *
	 * @var string
	 */
	protected $table = 'admin_users';

	/**
	 *	The table group name.
	 *
	 * @var string
	 */
	protected $group = 'admin_groups';

	/**
	 *	The table profile name.
	 *
	 * @var string
	 */
	protected $profile = 'admin_users_profile';

	/**
	 * The users list
	 */
	protected $users = [];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('date');

		$this->config->load('users/user');
	}

	/**
	 * Background Management System User Login.
	 *
	 * @return void
	 */
	public function login()
	{
		$account = $this->input->post($this->config->item('identity'));
		$password = $this->input->post('password');

		if (empty($account) || empty($password))
		{
			return FALSE;
		}

		$this->db->select('account, username, mobile, id, group')
			->where(sprintf('(account = "%1$s" OR mobile = "%1$s")', $this->db->escape_str($account)));

		$query = $this->db->where('active', 1)
					   ->limit(1)
					   ->get($this->table);

		$user = $query->row();

		if ($query->num_rows() == 1)
		{
			$password = $this->hashPasswordDb($user->id, $account . $password);

			if ($password === TRUE)
			{
				$this->setLogin($user);
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * User logout
	 *
	 * @return void
	 */
	public function logout()
	{
		$this->session->unset_userdata('account');
		$this->session->unset_userdata('group');
		$this->session->unset_userdata('userId');
		$this->session->unset_userdata('currentLogin');
	}

	/**
	 * Set User Login.
	 *
	 * @param object
	 */
	public function setLogin($user)
	{
		$loginKey = password_hash($this->input->ip_address(), PASSWORD_BCRYPT);
		$this->updateLastLogin($user->id, $loginKey);

		$groupRow = $this->db->select('name')->where('id', $user->group)->get('admin_groups')->row();

		$this->session->set_userdata([
			'account'			=> $user->account,
			//	kept for backwards compatibility
			'userId'			=> $user->id,
			'group'				=> $user->group,
			'currentLogin'		=> $loginKey
		]);
	}

	/**
	 * Update the last login time
	 *
	 * @param int $id
	 * @param string $loginKey
	 */
	public function updateLastLogin($id, $loginKey)
	{
		$this->update($id, [
			'lastLogin' => time(),
			'loginKey'=> $loginKey
		]);
	}

	/**
	 * Activate a newly created user
	 *
	 * @param int $id
	 * @return bool
	 */
	public function activate($id, int $active)
	{
		return parent::update($id, ['active' => $active]);
	}

	/**
	 * Count all group number
	 *
	 * @return integer
	 */
	public function countAll()
	{
		$this->db->where(['active'=> 1]);
		return parent::countAll();
	}

	/**
	 *	This function takes a password and validates it against an entry in the users table.
	 *
	 *	@return		void
	 */
	public function hashPasswordDb($id, $password)
	{
		if (empty($id) or empty($password))
		{
			return FALSE;
		}

	   $query = $this->db->select('password, salt')
			->where('id', $id)
			->limit(1)
			->get($this->table)
			->row();

		if ( ! $query )
		{
			return FALSE;
		}

		if ( password_verify(sha1($password) . $query->salt, $query->password) )
		{
			return TRUE;
		}

		$this->session->set_flashdata('notice', '您的登录密码错误');

		return FALSE;
	}

	/**
	 * get user
	 *
	 * @return object
	 */
	public function getUser($id = NULL)
	{
		// Don't grab the user data again if we already have it
		if (is_numeric($id) && isset($this->users[$id]))
		{
			return $this->users[$id];
		}

		$userIsCurrent = FALSE;

		//if no id was passed use the current users id
		if (is_null($id) || is_bool($id))
		{
			$identity = $this->config->item('identity');
			$id = $this->session->userdata($identity);

			// we'll use it bellow.. before returning
			$userIsCurrent = is_scalar($id) && $id
				? array($id)	// as bool is true, as array pass the value to log
				: ($id = NULL);	// as bool is FALSE and $id is null
		}
		//if a valid id was passed set identity
		elseif (is_scalar($id))
		{
			$identity = (is_numeric($id) OR empty($id)) ? 'id' : 'account';
		}
		//avoid a syntax error
		else
		{
			$identity = $this->config->item('identity');
			$id = NULL;
		}

		$this->db->where(sprintf('%s.%s', $this->table, $identity), $id);

		$this->db->limit(1);

		$user = $this->getUsers();

		// Save for later use
		$this->users[$id] = $user;

		//the user disappeared for a moment?
		if ( ! $user && $userIsCurrent)
		{
			log_message('error', sprintf('End user session - reason: Could not find a user identified by %s:%s', $identity, $userIsCurrent[0]));

			$this->session->sess_destroy();
		}

		return $user;
	}

	/**
	 * Get last join user
	 *
	 * @param  string
	 * @return string
	 */
	public function getLastJionUser($filter)
	{
		$result = $this->db->select('*')->order_by('id', 'DESC')->limit(1)->get($this->table)->row();
		return isset($result->$filter) ? $result->$filter : $filter;
	}

	/**
	 * Checks username
	 *
	 * @return bool
	 */
	public function usernameCheck($username = '')
	{
		if (empty($username))
		{
			return FALSE;
		}

		return $this->db->where('username', $username)->count_all_results($this->table) > 0;
	}

	/**
	 * Checks account
	 *
	 * @return bool
	 */
	public function emailCheck($account = '')
	{
		if (empty($account))
		{
			return FALSE;
		}

		return $this->db->where('account', $account)->count_all_results($this->table) > 0;
	}

	/**
	 * get users
	 *
	 * @return object Users
	 */
	public function getUsers($group = FALSE, $limit = NULL, $offset = NULL)
	{
		$this->db->select([
			$this->table . '.*',
			$this->group . '.name AS '. $this->db->protect_identifiers('groupName'),
			$this->group . '.description AS '. $this->db->protect_identifiers('groupDescription'),
		]);

		// Profile columns that are not under streams control, but we want to have access to anyways.
		$this->db->select($this->profile . '.*');

		$this->db->join($this->profile, $this->table . '.id = '.$this->profile . '.userId', 'left');
		$this->db->join($this->group, $this->table . '.group = '.$this->group . '.id', 'left');

		if (is_string($group))
		{
			$this->db->where($this->group . '.name', $group);
		}
		else if (is_array($group))
		{
			$this->db->where_in($this->group . '.name', $group);
		}

		if (isset($limit) && isset($offset))
		{
			$this->db->limit($limit, $offset);
		}
		
		return $this->db->get($this->table)->row();
	}

	/**
	 * Get a specified (single) user
	 *
	 * @param array $params
	 * @return object
	 */
	public function get($params)
	{
		if (isset($params['id']))
		{
			$this->db->where($this->table . '.id', $params['id']);
		}

		if (isset($params['account']))
		{
			$this->db->where('LOWER('.$this->db->dbprefix($this->table . '.account') . ')', strtolower($params['account']));
		}

		$this->db
			->select($this->profile . '.*, admin_users.*')
			->limit(1)
			->join($this->profile, $this->profile . '.userId = admin_users.id', 'left');

		return $this->db->get($this->table)->row();
	}


	/**
	 * Get by many
	 *
	 * @param array $params
	 * @param string $userKeyword
	 * @return object
	 */
	public function getManyByAll($params = [], $userKeyword = NULL)
	{
		if ( ! empty($params['active']))
		{
			$this->db->where('active', $params['active']);
		}

		if ( ! empty($params['group']))
		{
			$this->db->where('group', $params['group']);
		}

		if ( ! empty($userKeyword))
		{
			$this->db
				->like('admin_users.account', trim($userKeyword))
				->or_like('admin_users.username', trim($userKeyword))
				->or_like('admin_users.mobile', trim($userKeyword))
				->or_like('admin_users_profile.firstName', trim($userKeyword))
				->or_like('admin_users_profile.lastName', trim($userKeyword));
		}

		return $this->getAll();
	}

	/**
	 * Count by
	 *
	 * @param array $params
	 * @param string $userKeyword
	 * @return int
	 */
	public function countBy($params = [], $userKeyword = NULL)
	{
		$this->db->from($this->table)
			->join('admin_users_profile', 'admin_users.id = admin_users_profile.userId', 'left')
			->join('admin_groups', 'admin_users.group = admin_groups.id', 'left');

		if ( ! empty($params['active']))
		{
			$this->db->where('admin_users.active', $params['active']);
		}
		if ( ! empty($params['group']))
		{
			$this->db->where('group', $params['group']);
		}

		if ( ! empty($userKeyword))
		{
			$this->db
				->like('admin_users.username', trim($userKeyword))
				->or_like('admin_users.account', trim($userKeyword))
				->or_like('admin_users.mobile', trim($userKeyword))
				->or_like('admin_users_profile.firstName', trim($userKeyword))
				->or_like('admin_users_profile.lastName', trim($userKeyword));
		}

		return $this->db->count_all_results();
	}

	/**
	 * Deactivate
	 *
	 * @return void
	 * @author Mathew
	 */
	public function deactivate($id = 0)
	{
		if (empty($id))
		{
			return FALSE;
		}

		$activationCode = sha1(md5(microtime()));
		$this->activationCode = $activationCode;

		$data = [
			'activationCode' => $activationCode,
			'active' => 0
		];

		$this->db->update($this->table, $data, ['id' => $id]);

		return $this->db->affected_rows() == 1;
	}

	/**
	 * deleteUser
	 *
	 * @return bool
	 * @author Phil Sturgeon
	 */
	public function deleteUser($id)
	{
		$this->db->trans_begin();

		$this->db->delete($this->profile, ['userId' => $id]);
		$this->db->delete($this->table, ['id' => $id]);

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}

		$this->db->trans_commit();
		return true;
	}

	/**
	 * update user
	 *
	 * @return bool
	 * @author Phil Sturgeon
	 */
	public function updateUser($id, $data, $profile_data)
	{
		$user = $this->getUser($id)->row();

		$this->db->trans_begin();

		if (array_key_exists('account', $data) && $this->identity_check($data['account']) && $user->account !== $data['account'])
		{
			$this->db->trans_rollback();
			$this->ion_auth->set_error('accountCreationDuplicateAccount');
			return FALSE;
		}

		// Get the row id for the profile. It's probably the same as the userId but not necessarily.
		$profile = $this->db->limit(1)->where('userId', $id)->get($this->tables['meta'])->row();
		if ( ! $profile) return FALSE;

		// Special provision for our non-stream controlled fields
		$profile_parsed_data['username'] = (array_key_exists('username', $profile_data)) ? $profile_data['username'] : $profile->username;
		$profile_parsed_data['updatedOn']	= now();

		// Hey look at me I'm Phil Sturgeon I'm using transactions I'm so fancy!
		$this->db->where($this->meta_join, $id);
		$this->db->set($profile_parsed_data);
		$this->db->update($this->tables['meta']);

		if (array_key_exists('username', $data) || array_key_exists('password', $data) || array_key_exists('email', $data) || array_key_exists('group', $data))
		{
			if (array_key_exists('password', $data))
			{
				$data['password'] = $this->hashPassword($data['password'], $user->salt);
			}

			$this->db->update($this->table, $data, ['id' => $id]);
		}

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return FALSE;
		}

		$this->db->trans_commit();
		return true;
	}

	/**
	 * register
	 *
	 * @return bool
	 */
	public function register($account, $password, $username, $group, $additionalData = [])
	{
		$this->db->trans_begin();
		if ($this->emailCheck($account))
		{
			$this->session->set_flashdata('error', 'accountCreationDuplicateAccount');
			return FALSE;
		}

		// If username is taken, use username1 or username2, etc.
		if ( empty($username) )
		{
			$originalUsername = list($username) = explode('@', $account);
			for($i = 0; $this->usernameCheck($username); $i++)
			{
				if($i > 0)
				{
					$username = $originalUsername . $i;
				}
			}
		}

		// If the group id does not exist, get it via the group name. 
		$group = ($group = $this->db->select('id')
			->where('id', $group)
			->get($this->group)
			->row()) ? $group->id: 0;
		if ( ! $group )
		{
			show_error('Your error');
			return FALSE;
		}

		// IP Address
		$ipAddress = $this->input->ip_address();

		// Get password and salt
		$privateUser = $this->cratePassword($account . $password);
		$salt = $privateUser['salt'];
		$password = $privateUser['password'];

		// Users table.
		$dataAccount = [
			'username'		=> $username,
			'password'		=> $password,
			'salt'			=> $salt,
			'account'		=> $account,
			'group'			=> $group,
			'ipAddress'		=> $ipAddress,
			'createdOn'		=> now(),
		];
		$this->insert($dataAccount);

		// For the profiles tables.
		$id = $this->db->insert_id();

		// This is the profile data that we are not running through streams
		$extra = [
			'userId'			=> $id,
		];

		$this->db->insert($this->profile, $extra + $additionalData);
        if ( $this->db->trans_status() === FALSE )
        {
            $this->db->trans_rollback();
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
	}

	/**
	 * Create password
	 *
	 * @param  string $password
	 * @return array
	 */
	public function cratePassword(string $password)
	{
		$salt = substr(md5(uniqid(rand(), TRUE)), 0, 8);
		$password =  password_hash(sha1($password) . $salt, PASSWORD_BCRYPT);

		return ['password'=> $password, 'salt'=>$salt];
	}

	/**
	 * profile
	 *
	 * @return void
	 */
	public function profile($isCode = FALSE)
	{
		$this->db->select([
			$this->table . '.*',
			$this->group . '.name AS '. $this->db->protect_identifiers('groups'),
			$this->group . '.description AS '. $this->db->protect_identifiers('admin_users_profile'),
			$this->profile . '.*',
		]);

		$this->db->join($this->profile, $this->table . '.id = ' . $this->profile . '.' . 'userId', 'left');
		$this->db->join($this->group, $this->table . '.group = ' . $this->group . '.id', 'left');

		if ($isCode)
		{
			$this->db->where($this->table . '.forgottenPasswordCode');
		}
		else
		{
			$this->db->where($this->table . '.account');
		}
		$this->db->limit(1);
		$i = $this->db->get($this->table);

		// @todo - run the profile fields through streams
		return ($i->num_rows() > 0) ? $i->row() : FALSE;
	}
}