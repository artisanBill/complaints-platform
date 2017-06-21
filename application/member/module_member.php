<?php

class Module_member extends Module
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
				'cn'	=> '用户',
			],

			'description'	=> [
				'cn'	=> '注册成员, 网站成员.',
			],
			'frontend'		=> FALSE,
			'backend'		=> TRUE,
			'user'			=> TRUE,
			'menu'			=> 'root',
			'roles'			=> [
				'root'	=> ['create', 'delete', 'preview', 'edit', 'message', 'calling']
			],
			//	root
			'sections' => [
				'member' => [
					'name' => '用户',
					'uri' => 'root/member',
				],

				'team' => [
					'name' => '团队',
					'uri' => 'root/member/accessment',
				],

				'admin_group' => [
					'name' => '用户群组',
					'uri' => 'group',
					'shortcuts' => [
						[
							'name'	=> '创建群组',
							'uri'	=> 'group/create',
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
		if ( $this->db->table_exists('member') && $this->db->table_exists('member_profile'))
		{
			return TRUE;
		}

		$tables = [
			'member'	=> [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'group'			=> ['type' => 'INT', 'constraint' => 11],
				'mobile'		=> ['type' => 'VARCHAR', 'constraint' => 20 ],
				'wechat'		=> ['type' => 'VARCHAR', 'constraint' => 34, 'null' => TRUE],
				'email'			=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
				'avatar'		=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'loginKey'		=> ['type' => 'VARCHAR', 'constraint' => 60, 'null' => TRUE],
				'activeCode'	=> ['type' => 'VARCHAR', 'constraint' => 60, 'null' => TRUE],
				'username'		=> ['type' => 'VARCHAR', 'constraint' => 100, 'null' => TRUE],
				'active'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
				'messsage'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'createdOn'		=> ['type' => 'INT', 'constraint' => 11],
				'ipAddress'		=> ['type' => 'VARCHAR', 'constraint' => 100],
				'position'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'donation'		=> ['type' => 'DECIMAL', 'constraint' => '10,2','default' => 0],
				'lastLogin'		=> ['type' => 'INT', 'constraint' => 11, 'null' => 'TRUE'],
			],
			'member_profile' => [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11],
				'displayName'	=> ['type' => 'VARCHAR', 'constraint' => 100],
				'firstName'		=> ['type' => 'VARCHAR', 'constraint' => 50],
				'lastName'		=> ['type' => 'VARCHAR', 'constraint' => 50],
				'bio'			=> ['type' => 'TEXT', 'null' => TRUE],
				'gender'		=> ['type' => 'ENUM', 'constraint' => ['female', 'male']],
				'birthday'		=> ['type' => 'DATE', 'null' => TRUE],
				'card'			=> ['type' => 'VARCHAR', 'constraint' => 240, 'null' => TRUE],
				'website'		=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'company'		=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'department'	=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'job'			=> ['type' => 'VARCHAR', 'constraint' => 200, 'null' => TRUE],
				'addressLine'	=> ['type' => 'VARCHAR', 'constraint' => 255],
				'updatedOn'		=> ['type' => 'INT', 'constraint' => 11, 'null' => TRUE]
			],
			'member_group' => [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'name'			=> ['type' => 'VARCHAR', 'constraint' => 100],
				'description'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
			],
			'member_teams' => [
				'id'			=> ['type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE, 'primary' => TRUE],
				'userId'		=> ['type' => 'INT', 'constraint' => 11, 'key'	=> TRUE],
				'userAvater'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'default' => ''],
				'fullname'		=> ['type' => 'VARCHAR', 'constraint' => 200],
				//	行业
				'industrys'		=> ['type' => 'VARCHAR', 'constraint' => 200],
				'cardNumber'	=> ['type' => 'TINYINT', 'constraint' => 1],
				//	职业证书
				'vocational'	=> ['type' => 'VARCHAR', 'constraint' => 255, 'null' => TRUE],
				'experience'	=> ['type' => 'INT', 'constraint' => 4],
				'countHelper'	=> ['type' => 'INT', 'constraint' => 11, 'default' => 0],
				'isPass'		=> ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
				'reasons'		=> ['type' => 'TEXT'],
				'createdOn'		=> ['type' => 'INT', 'constraint' => 11]
			],
		];

		if ( ! $this->installTables($tables))
		{
			return FALSE;
		}

		$this->db->insert('member_group', [
			'name'			=> '注册用户',
			'description'	=> '网站普通用户',
		]);

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