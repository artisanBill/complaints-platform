<?php

class Admin_export extends Admin_Controller
{
	public $section = 'export';

	/**
	 * Constructor method
	 *
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('database');
	}

	/**
	 * Run a Query and display the results
	 *
	 * @access	public
	 * @return 	void
	 */
	public function index()
	{
		// Do SQL export
		if ($this->input->post())
		{
			$this->load->dbutil();

			// Filename
			if ( ! $filename = $this->input->post('filename'))
			{
				$filename = 'dbbackup_' . date('Ymd') . '.sql';
			}

			// Can't find a way around this.
			switch($this->input->post('newline'))
			{
				case 'n':
					$newline = "\n";
					break;
				case 'r':
					$newline = "\r";
					break;
				case 'r_n':
					$newline = "\r\n";
					break;
				default:
					$newline = "\n";
			}

			$backupPrefs = [
				'tables'	=> $this->input->post('actionTo'),
				'format'	=> $this->input->post('format'),
				'filename'	=> $filename,
				'addDrop'	=> $this->input->post('addDrop'),
				'addInsert'	=> $this->input->post('addInsert'),
				'newline'	=> $newline
			];

			$this->load->helper('download');
			force_download($filename.'.'.$this->input->post('format'), $this->dbutil->backup($backupPrefs));
		}

		$data = [];

		$this->load->helper(['form', 'number']);

		// Dropdown options
		$data['fileFormats'] = ['gzip' => 'gzip', 'zip' => 'zip', 'txt' => 'txt'];
		$data['trueFalse'] = [1 => lang('global.yes'), 0 => lang('global.no')];
		$data['newlines'] = ['n' => '\n', 'r' => '\r', 'r_n' => '\r\n'];

		// Get the tables
		$data['tables'] = $this->db->query('SHOW TABLE STATUS')->result();			

		$this->template->build('admin/exportOptions', $data);	
	}

}