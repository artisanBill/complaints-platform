<?php

use Boone\Outshine\Support\FixedCryptor;

/**
 *	Class Public_account.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */
class Public_account extends Site_Controller
{
	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field'		=> 'mobile',
			'label'		=> '帐户',
			'rules'		=> 'trim|required|cnmobile',
			'errors'	=> [
				'required'	=> '请输入您的手机号码',
				'cnmobile'	=> '手机号码格式不正确'
			]
		],

		[
			'field' => 'card',
			'label' => '身份号码',
			'rules' => 'required|credit_exists|callback_checkUserInfo',
			'errors'	=> [
				'required'		=> '您的身份证号码不能为空',
				'credit_exists'	=> '您的身份证号码不正确'
			]
		],
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->template
			->title('更换手机号码')
			->set_layout('login')
			->build('public/change');
	}

	public function validation()
	{
		//validation_errors
		if ( ! $_POST )
		{
			$this->alertMessage('非法访问');
		}

		$this->form_validation->set_rules($this->rules);
		if ( $this->form_validation->run() )
		{
			$userData = $this->input->post();

			$result = $this->member_model->getBy(['mobile' => $userData['mobile']]);
		}
	}

	public function checkUserInfo()
	{
		$user = $this->db->select([
				'member.mobile',
				'member_profile.card',
			])
			->join('member_profile', 'member.id = member_profile.userId', 'left')
			->where([
				'mobile'	=> $this->input->post('mobile'),
				'card'		=> FixedCryptor::getInstance()->encrypt($this->input->post('card'))
			])
			->get($this->member_model->tableName());

		if ( $user && $user->num_rows() == 1 )
		{
			return TRUE;
		}

		$this->form_validation->set_message('checkUserInfo', '您的填写的信息不正确。');
		return FALSE;
	}

	/**
	 * User Authentication Information Form.
	 *
	 * @param  string $message
	 * @param  string $type
	 * @param  string $account
	 * @return void
	 */
	protected function alertMessage(string $message, string $type = 'error', $account = NULL)
	{
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'type'		=> $type,
			'account'	=> $account,
			'message'	=> $message,
		]);
		exit;
	}
}