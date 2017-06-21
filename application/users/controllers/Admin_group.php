<?php

/**
 *	Class Admin_group.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/users/controllers/Admin_group.php
 */

class Admin_group extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'teams';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('admin_group_model', 'group_model');
	}

	/**
	 * Display all teams.
	 *
	 * @return void
	 */
	public function index()
	{
		$teams = $this->group_model->getGroupAll();
		$this->template
			->title('团队权限')
			->set('teams', $teams)
			->build('group/index');
	}

	/**
	 * Shows the permissions for a specific user group.
	 *
	 * @param int $id
	 * @return void
	 */
	public function permissions(int $id = 0)
	{
		// Get the group data
		$permissions = $this->group_model->get($id);

		// If the group data could not be retrieved
		if ( ! $permissions )
		{
			// Set a message to notify the user.
			$this->session->set_flashdata('success', '该团队不支持设定权限');
			redirect('root/users/teams');
		}

		if ( $_POST )
		{
			$postData = $this->input->post('permissions');
			$this->group_model->update($id, ['permissions' => json_encode($postData)]);
			// Set a message to notify the user.
			$this->session->set_flashdata('success', '您已经成功更新权限');
			redirect('root/users/teams');
		}

		// Get the groups permission rules (no need if this is the admin group)
		$editPermissions = $this->group_model->getGroupPermission($permissions->id);

		// Get all the possible permission rules from the installed modules
		$permissionModules = $this->app_model->getAll(['isBackend' => TRUE, 'installed' => TRUE]);

		foreach ( $permissionModules as &$permissionModule )
		{
			$permissionModule['roles'] = $this->app_model->roles($permissionModule['slug']);
		}

		$this->template
			->title($permissions->name,'权限设定')
			->set('permissions', $permissions)
			->set('permissionModules', $permissionModules)
			->set('editPermissions', $editPermissions)
			->build('group/permissions');
	}

	/**
	 * Create Team.
	 *
	 * @return void
	 */
	public function create()
	{
		if ( $_POST )
		{
			$this->form_validation->set_rules('name', '团队名称', 'trim|required');
			if ( $this->form_validation->run() )
			{
				$post = $this->input->post();

				$insert = [
					'name'			=> $post['name'],
					'description'	=> $post['description'],
				];

				$this->group_model->insert($insert);
				$this->session->set_flashdata('success', sprintf('您成功创建 %s 团队', $post['name']));
				redirect('root/users/teams');
			}
		}
		$this->template
			->title('创建团队')
			->build('group/create');
	}
}