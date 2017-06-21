<?php

class Admin_folder extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'folder';

	/**
	 * Validation form rules.
	 *
	 * @var array
	 */
	protected $rules = [
		[
			'field' => 'slug',
			'label' => 'Slug',
			'rules' => 'trim|required'
		],
		[
			'field' => 'name',
			'label' => '文件夹',
			'rules' => 'trim|required'
		],
		[
			'field' => 'fileType',
			'label' => '文件格式',
			'rules' => 'trim|required'
		],
		[
			'field' => 'description',
			'label' => '描述',
			'rules' => 'trim'
		]
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('file');
		$this->load->model('folders_model');
		$this->load->helper('number');
		$this->load->library(['files', 'form_validation']);
	}

	public function index()
	{
		$folder = $this->folders_model->getAll();
		$this->template
			->title(lang('file.folder.title'))
			->set('folder', $folder)
			->build('admin/folder/index');
	}

	/**
	 * Create a file directory.
	 */
	public function create()
	{
		if ( $_POST )
		{
			$this->form_validation->set_rules($this->rules);
			if ( $this->form_validation->run() )
			{
				$post = $this->input->post();

				if ( Files::createFolder($post) )
				{
					Events::trigger('Folder_created', $result['data']);
					$this->session->set_flashdata('success', '您已经成功创建目录');
				}
				redirect('content/file/folder');
			}
		}

		$view = new stdClass();
		foreach ( $this->rules as $field )
		{
			$view->{$field['field']} = set_value($field['field']);
		}

		$this->template
			->title(lang('file.folder.create'))
			->set('input', $view)
			->build('admin/folder/input');
	}

	/**
	 * When uploading a file, select the file upload directory.
	 *
	 * @return void
	 */
	public function change()
	{
		$folder = $this->folders_model->getAll();
		$this->template
			->title('你喜欢上传到什么文件夹？')
			->set_layout(FALSE)
			->set('folder', $folder)
			->build('partials/modal/changeFolder');
	}
}