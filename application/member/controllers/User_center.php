<?php
use Boone\Outshine\Support\FixedCryptor;
/**
 *	Class User_center.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/member/controllers/User_center.php
 */

class User_center extends User_Controller
{
	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		'base'	=> [
			[
				'field' => 'displayName',
				'label' => '昵称',
				'rules' => 'trim|required|callback_isNameExist',
				'errors'	=> [
					'required'	=> '您的昵称不能为空',
				]
			],
			[
				'field' => 'firstName',
				'label' => '贵姓',
				'rules' => 'required',
				'errors'	=> [
					'required'	=> '您的贵姓不能为空',
				]
			],
			[
				'field' => 'lastName',
				'label' => '名字',
				'rules' => 'required',
				'errors'	=> [
					'required'	=> '您的名字不能为空',
				]
			],
			[
				'field' => 'gender',
			],
			[
				'field' => 'gender',
			],
			[
				'field' => 'birthday',
			]
		],
		'details'	=> [
			[
				'field' => 'website',
				'label' => '网址',
				'rules' => 'valid_url',
				'errors'	=> [
					'valid_url'	=> '您的网址不正确',
				]
			],
			[
				'field' => 'bio',
				'label' => '说明',
				'rules' => 'htmlspecialchars',
			],
			[
				'field' => 'job',
			]
		],
		'security'	=> [
			[
				'field' => 'card',
				'label' => '身份号码',
				'rules' => 'required|credit_exists|callback_isCardExists',
				'errors'	=> [
					'required'		=> '您的身份证号码不能为空',
					'credit_exists'	=> '您的身份证号码不正确'
				]
			],
		]
	];

	protected $crypt;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		$this->crypt = FixedCryptor::getInstance();
	}

	public function index()
	{
		$this->template
			->title()
			->build('user/error');
	}

	/**
	 * Set up user profile.
	 *
	 * @return void
	 */
	public function profile()
	{
		//var_dump(FixedCryptor::getInstance()->decrypt('NITH4Rq9b//vChSKYg0750dXVXFHgqxL'));exit;
		//var_dump(FixedCryptor::getInstance()->encrypt('52240119901009643X'));exit;

		$this->template->userInfoArr = [
			''				=> '基本',
			'details'		=> '详细',
			'security'		=> '安全 * ',
		];

		$active = $this->input->get('change');

		$template = $active;

		if ( ! $active || ! array_key_exists($active, $this->template->userInfoArr) )
		{
			$active = '';
			$template = 'base';
		}

		$isPost = TRUE;
		if ( $_POST && $template === 'security' && ! $this->input->post('card') )
		{
			$isPost = FALSE;
			$this->session->set_flashdata('notice', '您已经通过实名认证. 请勿重新认证!');
		}

		if ( $_POST && $isPost)
		{
			$this->form_validation->set_rules($this->rules[$template]);
			if ( $this->form_validation->run() )
			{
				$post = [];
				foreach ( $this->rules[$template] as $item )
				{
					$post[$item['field']] = $this->input->post($item['field'], TRUE);
				}

				if ( $template === 'security' && isset($post['card']) )
				{
					
					$post['card'] = $this->crypt->encrypt($post['card']);
				}

				$profileUser = $this->db->select('id')
					->where('userId', $this->currentUser->id)
					->get('member_profile')
					->row();
				$result = $this->db->where('id', $profileUser->id)
					->set($post)
					->update('member_profile');

				$this->session->set_flashdata('success', '您的资料已经成功更新');
				redirect();
			}
		}

		//	Get the current status of the user ID
		$cardStatu = $this->currentUser->card ? $this->crypt->decrypt($this->currentUser->card) : '';

		$this->template
			->title('我的资料')
			->set('active', $active)
			->set('templateFile', $template)
			->set('cardStatu', $cardStatu)
			->build('user/index');
	}

	public function isCardExists()
	{
		$post = $this->crypt->encrypt($this->input->post('card'));
		$card = $this->db->select('card')
			->where('card', $post)
			->get('member_profile');

		if ( $card && $card->num_rows() == 1 )
		{
			$this->form_validation->set_message('isCardExists', 
				sprintf('您的身份证"%s"已经被别人占用，如身份证被占用！请立即申诉驳回', $this->input->post('card'))
			);
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Check whether the user nickname already exists.
	 *
	 * @return boolean
	 */
	public function isNameExist()
	{
		$user = $this->db->select('displayName')
			->where('displayName', $this->input->post('displayName'))
			->where_not_in('userId', $this->currentUser->id)
			->get('member_profile');

		if ( $user && $user->num_rows() == 1 )
		{
			$this->form_validation->set_message('isNameExist', sprintf('您的呢称"%s"已经被别人占用，请更换其它的呢称.', $this->input->post('displayName')));
			return FALSE;
		}
		return TRUE;
	}

}