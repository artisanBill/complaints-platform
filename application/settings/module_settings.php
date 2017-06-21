<?php

class Module_settings extends Module
{
	/**
	 * The version of the module.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	public $currentApp = 'settings';

	public function info()
	{
		$this->load->model('settinfs/setting_model');
		$this->lang->load('settings/setting');
		$settings = $this->setting_model->getManyBy(['isGui' => 1]);
		$sections = [];
		foreach ( $settings as $item )
		{
			if (! $item->module ) {
				$sections['general'] = [
					'name'	=> lang('slug.' . 'general'),
					'uri'	=> 'setting/settings',
				];
			}
			else
			{
				$sections[$item->module] = [
					'name'	=> lang('slug.' . $item->module),
					'uri'	=> 'setting/settings/' . $item->module,
				];
			}
		}

		return [
			'name'			=> [
				'cn'	=> '系统偏好设置',
			],

			'description'	=> [
				'cn'	=> '网站管理者可更新的重要网站设定。例如：网站名称、讯息、电子邮件等。',
			],
			'sections'		=> $sections,
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'skip_xss'		=> TRUE,
			'menu'			=> 'setting',
		];
	}

	public function install()
	{
		if ( $this->db->table_exists('settings') )
		{
			$this->dbforge->drop_table('settings');
		}

		log_message('debug', '-- Settings preferences: going to install the settings table');

		$tables = [
			'settings'	=> [
				'slug'		=> ['type' => 'VARCHAR', 'constraint' => 30, 'primary' => TRUE, 'unique' => TRUE],
				'type'		=> [
					'type' => 'set', 'constraint' => ['text', 'textarea', 'password', 'select', 'select-multiple', 'radio', 'checkbox'],
				],
				'default'	=> ['type' => 'TEXT'],
				'value'		=> ['type' => 'TEXT', 'null' => TRUE],
				'options'	=> ['type' => 'TEXT', 'null' => TRUE],
				'isRequired'=> ['type' => 'INT', 'constraint' => 1],
				'isGui'		=> ['type' => 'INT', 'constraint' => 1],
				'module'	=> ['type' => 'VARCHAR', 'constraint' => 50, 'null' => TRUE],
				'order'		=> ['type' => 'INT', 'constraint' => 10, 'default' => 0],
			],
		];

		if ( ! $this->installTables($tables))
		{
			return FALSE;
		}

		log_message('debug', '-- -- ok settings preferences table');

		$settings = include (__DIR__ . '/settings.php');
		log_message('debug', '-- Settings preferences: going to install the default settings');

		// Lets add the settings for this module.
		foreach ($settings as $slug => $settingInfo)
		{
			log_message('debug', '-- Settings preferences: installing '.$slug);
			$slug = $settingInfo['slug'];
			if ( ! $this->db->insert('settings', $settingInfo))
			{
				log_message('debug', '-- -- could not install '. $slug);

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