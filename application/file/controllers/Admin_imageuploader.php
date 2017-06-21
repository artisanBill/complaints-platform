<?php

class Admin_imageuploader extends Admin_Controller
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('files');
		$this->load->model(['folders_model', 'file_model']);
		$this->load->helper('number');
	}

	/**
	 * When uploading a file, select the file upload directory.
	 *
	 * @return void
	 */
	public function index()
	{
		//	get folder data
		$folder = $this->folders_model->get(1);
		$this->template
			->set_layout(FALSE)
			->set('folderData', $folder)
			->build('uploaderfile/upload/index');
	}

	/**
	 * Start uploading files.
	 *
	 * @return void
	 */
	public function upload()
	{
		$folderId = (int) $this->input->post('folder');

		echo json_encode(Files::upload($folderId));
	}

	/**
	 * After successful upload image preview.
	 *
	 * @return void
	 */
	public function preview()
	{
		$uploaded = $this->input->get('uploaded');
		$this->template
			->set('fileItems', $this->file_model->getFiles($uploaded))
			->set_layout(FALSE)
			->build('uploaderfile/upload/list');
	}

	/**
	 * Ajax selected input.
	 *
	 * @return void
	 */
	public function selected()
	{
		$uploaded = $this->input->get('uploaded');
		$this->template
			->set('fileItem', $this->file_model->get($uploaded))
			->set_layout(FALSE)
			->build('uploaderfile/upload/selected');
	}

	/**
	 * Select the repository file.
	 *
	 * @return void
	 */
	public function choose()
	{
		$this->template
			->set('fileItems', $this->file_model->getManyBy('folderId', 1))
			->set_layout(FALSE)
			->build('uploaderfile/upload/choose');
	}
}