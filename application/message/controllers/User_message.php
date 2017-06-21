<?php
use Boone\Outshine\Support\FixedCryptor;
/**
 *	Class User_message.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */

class User_message extends User_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model(['message_model', 'users/user_model']);
	}

	public function index()
	{
		$message = $this->message_model->getManyBy([
			'acceptUser'	=> $this->currentUser->id
		]);

		$this->template
			->title('我的信箱')
			->set('message', $message)
			->build('users/index');
	}

	public function slugsssss($segment = '')
	{
		print_r($this->getSegmentInfo($segment));exit;
		$this->template
			->title('您正在给 发送信息')
			->build('users/form');
	}

	protected function getSegmentInfo($segment)
	{
		if ( ! strpos($segment, '@') )
		{
			//$this->session->set_flashdata('error', '我想知道你要干什么？');
			redirect();
		}

		$module = NULL;
		$urlSegment = NULL;

		if ( substr_count($segment, '@') == 2 )
		{
			list($module, $userId, $urlSegment) = explode('@', $segment);
		}

	}
}