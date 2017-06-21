<?php

class Admin_categories extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'categories';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('post_categories_model', 'categories_model');
		$this->load->model('post_model');
	}

	/**
	 * The post module index page.
	 *
	 * @return void
	 */
	public function index()
	{
		$pagination = createPagination('content/post/categories', $this->categories_model->countAll());

		$this->db->limit($pagination['limit'], $pagination['offset']);
		$data = $this->categories_model->getAll();
		$this->template
			->title($this->moduleDetails['name'])
			->set('views', $data)
			->set('pagination', $pagination)
			->build('admin/categories/index');
	}

	/**
	 * Start create category.
	 *
	 * @param int $id
	 * @return void
	 */
	public function create( int $id = 0)
	{
		if ( $_POST && ($insert = $this->validationForm($id)))
		{
			$this->categories_model->insert($insert);
			$redirect = 'content/post/categories';
			$message = '您已经成功创建类别';

			//	Whether to create the current article after creating the category success?
			if ( $this->input->post('action') === 'save-exit' )
			{
				$message = '您已经成功创建类别，您现在正在编辑文章.';
				$redirect = 'content/post/create/' . $this->db->insert_id();
			}

			$this->session->set_flashdata('success', $message);
			redirect($redirect);
		}

		$this->template
			->set_layout(FALSE)
			->set('uri', $id ? '/' . $id : '')
			->set('action', 'create')
			->set('title', '您期望创建什么类别?')
			->build('admin/categories/form');
	}

	/**
	 * Updated articles category information.
	 * 
	 * @param  int    $id 
	 * @return void
	 */
	public function edit(int $id)
	{
		$data = $this->categories_model->get($id);

		//	Check current data is exists.
		if ( ! $data )
		{
			exit('您当前的文章类别不存在');
		}

		//	Start update data.
		if ( $_POST && ($update = $this->validationForm($id)) )
		{
			$this->categories_model->update($id, $update);
			$this->session->set_flashdata('success', '您已经成功更新类别 : ' . $update['name']);
			redirect('content/post/categories');
		}

		$this->template
			->set_layout(FALSE)
			->set('uri', $id ? '/' . $id : '')
			->set('action', 'edit')
			->set('title', '您正在编辑类别 : ' . $data->name)
			->set('item', $data)
			->build('admin/categories/form');
	}

	/**
	 * Delete Article Categories.
	 *
	 * @return void
	 */
	public function delete()
	{
		if ( ! $_POST )
		{
			$this->session->set_flashdata('error', '非法访问!');
			redirect('content/post/categories');
		}

		$ids = $this->input->post('id');
		$count = 0;
		foreach ( $ids as $id )
		{
			$delete = $this->categories_model->get($id);

			if ( $delete )
			{
				$postCheck = $this->post_model->getBy(['categories' => $delete->id]);
				if ( ! $postCheck )
				{
					$count++;
					$this->categories_model->delete($delete->id);
				}
			}
		}
		$this->session->set_flashdata('success', sprintf('您已经成功删除 %d 条分类', $count));
		redirect('content/post/categories');
	}

	/**
	 * Select a category in which you need to create.
	 *
	 * @return void
	 */
	public function change()
	{
		$data = $this->categories_model->getManyBy(['parent' => 0]);
		$this->template
			->set_layout(FALSE)
			->set('data', $data)
			->build('admin/categories/change');
	}

	/**
	 * Check whether there is article category.
	 *
	 * @return bool
	 */
	public function categoriesNameCheck()
	{
		$name = trim($this->input->post('categoriesName'));
		$query = $this->db->where('name', $name)
			->get('posts_categories');

		//	This news category name already exists
		if ( $query->num_rows() >= 1 )
		{
			$this->session->set_flashdata('error', sprintf('您的类别: %s 已经存在!', $name));
			redirect('content/post/categories');
		}
		return TRUE;
	}

	/**
	 * Article category form validation.
	 *
	 * @param int $id
	 * @return array | bool
	 */
	protected function validationForm(int $id)
	{
		$form = [];

		$this->form_validation->set_rules('categoriesName', '类别名称', 'trim|required|callback_categoriesNameCheck');
		if ( $this->form_validation->run() )
		{
			$parent = $id;
			if ( $this->input->post('parentId') )
			{
				$parent = $this->input->post('parentId');
			}

			$form = [
				'parent'	=> $parent,
				'name'		=> $this->input->post('categoriesName'),
				'layout'	=> $this->input->post('layout')
			];
			return $form;
		}
		redirect('content/post/categories');
	}
}