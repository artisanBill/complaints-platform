<?php

class Module_honesty extends Module
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
			'name'			=> [
				'cn'	=> '投诉',
			],

			'description'	=> [
				'cn'	=> '投诉网平台核心模组.',
			],
			'frontend'		=> TRUE,
			'backend'		=> TRUE,
			'user'			=> TRUE,
			'menu'			=> 'data',
			'roles'			=> [
			],
			'sections' => [
				'censor' => [
					'name'	=> '审核',
					'uri'	=> 'censor',
				],
			],
		];
	}

	public function install()
	{
		if ( get_instance()->currentUser->group != 1 )
		{
			return FALSE;
		}

		if ( $this->db->table_exists('honestys') && $this->db->table_exists('honestys_body') )
		{
			$this->dbforge->drop_table('honestys');
			$this->dbforge->drop_table('honestys_body');
			//$this->dbforge->drop_table('honestys_categories');
		}

		$tables = [
			'honestys'	=> [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'categories'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'segmentUrl'		=> ['type' => 'VARCHAR', 'constraint' => 24, 'key' => TRUE],
				'memberId'			=> ['type' => 'INT', 'constraint' => 11],
				'eventRegion'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'eventType'			=> ['type' => 'VARCHAR', 'constraint' => 100],
				'metaTitle'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'expect'			=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
				'metaKeyword'		=> ['type' => 'VARCHAR', 'constraint' => 255],
				'metaDescription'	=> ['type' => 'VARCHAR', 'constraint' => 255],
				'eventDateOn'		=> ['type' => 'DATE', 'null' => TRUE],
				'involveAmount'		=> ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => TRUE],
				'casesReceipt'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'eventActive'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'siteUrl'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'previewCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'commentCount'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'isImportant'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'createOn'			=> ['type' => 'INT', 'constraint' => 11],
			],

			'honestys_body'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11, 'null' => TRUE],
				'honestyId'		=> ['type' => 'INT', 'constraint' => 11],
				'allowComment'	=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
				'ipAddress'		=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
				'content'		=> ['type' => 'TEXT'],
				'verifyOn'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default'	=> 0],
				'updateOn'		=> ['type' => 'INT', 'constraint' => 11, 'null'	=> TRUE],
			],

			/*'honestys_categories'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'slug'			=> ['type' => 'INT', 'constraint' => 11],
				'parent'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'industry'		=> ['type' => 'VARCHAR', 'constraint' => 255],
				'icon'			=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'description'	=> ['type' => 'TINYINT', 'constraint' => 255, 'null' => TRUE],
			],*/
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

	public function upgrade($old_version)
	{
		return TRUE;
	}

}