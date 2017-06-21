<?php

class Admin_basic extends Admin_Controller
{
	public $section = 'database';

	/**
	 * Constructor method
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('database');
	}
	
	/**
	 * Show general table stats
	 *
	 */
	public function index()
	{
		// Get basic info
		$rawStats = explode('  ', mysqli_stat($this->db->db_connect()));

		$data = [];

		$data['stats'] = [];
		
		foreach ($rawStats as $stat)
		{
			$break = explode(':', $stat);
			
			$data['stats'][trim($break[0])] = 	trim($break[1]);		
		}
		// Get Processes	
		$this->load->helper('number');
	
		$data['processes'] = $this->db->query('SHOW PROCESSLIST')->result();
				
		$this->template->build('basic/index', $data);
	}

}