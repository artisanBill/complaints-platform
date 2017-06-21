<?php

use Boone\Outshine\Message\Mess;

class Public_user extends Site_Controller
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
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	/**
	 * The login in page index
	 *
	 * @return void
	 */
	public function index()
	{
		$item = $this->illegalChange();

		if ( isset($this->currentUser->id) )
		{
			$this->session->set_flashdata('success', '您已经登陆过，无需重新登陆');
			redirect(app_url('user', ''));
		}

		$this->template
			->title('登录')
			->set_layout('login')
			->append_metadata('<script type="text/javascript"> var VALIDATIONSMS = '.$item.';</script>')
			->build('public/login');
	}

	/**
	 * Verify ajax request verification data.
	 *
	 * @return void
	 */
	public function validation()
	{
		//	Check is ajax request.
		if( ! $this->input->post() ) show_404();

		//	Get user mobile number.
		$mobile = trim($this->input->post('mobile', TRUE));

		if ( ! $this->form_validation->cnmobile($mobile) )
		{
			$this->alertMessage('请正确填写手机号码!');
		}

		//	Get current usere.
		$user = $this->member_model->login($mobile);
		if ( ! $user->active )
		{
			$this->alertMessage('您的账号已被禁用, 请联系管理员!');
		}

		if ( $this->illegalChange() > 1 )
		{
			$this->alertMessage('请刷新浏览器!');
		}

		$rand = rand(10000, 99999);
		if ( $this->member_model->activeCode($user->id, $rand) )
		{
			$this->session->set_userdata('smsUser', time());

			//	Update the user last login time.
			$this->member_model->update($user->id, [
				'lastLogin'	=> time()
			]);

			//	Start send sms.
			Mess::sms($user->mobile, '您的登录验证码是:' . $rand . ' 请在10分钟内验证');
			$this->alertMessage('短信发送成功!', 'success', $user->mobile);
		}
		$this->alertMessage('短信发送失败!');
	}

	/**
	 * Well! User begins to landing ah! Once again, we verify the information bar.
	 *
	 * @return void
	 */
	public function execute()
	{
		//	Get user mobile number.
		$mobile = trim($this->input->post('mobile', TRUE));

		//	Get current usere.
		$user = $this->member_model->login($mobile);

		if ( ! $user )
		{
			$this->alertMessage('该用户不存在!');
		}

		if ( $this->input->post('smscode') != $user->activeCode )
		{
			$this->alertMessage('手机验证码错误!');
		}

		//	Check the SMS verification code has expired.
		if ( (time() - $user->lastLogin) >= 600 )
		{
			$this->alertMessage('短信验证码已过期!');
		}

		$this->session->unset_userdata('smsUser');

		//	Set current information.
		$this->session->set_userdata([
			'memberId'			=> $user->id,
			'memberMobile'		=> $user->mobile,
			'memberLoginKey'	=> $user->loginKey
		]);

		//	Clear user information SMS activation code
		$this->member_model->activeCode((int) $user->id, '');

		//	Update current user single sign-on password.
		$this->member_model->userKey((int) $user->id);
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'type'		=> 'success',
			'url'		=> app_url('user', ''),
			'message'	=> '您已经成功登陆!'
		]);
	}

	/**
	 * User logout.
	 *
	 * @return void
	 */
	public function logout()
	{
		$this->member_model->logout();
		redirect();
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

	/**
	 * Prevent developers manually modified
	 *
	 * @return int
	 */
	protected function illegalChange()
	{
		$smsUser = (int) $this->session->userdata('smsUser');

		$item = time() - $smsUser;

		if ( $item >= 120 || $smsUser < 1)
		{
			$this->session->unset_userdata('smsUser');
			$item = 0;
		}

		return $item;
	}

	/**
	 * Check whether the verification code
	 *
	 * @return boolean
	 */
	protected function isCaptcha()
	{
		$this->load->library('captcha', $this->session);
		$captcha = $this->captcha->check($this->input->post('captcha'));

		if ( ! $captcha )
		{
			$this->alertMessage('验证码错误!');
		}
	}

	/**
	 * Refresh Code.
	 *
	 * @return void
	 */
	public function captcha()
	{
		$this->load->library('captcha', $this->session);
		echo $this->captcha->entry();
	}
}