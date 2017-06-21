<?php

class Module_comments extends Module
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
	 */
	public function info()
	{
		return [
			'name' => [
				'en' => 'Comments',
				'cn' => '回应',
			],
			'description' => [
				'en' => 'Users and guests can write comments for content like blog, pages and photos.',
				'cn' => '用户和访客可以针对新闻、页面与照片等内容发表回应。'
			],
			'frontend'		=> FALSE,
			'user'			=> TRUE,
			'backend'		=> TRUE,
			'menu'			=> 'content'
		];
	}

	public function install()
	{
		if ( $this->db->table_exists('comments') )
		{
			$this->dbforge->drop_table('comments');
			$this->dbforge->drop_table('comment_reply');
		}

		$tables = [
			'comments' => [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'isActive'		=> ['type' => 'INT', 'constraint' => 1, 'default' => 0],
				'userId'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'isTeam'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'email'			=> ['type' => 'VARCHAR', 'constraint' => 52, 'default' => ''],
				'title'			=> ['type' => 'VARCHAR', 'constraint' => 52, 'default' => ''],
				'urlSlug'		=> ['type' => 'INT', 'constraint' => 11],
				'content'		=> ['type' => 'TEXT'],
				'module'		=> ['type' => 'VARCHAR', 'constraint' => 52, 'default' => 'public'],
				'createdOn'		=> ['type' => 'INT', 'constraint' => 11],
				'approvalCount'	=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'contraCount'	=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'ipAddress'		=> ['type' => 'VARCHAR', 'constraint' => 200, 'default' => ''],
			],
			'comment_reply' => [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'commentId'		=> ['type' => 'INT', 'constraint' => 11, 'key' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'body'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => ''],
				'parentId'		=> ['type' => 'INT', 'constraint' => 11],
				'createdOn'		=> ['type' => 'INT', 'constraint' => 11],
			],
			'comment_log'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'commentId'		=> ['type' => 'INT', 'constraint' => 11, 'key' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'approval'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'contra'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
			]
		];

		if ( ! $this->installTables($tables))
		{
			return false;
		}

		// Install the setting
		/*$settings = include __DIR__ . '/settings.php';

		foreach ( $settings as $setting )
		{
			if ( ! $this->db->insert('settings', $setting) )
			{
				return false;
			}
		}*/

		return true;
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return false;
	}

	public function upgrade($oldVersion)
	{
		return true;
	}

}
