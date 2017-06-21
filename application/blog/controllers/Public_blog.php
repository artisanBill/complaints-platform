<?php
use Boone\Outshine\Support\FixedCryptor;
/**
 *	Class Public_blog
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */

class Public_blog extends Site_Controller
{
	protected $cryptor;

	public function __construct()
	{
		parent::__construct();

		$this->cryptor = FixedCryptor::getInstance()
			->setPrivate('itousu..blog');//FixedCryptor::decrypt()

		$this->load->model(['blog_model', 'categories_model']);
	}

	/**
	 * Dispaly blog.
	 *
	 * @return void
	 */
	public function index()
	{
		list($blogData, $categories) = $this->blog_model->list(0, FALSE);

		$this->template
			->title('博客')
			->set_metadata('og:title', '博客 &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'blog', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', '投诉网团队博客，专业为消费者解决困惑！让更多的朋友学到更多的行业知识', 'og')
			->set('categories', $categories)
			->set('blogData', $blogData)
			->set('cryptor', $this->cryptor)
			->build('public/index');
	}

	public function center($domain, int $slugId = 0)
	{
		$this->template->userBlog = $main = $this->blog_setting_model->domainBy($domain);

		if ( ! $main )
		{
			show_404();
			exit;
		}

		//	Get blog categories
		$this->template->categoriesNav = $categories = $this->categories_model->getManyBy(['userId' => $main->userId]);

		list($blogData, $categories) = $this->blog_model->list($slugId, $main->userId);

		$this->template
			->title($main->blogName, '博客')
			->set_metadata('og:title', '博客 &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'blog', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', $main->bio, 'og')
			->set_layout('blogdefault')
			->set('categories', $categories)
			->set('blogData', $blogData)
			->set('cryptor', $this->cryptor)
			->build('center/index');

	}

	public function preview($domain, $slug)
	{
		$this->load->library('comments/comments');

		$this->template->userBlog = $main = $this->blog_setting_model->domainBy($domain);

		$result = $this->blog_model->profile($slug);

		if ( ! $main || ! $result )
		{
			show_404();
			exit;
		}

		//	Get blog categories
		$this->template->categoriesNav = $categories = $this->categories_model->getManyBy(['userId' => $main->userId]);

		$result->tags = unserialize($result->tags);

		$previewCount = $result->previewCount + 1;

		$this->blog_model->update($result->id, ['previewCount' => $previewCount]);

		$this->template
			->title($result->metaTitle, $main->blogName, '博客')
			->set_metadata('og:title', '博客 &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'blog', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', $result->summary, 'og')
			->set_layout('blogdefault')
			->set('view', $result)
			->set('commnets', $this->comments)
			->build('center/preview');
	}

	public function heart()
	{
		if ( ! $this->input->post('blogslug') || ! $this->currentUser->id )
		{
			return FALSE;
		}

		if ( $this->db->where('sendUser', $this->currentUser->id)->count_all_results($this->db->dbprefix('blog_heart_log')) )
		{
			return FALSE;
		}

		$result = $this->db->where('domain', $this->input->post('blogslug'))->get($this->blog_setting_model->tableName())->row();

		$this->db->insert($this->db->dbprefix('blog_heart_log'), [
			'sendUser'		=> $this->currentUser->id,
			'concernUser'	=> $result->userId,
			'createOn'		=> time()
		]);

		$count = $result->concern + 1;
		$this->blog_setting_model->update($result->id, ['concern' => $count]);

		$this->output->set_header('Content-Type: application/json; charset=utf-8');

		if ( $count > 500 )
		{
			$count = number_format($count / 1000, 2, '.', '') . ' K';
		}

		echo json_encode([
			'countnum'	=> $count,
			'blog'		=> $result->domain
		]);
	}
}