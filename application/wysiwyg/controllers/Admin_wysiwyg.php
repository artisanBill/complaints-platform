<?php

class Admin_wysiwyg extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'wysiwyg';

	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required|max_length[100]|callback_checkSlug'
		],
		[
			'field' => 'buttons[]',
			'label' => '按钮',
			'rules' => 'trim|required'
		],
		[
			'field' => 'plugins[]',
			'label' => '插件',
			'rules' => 'trim|required'
		],
	];

	/**
	 * Constructor method
	 * 
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('wysiwyg_model');
	}

	/**
	 * Wysiwyg Editor configuration items
	 *
	 * @return void
	 */
	public function index()
	{
		$this->template
			->title('Wysiwy富文本编辑器')
			->build('admin/index');
	}

	/**
	 * Create a wysiwyg editor configuration items.
	 *
	 * @return void
	 */
	public function create()
	{
		$this->config->load('redactor');
		if ( $_POST )
		{
			$post = $this->input->post();

			$this->form_validation->set_rules($this->rules);
			if ( $this->form_validation->run() )
			{
				$data = [
					'name'			=> (! isset($post['name']) || empty($post['name'])) ? $post['slug'] : $post['name'],
					'slug'			=> $post['slug'],
					'placeholder'	=> $post['placeholder'],
					'instructions'	=> $post['instructions'],
					'warning'		=> $post['warning'],
					'buttons'		=> json_encode($post['buttons']),
					'plugins'		=> json_encode($post['plugins']),
					'height'		=> $post['height'],
				];

				$this->wysiwyg_model->insert($data);
				$this->session->set_flashdata('success', '您已经成功创建(Wysiwy)配置.');
				redirect('setting/wysiwyg');
			}
		}

		$this->template
			->title('创建Wysiwy富文本编辑器配置')
			->set('configurations', $this->config->item('configurations')['default'])
			->set('height', $this->config->item('height'))
			->build('admin/form');
	}

	/**
	 * Check slug is exeist.
	 *
	 * @return bool
	 */
	public function checkSlug()
	{
		if ( ! $this->wysiwyg_model->get($this->input->post('slug')) )
		{
			return TRUE;
		}
		$this->form_validation->set_message('checkSlug', sprintf('Slug: %s 已经存在!', $this->input->post('slug')));
		return FALSE;
	}
}