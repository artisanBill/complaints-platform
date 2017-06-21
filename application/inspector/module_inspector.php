<?php

class Module_inspector extends Module
{

	public $version = '1.0.0';

	/**
	 * The information about the module
	 *
	 * @return array
	 */
	public function info()
	{
		return [
			'name'			=> [
				'cn'	=> '日志',
			],

			'description'	=> [
				'cn'	=> '系统错误日志报告.',
			],
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'user'			=> FALSE,
			'menu'			=> 'application',
		];
	}
	
	public function __construct()
	{
		parent::__construct();
	}

	public function install()
	{
		if ($this->install_tables(NULL))
		{
			return TRUE;
		}

		return false;
	}
	
	public function install_tables($tables)
	{
		$this->db->trans_start();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}
		return TRUE;
	}

	public function uninstall()
	{
		$this->db->trans_start();
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		} 
		return TRUE;
	}

	public function upgrade($old_version)
	{
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info You could include a file and return it here.
		return "No documentation has been added for this module.";
	}
}