<?php

class Admin_tables extends AdminController
{
	public $section = 'tables';

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
	 * Show Tables
	 *
	 * With option to repair/optimize.
	 * 
	 * @return 	void
	 */
	public function index()
	{
		if ($this->input->post('repair'))
		{
			$this->_perform_operation('repair');
		}
		elseif ($this->input->post('optimize'))
		{
			$this->_perform_operation('optimize');
		}

		$data = [];
	
		$this->load->helper(['form', 'number']);
	
		$data['tables'] = $this->db->query('SHOW TABLE STATUS')->result();	
				
		$this->template->build('admin/listTables', $data);
	}

	/**
	 * View a Table
	 *
	 * @return 	void
	 */
	public function table($tableName = '')
	{
		$this->load->helper('number');

		// Is this a core table?
		if ($is_core = substr($tableName, 0, 5) == 'brocade_')
		{
			$this->db->set_dbprefix('brocade_');
		}
		
		if ( ! $tableName or ! $this->db->table_exists($tableName))
		{
			show_error(lang('brocade.invalidTableName'));
		}
			// Get field data
		$data = [];

		$data['fields'] = $this->db->field_data($tableName);
		$data['tableName'] = $tableName;

		//if ($is_core) $this->db->set_dbprefix(SITE_REF.'_');

		$this->template->build('admin/listTableStructure', $data);
	}
	
	/**
	 * Perform an operation (repair or optimize)
	 *
	 * @access	private
	 * @return 	void
	 */
	private function _perform_operation($type)
	{
		// Easy out if there ain't no data
		if ( ! $this->input->post('action_to'))
		{	
			$this->session->set_flashdata('notice', lang('brocade.mustSelectTable'));
			redirect('database/tables');
		}
		// Repair/Optimize the Tables
		if ($type == 'repair')
		{
			$action = 'repair_table';
			$lang 	= 'repaired';
		}
		else
		{
			$action = 'optimizeTable';
			$lang	= 'optimized';
		}
		
		$this->load->dbutil();
		
		$outcome = lang('brocade.followingTables')." $lang:\n\n";
	
		foreach ($this->input->post('actionTo') as $table)
		{
			$outcome .= $table.' (';	
		
			$this->dbutil->repair_table('tableName') ? $outcome .= lang('successLabel') : $outcome .= lang('brocade.failure');
			
			$outcome .= ")\n";
		}
		
		$this->session->set_flashdata('success', $outcome);
		redirect('database/tables');
	}

}