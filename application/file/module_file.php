<?php

class Module_file extends Module
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
				'cn'	=> '档案',
			],
			'description'	=> [
				'cn'	=> '管理网站中的档案与目录',
			],
			'frontend' 		=> FALSE,
			'backend'  		=> TRUE,
			'user'  		=> TRUE,
			'skipXss' 		=> TRUE,
			'menu'			=> 'content',
			'roles'			=> [
			],
			'sections' => [
				'file'	=> [
					'name'	=> '档案',
					'uri'	=> 'content/file',
					'shortcuts' => [
						[
							'name'	=> '上传文件',
							'uri'	=> 'content/file/folder/change',
							'class'	=> 'btn btn-md btn-success',
							'icon'	=> 'upload',
							'modal'	=> TRUE
						],
					],
				],

				'folder'	=> [
					'name'	=> '文件夹',
					'uri'	=> 'content/file/folder',
					'shortcuts' => [
						[
							'name'	=> '创建文件夹',
							'uri'	=> 'content/file/folder/create',
							'class'	=> 'btn btn-md btn-success',
							'icon'	=> 'plus',
						],
					],
				],
			],
		];
	}

	public function install()
	{
		if ( $this->db->table_exists('files') && $this->db->table_exists('file_folders'))
		{
			return TRUE;
		}

		$tables = [
			'files' => [
				'id'			=> ['type' => 'CHAR', 'constraint' => 15, 'primary' => TRUE,],
				'folderId'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0,],
				'userId'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 1,],
				'type'			=> ['type' => 'ENUM', 'constraint' => ['a', 'v', 'd', 'i', 'o', ''], 'null' => TRUE, 'default' => NULL,],
				'name'			=> ['type' => 'VARCHAR', 'constraint' => 100,],
				'filename'		=> ['type' => 'VARCHAR', 'constraint' => 255,],
				'path'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => ''],
				'description'	=> ['type' => 'TEXT'],
				'extension'		=> ['type' => 'VARCHAR', 'constraint' => 10,],
				'mimetype'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'keywords'		=> ['type' => 'CHAR', 'constraint' => 32, 'default' => ''],
				'width'			=> ['type' => 'INT', 'constraint' => 5, 'null' => TRUE],
				'height'		=> ['type' => 'INT', 'constraint' => 5, 'null' => TRUE,],
				'filesize'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'altAttribute'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'downloadCount'	=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'createOn'		=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'sort'			=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
			],
			'file_folders' => [
				'id'				=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'slug'				=> ['type' => 'VARCHAR', 'constraint' => 100],
				'name'				=> ['type' => 'VARCHAR', 'constraint' => 100],
				'description'		=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'format'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => 'local'],
				'location'			=> ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'local'],
				'createOn'			=> ['type' => 'INT', 'constraint' => 11],
				'sort'				=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
			],
		];

		if ( ! $this->installTables($tables))
		{
			return FALSE;
		}

		// Install the settings
		$settings = [
			[
				'slug'		=> 'filesCache',
				'type'		=> 'select',
				'default'	=> '480',
				'value'		=> '480',
				'options'	=> '0=no-cache|1=1-minute|60=1-hour|180=3-hour|480=8-hour|1440=1-day|43200=30-days',
				'isRequired'=> 1,
				'isGui'		=> 1,
				'module'	=> 'file',
				'order'		=> 1000,
			],
			[
				'slug'		=> 'filesUploadLimit',
				'type'		=> 'text',
				'default'	=> '5',
				'value'		=> '5',
				'options'	=> '',
				'isRequired' => 1,
				'isGui'		=> 1,
				'module'	=> 'file',
				'order'		=> 998,
			],
			[
				'slug'		=> 'filesMaxParallel',
				'type'		=> 'select',
				'default'	=> '1',
				'value'		=> 0,
				'options'	=> '1=1|5=5|10=10|20=10',
				'isRequired' => 1,
				'isGui'		=> 1,
				'module'	=> 'file',
				'order'		=> 997,
			],
		];

		foreach ($settings as $setting)
		{
			if ( ! $this->db->insert('settings', $setting))
			{
				return FALSE;
			}
		}

		return TRUE;
	}

	public function uninstall()
	{
		// This is a core module, lets keep it around.
		return false;
	}

	public function upgrade($old_version)
	{
		return TRUE;
	}
}
