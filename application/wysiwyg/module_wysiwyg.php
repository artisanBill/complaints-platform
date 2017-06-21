<?php

class Module_wysiwyg extends Module
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
				'cn'	=> '富文本编辑器',
			],

			'description'	=> [
				'cn'	=> '提供 Boone 所见即所得（WYSIWYG）编辑器.',
			],
			'menu'			=> 'setting',
			'frontend'		=> TRUE,
			'user'			=> TRUE,
			'backend'		=> TRUE,
			'sections' => [
				'wysiwyg' => [
					'name'	=> '类型',
					'uri'	=> 'setting/wysiwyg',
					'shortcuts' => [
						[
							'name'	=> '创建配置',
							'uri'	=> 'setting/wysiwyg/create',
							'class'	=> 'btn btn-md btn-success',
							'icon'	=> 'plus',
						]
					],
				],
			],
		];
	}

	public function install()
	{
		if ( $this->db->table_exists('wysiwyg') )
		{
			$this->dbforge->drop_table('wysiwyg');
		}

		$tables = [
			'wysiwyg'	=> [
				'slug'					=> ['type' => 'VARCHAR', 'constraint' => 100, 'primary' => TRUE, 'unique' => TRUE],
				'name'					=> ['type' => 'VARCHAR', 'constraint' => 100],
				'disk'					=> ['type' => 'VARCHAR', 'constraint' => 100, 'default'	=> 'local'],
				'height'				=> ['type' => 'INT', 'constraint' => 11, 'default'	=> 400],
				'placeholder'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'warning'				=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'instructions'			=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'buttons'				=> ['type' => 'TEXT'],
				'plugins'				=> ['type' => 'TEXT'],
				'lineBreaks'			=> ['type' => 'TINYINT', 'constraint' => 1, 'default'	=> 0],
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