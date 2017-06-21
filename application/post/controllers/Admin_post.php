<?php

class Admin_post extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'post';

	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required|callback_checkpPostSlug|max_length[200]'
		],
		[
			'field' => 'summary',
			'label' => '概要',
			'rules' => 'trim|required|max_length[255]'
		],
		[
			'field' => 'metaTitle',
			'label' => '标题',
			'rules' => 'trim|required'
		],
		[
			'field' => 'metaKeyword',
			'rules' => 'trim'
		],
		[
			'field' => 'metaDescription',
			'label' => '描述',
			'rules' => 'trim|required',
		],
		[
			'field' => 'tag',
			'rules' => 'trim'
		],
		[
			'field' => 'image',
			'rules' => 'trim'
		],
		[
			'field' => 'post_content',
			'label' => '内容',
			'rules' => 'trim|required|htmlspecialchars',
		],
		[
			'field' => 'featured',
			'rules' => 'trim'
		],
		[
			'field' => 'status',
			'rules' => 'trim'
		],
		[
			'field' => 'enableComment',
			'rules' => 'trim'
		]
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation', 'wysiwyg/TextEditer']);
		$this->load->model('post_categories_model', 'categories_model');
		$this->load->model(['post_model', 'wysiwyg/wysiwyg_model']);
		//	Get wysiwyg configuration.
		$this->config->load('wysiwyg/redactor');
	}

	/**
	 * The post module index page.
	 *
	 * @return void
	 */
	public function index()
	{
		$baseWhere = [];

		if ( $this->input->post('categories') )
		{
			$baseWhere['categories'] = $this->input->post('categories');
		}

		if ( $this->input->post('status') )
		{
			$baseWhere['status'] = ($this->input->post('status') == 'on') ? 1 : 0;
		}

		$userKeyword = NULL;
		if ( $this->input->post('userKeyword') )
		{
			$userKeyword = $this->input->post('userKeyword');
		}

		//	Base Filtering Sort
		$orderBy = 'id';
		$sort = 'desc';
		$fontIcon = 'glyphicons-sorting';
		if ( $this->input->get('order_by') && $this->input->get('sort') )
		{
			$orderBy = $this->input->get('order_by');
			$sort = ($this->input->get('sort') === 'desc') ? 'asc' : 'desc';
			$fontIcon = ($this->input->get('sort') === 'desc') ? 
				'glyphicons-sort-by-attributes' : 
				'glyphicons-sort-by-attributes-alt';
		}

		//	Discover all categories
		$categoriesData = $this->categories_model->getAll();

		// Create pagination links
		$pagination = createPagination('content/post', $this->post_model->countBy($baseWhere, $userKeyword));
		$this->db
			->select([
				'posts.*',
				'admin_users_profile.displayName userDisplayName',
				'posts_body.metaKeyword as bodyMetaKeyword', 
				'posts_categories.name categoriesName'
			])
			->order_by($orderBy, $sort)
			->join('admin_users_profile', 'posts.userId = admin_users_profile.userId')
			->join('posts_body', 'posts_body.postId = posts.id')
			->join('posts_categories', 'posts_categories.id = posts.categories')
			->limit($pagination['limit'], $pagination['offset']);

		$postData = $this->post_model->getManyByAll($baseWhere, $userKeyword);

		$this->template
			->title($this->moduleDetails['name'])
			->set('categoriesData', $categoriesData)
			->set('postData', $postData)
			->set('pagination', $pagination)
			->set('sortPost', $sort)
			->set('orderBy', $orderBy)
			->set('fontIcon', $fontIcon)
			->build('admin/post/index');
	}

	/**
	 * Create post content.
	 *
	 * @param  int $id
	 * @return void
	 */
	public function create(int $id)
	{
		$categories = $this->categories_model->get($id);
		if ( ! $categories )
		{
			$this->session->set_falshdata('error', '您要创建的文章类别不存在');
			redirect('content/post');
		}

		//	Start create post ?
		if ( ($post = $this->input->post()) )
		{
			$this->form_validation->set_rules($this->rules);
			if ( $this->form_validation->run() )
			{
				$this->post_model->create($categories->id, $post);
				$this->session->set_flashdata('success', '您已经成功创建文章');
				redirect('content/post');
			}
		}

		$inputSlug = new stdClass;
		foreach ( $this->rules as $field )
		{
			$inputSlug->{$field['field']} = set_value($field['field']);
		}

		//	Get textmate for wysiwyg
		$wysiwyg = $this->wysiwyg_model->get('post_content');

		$this->template
			->title(sprintf('您正在创建 %s 文章', $categories->name))
			->set('categories',$categories)
			->set('post', $inputSlug)
			->set('editerWysiwyg', $wysiwyg)
			->build('admin/form/index');
	}

	/**
	 * Remove one or more post.
	 *
	 * @return void
	 */
	public function delete()
	{
		$deletes = $this->input->post('id');
		$count = 0;
		foreach ( $deletes as $id )
		{
			$query = $this->db
				->select([
					'posts.id',
					'posts_body.id postsBodyId',
				])
				->join('posts_body', 'posts.id = posts_body.postId')
				->where('posts.id', $id)
				->get('posts')
				->row();
			if ( $query )
			{
				$count++;

				//	Delete post
				$this->post_model->delete($query->id);

				//	Delete post body
				$this->db->where('id', $query->postsBodyId)
					->delete('posts_body');
			}
		}
		$this->session->set_flashdata('success', sprintf('您已经成功删除 %d (ROW) 文章', $count));
		redirect('content/post');
	}

	/**
	 * Check slug.
	 *
	 * @return bool
	 */
	public function checkpPostSlug()
	{
		$slug = trim($this->input->post('slug'));
		$query = $this->db->where('slug', $slug)
			->get('posts');

		//	This news category name already exists
		if ( $query->num_rows() == 1 )
		{
			$this->form_validation->set_message('checkpPostSlug', sprintf('Slug: %s 已经存在!', $slug));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Select the need to create Article Categories
	 *
	 * @return void
	 */
	public function change()
	{
		$data = $this->categories_model->getCategories();
		$this->template
			->set_layout(FALSE)
			->set('data', $data)
			->build('admin/post/change');
	}
}