<?php

/**
 *	Class User_upload.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/application/file/controllers/User_upload.php
 */

class User_upload extends User_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('file');
		$this->load->model(['folders_model', 'file_model']);
		$this->load->library('files');
		$this->load->helper('number');
	}

	/**
	 * Editor File Uploader
	 *
	 * @return void
	 */
	public function index()
	{
		$this->template
			->set('folder', $this->folders_model->get(1))
			->set_layout(FALSE)
			->build('ajax/input');
	}

	/**
	 * Display pictures uploaded.
	 *
	 * @return void
	 */
	public function preview()
	{
		//	$_GET OR exit;

		$uploaded = $this->input->get('uploaded');

		$this->template
			->set('fileItems', $this->file_model->getFiles($uploaded))
			->set_layout(FALSE)
			->build('ajax/uploadedList');
	}

	/**
	 * File Upload started.
	 *
	 * @return void
	 */
	public function execute()
	{
		$folderId = (int) $this->input->post('folder');

		echo json_encode(Files::upload($folderId));
	}

	/**
	 * After the list of files to upload presentation.
	 *
	 * @return void
	 */
	public function after()
	{
		$this->template
			->set_layout(FALSE)
			->set('viewFilter', TRUE)
			->set('isAjax', TRUE)
			->build('ajax/choose', $this->file_model->filterList());
	}

	/**
	 * User avatar upload.
	 *
	 * @return [type] [description]
	 */
	public function avatar()
	{
		if ( ! $_POST )
		{
			show_404();
		}
		$deleteFile = BOONE . 'public/' . $this->currentUser->avatar;
		if ( file_exists($deleteFile) )
		{
			@unlink($deleteFile);
		}

		$config['upload_path']		= './uploads/avatars/';
		$config['allowed_types']	= 'jpg|jpeg|bmp|png';
		$config['file_ext_tolower']	= TRUE;
		$config['max_size']			= 50;
		$config['max_width']		= 512;
		$config['max_height']		= 512;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ( $this->upload->do_upload('upload') )
		{
			$result = $this->upload->data();
			$onlineImg = 'uploads/avatars/' . $result['file_name'];
			$this->member_model->updateMany($this->currentUser->id, ['avatar'	=> $onlineImg]);
			$result['path'] = $onlineImg;
			echo json_encode($result);
			exit;
		}
		
		echo json_encode($this->upload->display_errors());
	}

	public function reality()
	{
		if ( ! $_POST )
		{
			show_404();
		}

		$config['upload_path']		= './uploads/reality/';
		$config['allowed_types']	= 'jpg|jpeg|bmp|png';
		$config['file_ext_tolower']	= TRUE;
		$config['max_size']			= 100;
		$config['min_width']		= 340;
		$config['max_width']		= 340;
		$config['max_height']		= 420;
		$config['min_height']		= 420;
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ( $this->upload->do_upload('upload') )
		{
			$result = $this->upload->data();
			$onlineImg = '/uploads/reality/' . $result['file_name'];
			$result['path'] = $onlineImg;
			echo json_encode($result);
			exit;
		}
		
		echo json_encode($this->upload->display_errors());
	}
}