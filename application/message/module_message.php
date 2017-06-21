<?php

/**
 *	Class module_message.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */

class Module_message extends Module
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
				'cn'	=> '站内信息',
			],

			'description'	=> [
				'cn'	=> '管理员和用户之间的沟通信息，或用户与用户之间的沟通.',
			],
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'user'			=> TRUE,
			'menu'			=> 'data',
			'roles'			=> [
			],
			//	root
			'sections' => [
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
		if ( $this->db->table_exists('site_message') )
		{
			//return TRUE;
			$this->dbforge->drop_table('site_message');
		}

		$tables = [
			'site_message'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'senderUser'	=> ['type' => 'TEXT'],
				'isAdmin'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0 ],
				'acceptUser'	=> ['type' => 'INT', 'constraint' => 11],
				'isImportant'	=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0 ],
				'isReply'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0 ],
				'isRead'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0 ],
				'segmentUrl'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 0],
				'title'			=> ['type' => 'VARCHAR', 'constraint' => 200],
				'subject'		=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'content'		=> ['type' => 'TEXT'],
				'createdOn'		=> ['type' => 'INT', 'constraint' => 11],
				'replyOn'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0]
			],
		];

		if ( ! $this->installTables($tables))
		{
			return FLASE;
		}

		return TRUE;
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return FALSE;
	}

	public function upgrade($oldVersion)
	{
		return TRUE;
	}
}