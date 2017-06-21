<?php

class Member_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'member';

	/**
	 *	The table group name.
	 *
	 * @var string
	 */
	protected $group = 'member_group';

	/**
	 *	The table profile name.
	 *
	 * @var string
	 */
	protected $profile = 'member_profile';

	/**
	 * The users list
	 */
	protected $members = [];

	/**
	 * Update Account activation SMS.
	 *
	 * @param  int    $id
	 * @param  int    $code
	 * @return bool
	 */
	public function activeCode($id, $code)
	{
		return (bool) parent::update($id, ['activeCode' => $code]);
	}

	/**
	 * Update the user status.
	 * 
	 * @param  int     $id
	 * @param  integer $code
	 * @return bool
	 */
	public function userActive(int $id, $code = '')
	{
		return parent::update($id, ['active' => $code]);
	}

	/**
	 * Update current user single sign-on password.
	 *
	 * @param  int    $id
	 * @return bool
	 */
	public function userKey(int $id)
	{
		return parent::update($id, ['loginKey' => sha1(time())]);
	}

	/**
	 * Create a user first logs user.
	 *
	 * @param  string $mobile
	 * @return object
	 */
	public function login(string $mobile)
	{
		//	Check the user does not exist, create a new user
		if ( ! $this->userHasRegister($mobile) )
		{
			$this->createUser($mobile);
		}

		//	Query current user
		$query = $this->db->where('mobile', $mobile)
			->limit(1)
			->get($this->table)
			->row();
		return $query;
	}

	/**
	 * Check whether the user has registered.
	 *
	 * @param  string $mobile
	 * @return bool
	 */
	public function userHasRegister(string $mobile) : bool
	{
		$query = $this->db->where('mobile', $mobile)
			->limit(1)
			->get($this->table);

		return ($query && $query->num_rows() == 1) ? TRUE : FALSE;
	}

	/**
	 * get user
	 *
	 * @return object
	 */
	public function getUser( $id = 0 )
	{
		// Don't grab the user data again if we already have it
		if ( isset($this->members[$id]) )
		{
			return $this->members[$id];
		}

		$userIsCurrent = FALSE;

		//if no id was passed use the current users id
		if ( ! $id || is_bool($id) || is_null($id) )
		{
			$id = $this->session->userdata('memberMobile');
		}

		$this->db->where(sprintf('%s.%s', $this->table, 'mobile'), $id);

		$this->db->limit(1);

		$user = $this->getUsers();

		// Save for later use
		$this->members[$id] = $user;

		//the user disappeared for a moment?
		if ( ! $user && $userIsCurrent)
		{
			log_message('error', sprintf('End user session - reason: Could not find a user identified by %s:%s', $identity, $userIsCurrent[0]));

			$this->session->sess_destroy();
		}

		return $user;
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
	 * User does not exist? Creating a user
	 *
	 * @param  string $mobile
	 * @return bool
	 */
	protected function createUser(string $mobile)
	{
		if ( strlen($mobile) < 11 ) return FALSE;

		$this->db->trans_begin();
		$this->insert([
			'group'		=> 1,
			'mobile'	=> $mobile,
			'username'	=> $mobile,
			'createdOn'	=> time(),
			'ipAddress'	=> $this->input->ip_address(),
		]);

		// For the profiles tables.
		$id = $this->db->insert_id();

		// This is the profile data that we are not running through streams
		$extra = [
			'userId'			=> $id,
			'displayName'		=> 'New user',
			'gender'			=> 'male',
		];
		$this->db->insert('member_profile', $extra);
        if ( $this->db->trans_status() === FALSE )
        {
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', '帐号创建失败');
            return FALSE;
        }
        else
        {
            $this->db->trans_commit();
            return TRUE;
        }
	}

	/**
	 * User logout.
	 *
	 * @return void
	 */
	public function logout()
	{
		$this->session->unset_userdata('memberId');
		$this->session->unset_userdata('memberMobile');
		$this->session->unset_userdata('memberLoginKey');
	}

	/**
	 * Count all register user number
	 *
	 * @return integer
	 */
	public function countAll()
	{
		$this->db->where(['active'=> 1]);
		return parent::countAll();
	}

	/**
	 * Get by many
	 *
	 * @param array $params
	 *
	 * @return object
	 */
	public function getManyBy($params = [], $keywords = '')
	{
		if ( ! empty($params['group']) )
		{
			$this->db->where('member.group', $params['group']);
		}

		if ( ! empty($keywords) )
		{
			$this->db
				->like('member.mobile', trim($keywords))
				->or_like('member_profile.displayName', trim($keywords))
				->or_like('member_profile.firstName', trim($keywords))
				->or_like('member_profile.lastName', trim($keywords));
		}
		return $this->getAll();
	}
}