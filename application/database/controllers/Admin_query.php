<?php

class Admin_query extends Admin_Controller
{
	public $section = 'query';

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
		$data = [];

		$this->template->append_metadata('<style>#queryWindow {width: 95%; height: 120px; font-family: "Courier New", Courier, monospace;}</style>');

		$data['queryString'] 		= NULL;
		$data['mysqlResultError'] = NULL;
		$this->db->db_debug 		= FALSE;		
		$data['queryRun']			= FALSE;
		$data['results'] 			= [];
	
		if ($this->input->post('query') and $this->input->post('query') != '')
		{
			// Perform Query	
			$obj = $this->db->query($this->input->post('queryWindow'));
				
			$data['queryRun'] = true;

			// Save the query string to display it.
			$data['queryString'] = $this->input->post('queryWindow');
			
			if ( ! $obj)
			{
				$data['mysqlResultError'] = mysqli_error($this->db->db_connect());
			}
			else
			{
				$data['results'] = $obj->result_array();
			}
		}			

		$this->template->build('admin/query', $data);	
	}

}