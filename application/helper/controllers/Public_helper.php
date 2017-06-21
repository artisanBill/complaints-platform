<?php

/**
 *	Class Public_helper.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */
class Public_helper extends Site_Controller
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['helper_model', 'helper_categories_model']);
	}

	/**
	 * Display all helper categories.
	 *
	 * @return void
	 */
	public function index()
	{
		$result = $this->helper_categories_model->getCategories();
		/*if ( ($userKeyword = $this->input->get('keyword')) )
		{
			$this->db->like('metaTitle', $userKeyword)
				->or_like('metaKeyword', $userKeyword);
		}*/
		$this->template
			->title('帮助中心')
			->set('helperData', $result)
			->build('public/index');
	}

	/**
	 * Display a list of complaints.
	 *
	 * @param  int    $slug
	 * @return void
	 */
	public function list(int $slug)
	{
		$categories = $this->helper_categories_model->getBy([
			'id'		=> $slug,
			'isDisplay'	=> TRUE
		]) OR show_404();

		$resultData = $this->db->select([
			'helper.slug',
			'helper.metaTitle',
			'helper.featured',
			'helper.usefulCount',
			'helper.uselessCount',
			'admin_users_profile.displayName'
		])
		->join('admin_users_profile', 'helper.adminId = admin_users_profile.userId', 'LEFT')
		->where('helper.categories', $categories->id)
		->get($this->helper_model->tableName())
		->result();

		$this->template
			->title($categories->title)
			->set_metadata('og:title', $categories->title . ' &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'honesty', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', $categories->keywords, 'og')
			->set_metadata('og:keywords', $categories->description, 'og')
			->set('resultData', $resultData)
			->set('categories', $categories)
			->build('public/list');
	}

	/**
	 * [content description]
	 * @param  string $slug [description]
	 * @return [type]       [description]
	 */
	public function content(string $slug)
	{
		$this->input->post('token') OR show_404();
		
		$result = $this->db->select('content')
			->where('slug', $slug)
			->get($this->helper_model->tableName())
			->row();
		echo ($result && $result->content) ? $result->content : '未找到相关帮助信息';
	}

	/**
	 * [page description]
	 *
	 * @param  string $segment [description]
	 * @return [type]          [description]
	 */
	public function page(string $segment)
	{
		$result = $this->db->where('slug', $segment)
			->get($this->helper_model->tableName())
			->row();

		if ( ! $result )
		{
			show_404();
		}

		$this->template
			->title($result->metaTitle)
			->set_metadata('og:title', $result->metaTitle . ' &raquo; 投诉网', 'og')
			->set_metadata('og:type', 'honesty', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', $result->metaKeyword, 'og')
			->set_metadata('og:keywords', $result->metaKeyword, 'og')
			->set('view', $result)
			->build('public/page');
	}
}