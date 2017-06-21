<?php

class User_Controller extends Protected_Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		//	Check user is login ?
		//	Check if the user is already logged in elsewhere
		if ( ! $this->currentUser )
		{
			redirect(app_url('.', 'login'));
		}

		//	User top navigation
		$userMenu = [
			'我的主页'	=> '',
			'我的投诉'	=> 'honesty',
			'我要求助'	=> 'expect-help',
			//'博客'		=> 'blog',
			//'点赞诚信'	=> 'like-honesty',
		];

		if ( $this->member_teams_model->checkActive() )
		{
			$userMenu['我的博客'] = 'blog';
			if ( 'user_teams' === $this->controller )
			{
				$this->session->set_flashdata('notice', '您已是团队成员，请勿重新申请!');
				redirect();
			}
			$this->load->model('blog/blog_setting_model');
		}
		else
		{
			$accessArray = [
				'user_blog',
				'user_categories',
				'user_setting',
			];
			if ( in_array($this->controller, $accessArray) )
			{
				$this->session->set_flashdata('notice', '抱歉!博客只对投诉网团队开放!');
				redirect();
			}
		}

		$this->template->userNavigation = $userMenu;

		//	Check whether the user information completed
		if ( ! $this->currentUser->card )
		{
			$this->session->set_flashdata('error', '欢迎您注册投诉网! 请及时完善您的个人信息. <a href="/profile" class="btn btn-success btn-sm">立即完善</a>');
		}

		$this->template
			->enable_parser(FALSE)
			->set_theme('itousu')
			->set_layout('usercenter');
	}

	protected function checkUserInfo()
	{
		if ( ! $this->currentUser->card )
		{
			$this->session->set_flashdata('warning', '请先完善个人信息');
			redirect('user', 'profile');
		}
	}

}