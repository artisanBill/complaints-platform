<?php

class Module_Blog extends Module
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
				'cn'	=> '博客',
			],

			'description'	=> [
				'cn'	=> '一个多才多艺的博客和帖子模组.',
			],
			'frontend'		=> TRUE,
			'backend'		=> TRUE,
			'user'			=> TRUE,
			'menu'			=> 'content',
			'roles'			=> [
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
		if ( $this->db->table_exists('blog') && $this->db->table_exists('blog_body'))
		{
			//return TRUE;
			$this->dbforge->drop_table('blog');
			$this->dbforge->drop_table('blog_body');
			$this->dbforge->drop_table('blog_tags');
			$this->dbforge->drop_table('blog_categories');
			$this->dbforge->drop_table('blog_settings');
		}

		$tables = [
			'blog'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'categories'		=> ['type' => 'INT', 'constraint' => 11, 'key' => TRUE],
				'userId'			=> ['type' => 'INT', 'constraint' => 11],
				'slug'				=> ['type' => 'VARCHAR', 'constraint' => 200, 'unique' => TRUE],
				'summary'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => NULL],
				'tags'				=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => NULL],
				'metaTitle'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'image'				=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'images'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'commentCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'featured'			=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'status'			=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'previewCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'createOn'			=> ['type' => 'INT', 'constraint' => 11],
				'publishAt'			=> ['type' => 'DATETIME', 'null' => TRUE]
			],
			'blog_body'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'postId'			=> ['type' => 'INT', 'constraint' => 11],
				'content'			=> ['type' => 'TEXT'],
				'enableComment'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
				'updateOn'			=> ['type' => 'INT', 'constraint' => 11, 'null' => TRUE]
			],
			'blog_tags'	=> [
				'id'		=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'postId'	=> ['type' => 'INT', 'constraint' => 11],
				'item'		=> ['type' => 'VARCHAR', 'constraint' => 100],
			],
			'blog_categories'		=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11],
				'name'			=> ['type' => 'VARCHAR', 'constraint' => 100],
				'description'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => NULL],
			],
			'blog_settings'		=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'blogName'		=> ['type' => 'VARCHAR', 'constraint' => 30],
				'userId'		=> ['type' => 'INT', 'constraint' => 11],
				'concern'		=> ['type' => 'INT', 'constraint' => 11, 'default'	=> 0],
				'blogCount'		=> ['type' => 'INT', 'constraint' => 11, 'default'	=> 0],
				'domain'		=> ['type' => 'VARCHAR', 'constraint' => 20],
				'bank'			=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
				'bankCard'		=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE],
				'theme'			=> ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'default'],
				'reward'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
				'price'			=> ['type' => 'DECIMAL', 'constraint' => '8,2', 'default' => 1],
				'bio'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => NULL],
				'createOn'		=> ['type' => 'INT', 'constraint' => 11],
			],
			'blog_heart_log'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'sendUser'			=> ['type' => 'INT', 'constraint' => 11],
				'concernUser'		=> ['type' => 'INT', 'constraint' => 11],
				'createOn'			=> ['type' => 'INT', 'constraint' => 11],
			]
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