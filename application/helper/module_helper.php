<?php

/**
 *	Class module_helper.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/helper/module_helper.php
 */

class Module_helper extends Module
{
		/**
	 * The version of the module.
	 *
	 * @var string
	 */
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
				'cn'	=> '帮助',
			],

			'description'	=> [
				'cn'	=> '一个能解决用户疑问的模组.',
			],
			'frontend'		=> TRUE,
			'backend'		=> TRUE,
			'user'			=> TRUE,
			'menu'			=> 'content',
			'roles'			=> [
			],
			'sections' => [
				'helper'		=> [
					'name'	=> '帮助中心',
					'uri'	=> 'content/helper',
					'shortcuts' => [
						[
							'name'	=> '创建帮助',
							'uri'	=> 'content/helper/change',
							'class'	=> 'btn btn-md btn-success',
							'modal'	=> TRUE,
							'icon'	=> 'plus',
						]
					],
				],

				'categories'		=> [
					'name'	=> '类别',
					'uri'	=> 'content/helper/categories',
					'shortcuts' => [
						[
							'name'	=> '创建帮助类别',
							'uri'	=> 'content/helper/categories/change',
							'class'	=> 'btn btn-md btn-success',
							'modal'	=> TRUE,
							'icon'	=> 'plus',
						]
					],
				],
			],
		];
	}

	/**
	 * Installation logic
	 *
	 * This is handled by the installer only so that a default user can be created.
	 *
	 * @return boolean
	 */
	public function install()
	{
		if ( $this->db->table_exists('helper') && $this->db->table_exists('helper_categories'))
		{
			$this->dbforge->drop_table('helper');
			$this->dbforge->drop_table('helper_categories');
		}

		$tables = [
			'helper'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'adminId'			=> ['type' => 'INT','constraint' => 11],
				'slug'				=> ['type' => 'VARCHAR', 'constraint' => 200, 'key' => TRUE],
				'metaTitle'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'metaKeyword'		=> ['type' => 'VARCHAR', 'constraint' => 255],
				'featured'			=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'content'			=> ['type' => 'TEXT'],
				'usefulCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'uselessCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'createOn'			=> ['type' => 'INT', 'constraint' => 11]
			],
			'helper_categories' => [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'title'			=> ['type' => 'VARCHAR', 'constraint' => 100],
				'keywords'		=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'description'	=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'faIcon'		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE],
				'parent'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'isDisplay'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1]
			],
		];

		if ( ! $this->installTables($tables))
		{
			return FALSE;
		}

		return TRUE;
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return FALSE;
	}

	public function upgrade($version)
	{
		return TRUE;
	}
}