<?php

class Module_database extends Module
{

	public $version = '1.0.0';

	/**
	 * The information about the module
	 *
	 * @var array
	 */
	public function info()
	{
		return [
			'name'			=> [
				'cn'	=> '数据库',
			],

			'description'	=> [
				'cn'	=> '数据库维护，优化，备份',
			],
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'menu'			=> 'application',
			'roles'			=> [
			],
			'sections'		=> [
				'database'	=> [
					'name'		=> 	'信息',
					'uri'		=> 	'application/database'
				],
				'tables'	=> [
					'name'		=> 	'优化/修复',
					'uri'		=> 	'application/database/tables'
				],
				'query'	=> [
					'name'		=> 	'查询',
					'uri'		=> 	'application/database/query'
				],

				'export'	=> [
					'name'		=> 	'备份',
					'uri'		=> 	'application/database/export'
				],
			]
		];
	}

	public function install()
	{
		return TRUE;
	}

	public function uninstall()
	{
		return TRUE;
	}

	public function upgrade( $upgradeVersion )
	{
		return TRUE;
	}

	public function help()
	{
		return "No documentation has been added for this module.";
	}

}