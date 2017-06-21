<?php

class Module_post extends Module
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
				'cn'	=> '文章',
			],

			'description'	=> [
				'cn'	=> '文章分类一个多才多艺的文章和帖子模组.',
			],
			'frontend'		=> TRUE,
			'backend'		=> TRUE,
			'user'			=> FALSE,
			'menu'			=> 'content',
			'roles'			=> [
				'admin_categories'	=> ['index', 'create', 'edit', 'delete', 'change'],
				'admin_post'	=> ['index', 'create', 'delete', 'change']
			],
			'sections' => [
				'post' => [
					'name'	=> '文章',
					'uri'	=> 'content/post',
					'shortcuts' => [
						[
							'name'	=> '创建文章',
							'uri'	=> 'content/post/change',
							'class'	=> 'btn btn-md btn-success',
							'modal'	=> TRUE,
							'icon'	=> 'plus',
						]
					],
				],
				'categories'=> [
					'name'	=> '类别',
					'uri'	=> 'content/post/categories',
					'shortcuts' => [
						[
							'name'	=> '创建类别',
							'uri'	=> 'content/post/categories/change',
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
		if ( $this->db->table_exists('posts') && $this->db->table_exists('posts_body'))
		{
			$this->dbforge->drop_table('posts');
			$this->dbforge->drop_table('posts_body');
		}

		$tables = [
			'posts'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'categories'		=> ['type' => 'INT', 'constraint' => 11, 'key' => TRUE],
				'userId'			=> ['type' => 'INT', 'constraint' => 11],
				'slug'				=> ['type' => 'VARCHAR', 'constraint' => 200, 'unique' => TRUE],
				'summary'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'metaTitle'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'tag'				=> ['type' => 'VARCHAR', 'constraint' => 255],
				'image'				=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'commentCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'featured'			=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'status'			=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'createOn'			=> ['type' => 'INT', 'constraint' => 11],
				'publishAt'			=> ['type' => 'DATETIME', 'null' => TRUE]
			],
			'posts_body'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'postId'			=> ['type' => 'INT', 'constraint' => 11],
				'metaKeyword'		=> ['type' => 'VARCHAR', 'constraint' => 255],
				'metaDescription'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'content'			=> ['type' => 'TEXT'],
				'enableComment'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
				'updateOn'			=> ['type' => 'INT', 'constraint' => 11, 'null' => TRUE]
			],
			'posts_categories'		=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'name'			=> ['type' => 'VARCHAR', 'constraint' => 100],
				'parent'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'layout'		=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE]
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