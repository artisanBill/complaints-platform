<?php 

/**
 *	Class User_blog.php
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */
class User_blog extends User_Controller
{
	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'summary',
			'label' => 'Meta 描述',
			'rules' => 'trim|required|max_length[255]'
		],
		[
			'field' => 'metaTitle',
			'label' => '标题',
			'rules' => 'trim|required'
		],
		[
			'field' => 'tags',
			'label' => 'Meta 关键字',
			'rules' => 'trim|required'
		],
		[
			'field' => 'content',
			'label' => '内容',
			'rules' => 'trim|required',
		],
		[
			'field' => 'featured',
			'rules' => 'trim'
		],
		[
			'field' => 'enableComment',
			'rules' => 'trim'
		]
	];
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['blog_model', 'categories_model']);
		$this->load->library('form_validation');
	}

	public function index()
	{
		$categories = $this->categories_model->getManyBy(['userId' => $this->currentUser->id]);

		list($blogData, $pagination) = $this->blog_model->list(0);

		$this->template
			->title('我的博客')
			->set('categories', $categories)
			->set('data', $blogData)
			->set('pagination', $pagination)
			->set_metadata('itousu-token', sha1($this->currentUser->id))
			->build('create/index');
	}

	public function list(int $categoriesId = 0)
	{
		list($blogData, $pagination) = $this->blog_model->list($categoriesId);

		$this->template
			->set_layout(FALSE)
			->set('data', $blogData)
			->set('pagination', $pagination)
			->build('user/index');
	}

	public function editer(int $id, int $categories)
	{
		$validation = $this->blog_model->valdationIdInfo($id, $categories, $this->categories_model);
		if ( ! $validation )
		{
			return FALSE;
		}

		list($blogData, $categories) = $validation;
		unset($validation);

		$blogData->tags = unserialize($blogData->tags);
		$blogData->content = htmlspecialchars_decode($blogData->content);

		$this->template
			->set_layout(FALSE)
			->set('title', '您正在编辑文章 : "' . $blogData->metaTitle)
			->set('action', '/blog/update/' . $blogData->id)
			->set('blog', $blogData)
			->set('categories', $categories)
			->build('create/input');
	}

	/**
	 * Remove blog.
	 *
	 * @param  int    $id
	 * @param  int    $categories
	 * @return void
	 */
	public function remove(int $id, int $categories)
	{
		$validation = $this->blog_model->valdationIdInfo($id, $categories, $this->categories_model);
		if ( ! $validation )
		{
			$this->alertMessage('删除文章失败');
		}

		list($blogData, $categoriesData) = $validation;
		unset($validation);
		unset($categoriesData);

		$this->blog_model->delete($blogData->id);
		$this->db->where('id', $blogData->blogBodyId)
			 ->delete($this->db->dbprefix('blog_body'));

		$updateTags = $this->db->where('postId', $blogData->id)->get($this->db->dbprefix('blog_tags'))->result();

		foreach ( $updateTags as $tag )
		{
			$this->db->where('id', $tag->id)
			 ->delete($this->db->dbprefix('blog_tags'));
		}

		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'id'		=> $blogData->id,
			'type'		=> 'success',
			'message'	=> '您已经成功删除文章' . $blogData->metaTitle,
		]);
		exit;
	}

	public function update(int $blogId)
	{
		if ( ! $this->blog_model->get($blogId) )
		{
			return FALSE;
		}

		//  Illegal user requests data, returns error 404 page
        if ( $this->input->post('token') !== sha1($this->currentUser->id) && ! $this->input->is_ajax_request() )
        {
            return FALSE;
        }

        $this->db->where('userId', $this->currentUser->id);
		$categories = $this->categories_model->get($this->input->post('categories'));
		if ( ! $categories )
		{
			return FALSE;
		}

		$this->form_validation->set_rules($this->rules);
        if ( $this->form_validation->run() )
        {
            if ( $this->blog_model->updateExecute($this->input->post('categories'), $this->input->post(), $blogId))
            {
               exit(json_encode([
                    'type'    => 'success',
                    'message'   => sprintf('您的文章 "%s" 成功更新', $this->input->post('metaTitle'))
                ]));
            }
            exit(json_encode([
                'type'    => 'error',
                'message'   => '文章更新失败!'
            ]));
        }
        echo json_encode([
            'type'  => 'error',
            'message' => validation_errors(),
        ]);
	}

	public function add()
	{
		//  Illegal user requests data, returns error 404 page
        if ( $this->input->post('token') !== sha1($this->currentUser->id) && ! $this->input->is_ajax_request() )
        {
            return FALSE;
        }

        $this->db->where('userId', $this->currentUser->id);
		$categories = $this->categories_model->get($this->input->post('categories'));
		if ( ! $categories )
		{
			return FALSE;
		}

        $this->form_validation->set_rules($this->rules);
        if ( $this->form_validation->run() )
        {
            if ( $this->blog_model->create($this->input->post('categories'), $this->input->post()) )
            {
               exit(json_encode([
                    'type'    => 'success',
                    'message'   => '您已经成功创建文章.'
                ]));
            }
            exit(json_encode([
                'type'    => 'error',
                'message'   => '创建文章失败!'
            ]));
        }
        echo json_encode([
            'type'  => 'error',
            'message' => validation_errors(),
        ]);
	}

	/**
	 * Loader input blog page.
	 *
	 * @param  int $slugId [description]
	 * @return void
	 */
	public function loader(int $slugId)
	{
		$this->db->where('userId', $this->currentUser->id);
		$categories = $this->categories_model->get($slugId);

		if ( ! $categories )
		{
			return;
		}

		$blog = new stdClass;
		foreach ( $this->rules as $field )
		{
			$blog->{$field['field']} = set_value($field['field']);
		}
		$this->template
			->set('title', '您正在创建文集为 "' . $categories->name . ' "的文章')
			->set('action', '/blog/add')
			->set('categories', $categories)
			->set('blog', $blog)
			->set_layout(FALSE)
			->build('create/input');
	}

	/**
	 * User Authentication Information Form.
	 *
	 * @param  string $message
	 * @param  string $type
	 * @return void
	 */
	protected function alertMessage(string $message, string $type = 'error')
	{
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		echo json_encode([
			'type'		=> $type,
			'message'	=> $message,
		]);
		exit;
	}
}