<?php

class Admin extends Admin_Controller
{
	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'account',
            'label' => '帐户',
            'rules' => 'trim|required|valid_email'
		],
		[
			'field' => 'password',
            'label' => '密码',
            'rules' => 'trim|required'
		],
	];

	/**
	 *	Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	/**
	 *	The Admin login page.
	 *
	 * @return void
	 */
	public function index()
	{
		if ( isset($this->currentUser->id) )
		{
			$this->session->set_flashdata('success', '您已经登录.');
			redirect('home');
		}
		/*$this->user_model->register('developer@boone.red', 'sineadmin..', 'Boone', 1, [
			'displayName'	=> '决战天下',
			'firstName'		=> 'Boone',
			'lastName'		=> 'Li',
			'gender'		=> 'male',
		]);*/
		if ( $_POST )
		{
			$this->form_validation->set_rules($this->rules);
			if ( $this->form_validation->run() === TRUE && $this->user_model->login() )
			{
				$this->session->set_flashdata('success', '您已经成登录');

				// if they were trying to go someplace besides the dashboard we'll have stored it in the session
				$redirect = $this->session->userdata('admin_redirect');
				$this->session->unset_userdata('admin_redirect');

				$url = $redirect ? $redirect : 'home';

				redirect($url);
			}
		}

		//	The page background image.
		$backgrounImages = [
			'urban',
			'power-lines',
			'ravine'
		];
		$this->template
			->title('系统登陆')
			->set_layout('login')
			->set('loginBackImg', $backgrounImages[array_rand($backgrounImages)])
			->build('admin/login');
	}

	/**
	 * [logout description]
	 * @return [type] [description]
	 */
	public function logout()
	{
		$this->user_model->logout();
		$this->session->set_flashdata('success', '您已经成登出');
		redirect();
	}
}