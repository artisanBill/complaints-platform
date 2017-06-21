<?php

class Module_addon extends Module
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
				'cn'	=> '附加功能',
			],

			'description'	=> [
				'cn'	=> '管理员可以检视目前已经安装模组的列表',
			],
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'user'			=> FALSE,
			'menu'			=> 'application',
			'roles'			=> [
				'modules'	=> ['index','enable', 'disable', 'install', 'uninstall', 'upload'],
				'appearance'=> ['index','enable', 'disable', 'choose', 'upload', 'install', 'uninstall']
			],
			'sections' => [
				'module' => [
					'name' => '模组',
					'uri' => 'application/addon',
					'shortcuts'	=> [
						[
							'name'	=> '上传模组',
							'uri'	=> 'application/addon/upload',
							'class'	=> 'btn btn-md btn-success',
							'icon'	=> 'upload',
						]
					],
				],
				'theme' => [
					'name'	=> '主题',
					'uri'	=> 'database',
				],
			],
		];
	}

	public function install()
	{
		/*$this->dbforge->drop_table('appearance');

		$tables = [
			'appearance'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => true, 'primary' => true],
				'slug'			=> ['type' => 'VARCHAR', 'constraint' => 30],
				'type'			=> ['type' => 'set', 'constraint' => ['text', 'textarea', 'password', 'select', 'select-multiple', 'radio', 'checkbox', 'colour-picker']],
				'default'		=> ['type' => 'VARCHAR', 'constraint' => 255],
				'value'			=> ['type' => 'VARCHAR', 'constraint' => 255],
				'options'		=> ['type' => 'TEXT'],
				'isRequired'	=> ['type' => 'INT', 'constraint' => 1],
				'theme'			=> ['type' => 'VARCHAR', 'constraint' => 50],
			],
		];*/

		/*if ( ! $this->installTables($tables))
		{
			return FLASE;
		}*/

		// Install settings
		$settings = [
			[
				'slug'			=> 'addonUpload',
				'type'			=> 'radio',
				'default'		=> '0',
				'value'			=> '0',
				'options'		=> '1=Enabled|0=Disabled',
				'isRequired'	=> 1,
				'isGui'			=> 1,
				'module'		=> 'addon',
				'order'			=> 1000,
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
		return FALSE;
	}

	public function upgrade($oldVersion)
	{
		return TRUE;
	}
}