<?php
class Module_users extends Module
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
				'cn'	=> '团队',
			],

			'description'	=> [
				'cn'	=> '后台管理, 公司员工, 团队.',
			],
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'menu'			=> 'root',
			'roles'			=> [
				'root'	=> ['create', 'delete', 'preview', 'edit', 'message', 'calling']
			],
			//	root
			'sections' => [
				'admin' => [
					'name' => '管理成员',
					'uri' => 'root/users',
					'shortcuts' => [
						[
							'name'	=> '创建用户',
							'uri'	=> 'users/create',
							'class'	=> 'btn btn-md btn-success',
							'icon'	=> 'user-plus',
						],
					],
				],

				'teams' => [
					'name' => '管理权限',
					'uri' => 'root/users/teams',
					'shortcuts' => [
						[
							'name'	=> '创建群组',
							'uri'	=> 'root/users/teams/create',
							'class'	=> 'btn btn-md btn-success',
							'icon'	=> 'plus',
						],
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
		if ( $this->db->table_exists('admin_users') && $this->db->table_exists('admin_users_profile') )
		{
			return TRUE;
			//$this->dbforge->drop_table('admin_users');
		}

		$tables = [
			'admin_users'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'group'			=> ['type' => 'INT', 'constraint' => 11],
				'account'		=> ['type' => 'VARCHAR', 'constraint' => 60 ],
				'password'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'salt'			=> ['type' => 'VARCHAR', 'constraint' => 8],
				'avatar'		=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'forgottenPasswordCode'	=> ['type' => 'VARCHAR', 'constraint' => 11, 'null' => TRUE],
				'loginKey'		=> ['type' => 'VARCHAR', 'constraint' => 60, 'null' => TRUE],
				'username'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'mobile'		=> ['type' => 'VARCHAR', 'constraint' => 24, 'null' => TRUE],
				'active'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
				'createdOn'		=> ['type' => 'INT', 'constraint' => 11],
				'ipAddress'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'lastLogin'		=> ['type' => 'INT', 'constraint' => 11, 'null' => 'TRUE'],
			],
			'admin_users_profile'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11],
				'displayName'	=> ['type' => 'VARCHAR', 'constraint' => 100],
				'firstName'		=> ['type' => 'VARCHAR', 'constraint' => 50],
				'lastName'		=> ['type' => 'VARCHAR', 'constraint' => 50],
				'company'		=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'department'	=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'job'			=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'bio'			=> ['type' => 'TEXT', 'null' => TRUE],
				'gender'		=> ['type' => 'ENUM', 'constraint' => ['female', 'male']],
				'birthday'		=> ['type' => 'DATE', 'null' => TRUE],
				'card'			=> ['type' => 'VARCHAR', 'constraint' => 20, 'null' => TRUE],
				'addressLine'	=> ['type' => 'VARCHAR', 'constraint' => 255],
				'addressLineOne'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'addressLineTwo'=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'postcode'		=> ['type' => 'VARCHAR', 'constraint' => 20, 'null' => TRUE],
				'website'		=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'updatedOn'		=> ['type' => 'INT', 'constraint' => 11, 'null' => TRUE]
			]
		];

		if ( ! $this->installTables($tables))
		{
			return FALSE;
		}

		// Install the settings
		$settings = include (__DIR__ . '/settings.php');

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

	public function upgrade($old_version)
	{
		return TRUE;
	}
}