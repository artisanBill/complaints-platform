<?php

class Admin_file extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'file';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->lang->load('file');
		$this->load->model(['folders_model', 'file_model']);
		$this->load->library('files');
		$this->load->helper('number');
	}

	public function index()
	{
		$data = $this->file_model->filterList();
		$this->template
			->title($this->moduleDetails['name'])
			->build('admin/file/index', $data);
	}

	/**
	 * View the file, if not picture? Also download the file to your local.
	 *
	 * @param  string $id
	 * @return void
	 */
	public function preview(string $id = '')
	{
		if ( ! $id )
		{
			show_404();
		}

		$query = $this->file_model->get($id);
		try {
			redirect(app_url('.', $query->path));
		}
		catch ( RuntimeException $e )
		{
			show_404();
		}
	}

	/**
	 * Delete files.
	 *
	 * @return void
	 */
	public function delete()
	{
		$deletes = $this->input->post('deletes');

		if ( empty($deletes) )
		{
			$this->session->set_flashdata('success', '您已经成功删除 0 (ROW) 文件');
			redirect('content/file');
		}

		$count = 0;
		foreach (  $deletes as $id )
		{
			$query = $this->file_model->get($id);
			if ( $query )
			{
				$count++;
				$this->file_model->delete($query->id);

				$file = BOONE . 'public' . $query->path;
				if ( file_exists($file) )
				{
					@unlink($file);
				}
			}
		}
		$this->session->set_flashdata('success', sprintf('您已经成功删除 %d (ROWS) 文件', $count));
		redirect('content/file');
	}
}