<?php

/**
 *	Class Admin_teams
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */
class Admin_teams extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['member_model', 'member_teams_model']);
	}

	public function index()
	{
		$result = $this->db
			->order_by('isPass', 'desc')
			->get($this->member_teams_model->tableName())
			->result();

		$this->template
			->title('团队申请审批')
			->set('users', $result)
			->build('admin/team/index');
	}

	/**
	 * Description.
	 *
	 * @return void
	 */
	public function profile(int $userId)
	{
		$result = $this->member_teams_model->get($userId);
		echo '<pre>';
		print_r($result);
	}

	public function pass(int $userId)
	{
		$result = $this->member_teams_model->get($userId);
		if ( ! $result )
		{
			redirect('root/member/accessment');
		}

		if ( $result->isPass )
		{
			redirect('root/member/accessment');
		}

		// 	Load message model
		$this->load->model('message/message_model');

		$id = $result->userId;

		//	OK
		$this->member_teams_model->update($result->id, [
			'isPass' => 1
		]);

		//	Send site message
		$sendUserInfo = serialize((array)$this->currentUser);
		$this->message_model->send(
			$sendUserInfo,
			$id,
			'恭喜您！成功加入投诉网。',
			'团队审批',
			'<h1 class="text-center">'.$result->fullname.'</h1>
<h4 class="text-success">您好！恭喜您已成功加入投诉网团队。</h4>
<p>我们将有6个月对新加入团队的成员进行更多资质考核！您需要详细阅读以下内容。<br></p><ol><li>您需要积极帮助更多的人。</li><li>您需要有具备公益事业的精神。</li><li>您需要写3篇或以上文章。</li></ol><p><br></p>
<p class="text-right">该信件系统自动发送</p><p class="text-right">team@itousu.net</p>
<p><br></p>
<h4></h4>
<p><br></p>',
			TRUE,
			TRUE
		);

		$this->db->insert('blog_settings', [
			'userId'	=> $id,
			'blogName'	=> '您的博客名称',
			'domain'	=> time(),
			'createOn'	=> time()
		]);
		$this->session->set_flashdata('info', '您通过了 ' . $result->fullname);
		redirect('root/member/accessment');
	}
}