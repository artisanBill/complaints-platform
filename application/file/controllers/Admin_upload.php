<?php

class Admin_upload extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'file';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('files');
		$this->load->model(['folders_model', 'file_model']);
		$this->load->helper('number');
	}

	public function index(int $floderId = 0)
	{
		$this->template
			->set('folder', $this->folders_model->get($floderId))
			->append_metadata('<link type="text/css" rel="stylesheet" href="/resources/app/files-module/less/upload.css">')
			->build('admin/upload/upload');
	}

	public function recent()
	{
		$folderId = (int) $this->input->post('folder');

		echo json_encode(Files::upload($folderId));
	}

	public function preview()
	{
		$uploaded = $this->input->get('uploaded');

		$this->template
			->set('fileItems', $this->file_model->getFiles($uploaded))
			->set_layout(FALSE)
			->build('partials/list');
	}
}