<?php

/**
 *	Class Admin_helper.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/helper/controllers/Admin_helper.php
 */
class Admin_helper extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'helper';

	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required|callback_checkpSlug|max_length[200]'
		],
		[
			'field' => 'metaTitle',
			'label' => '标题',
			'rules' => 'trim|required|max_length[200]'
		],
		[
			'field' => 'metaKeyword',
			'label' => '关键词',
			'rules' => 'trim|required|max_length[200]'
		],
		[
			'field' => 'helper_content',
			'label' => '内容',
			'rules' => 'trim|required|htmlspecialchars'
		],
		[
			'field' => 'featured',
			'label' => '是否优先显示',
			'rules' => 'trim'
		],
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['helper_model', 'helper_categories_model']);
		$this->load->library('form_validation');
		$this->load->model('wysiwyg/wysiwyg_model');
	}

	/**
	 * The helper module index page.
	 *
	 * @return void
	 */
	public function index()
	{
		$this->template
			->title('')
			->build('admin/index');
	}

	/**
	 * Creating a Help Content.
	 *
	 * @param  int    $id 
	 * @return void
	 */
	public function create(int $id)
	{
		$categories = $this->helper_categories_model->get($id);
		if ( ! $categories )
		{
			$this->session->set_flashdata('error', '您的帮助类别不存在, 请选择帮助类别');
			redirect('content/helper');
		}

		if ( $post = $this->input->post() )
		{
			$this->form_validation->set_rules($this->rules);
			if ( $this->form_validation->run() )
			{
				$insert = [
					'metaTitle'		=> $post['metaTitle'],
					'adminId'		=> $this->currentUser->id,
					'slug'			=> $post['slug'],
					'categories'	=> $categories->id,
					'metaKeyword'	=> $post['metaKeyword'],
					'content'		=> $post['helper_content'],
					'featured'		=> isset($post['featured']) ? : 0,
					'createOn'		=> time(),
				];

				$this->helper_model->insert($insert);
				$this->session->set_flashdata('success', '您已经成功添加帮助');
				redirect('content/helper');
			}
		}

		$post = new stdClass;
		foreach ( $this->rules as $field )
		{
			$post->{$field['field']} = set_value($field['field']);
		}

		$wysiwyg = $this->wysiwyg_model->get('helper_content');
		$this->template
			->title('您正在创建', $categories->title, '帮助事件')
			->set('post', $post)
			->set('categories', $categories)
			->set('editerWysiwyg', $wysiwyg)
			->build('admin/post/index');
	}

	/**
	 * Selective create a classification.
	 *
	 * @return void
	 */
	public function change()
	{
		$result = $this->helper_categories_model->getCategories();
		$this->template
			->title('您期望添加到哪个分类')
			->set_layout(FALSE)
			->set('data', $result)
			->build('admin/helper/change');
	}

	/**
	 * Check slug.
	 *
	 * @return bool
	 */
	public function checkpSlug()
	{
		$slug = trim($this->input->post('slug'));
		$query = $this->db->where('slug', $slug)
			->get('helper');

		//	This news category name already exists
		if ( $query->num_rows() == 1 )
		{
			$this->form_validation->set_message('checkpSlug', sprintf('Slug: %s 已经存在!', $slug));
			return FALSE;
		}
		return TRUE;
	}
}