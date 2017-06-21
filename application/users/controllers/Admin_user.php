<?php

class Admin_user extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'admin';

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * User page index
	 *
	 * @return void
	 */
	public function index()
	{
		$baseWhere = [];

		if ( $this->input->post('team') )
		{
			$baseWhere['team'] = $this->input->post('team');
			$this->session->set_flashdata('info', sprintf(lang('root.alertLookTeam'), $this->getTeam($baseWhere['team'])));
		}

		// Determine group param
		if ( $this->input->post('active') )
		{
			$baseWhere['active'] = $this->input->post('active');
			$this->session->set_flashdata('info', sprintf(lang('root.alertLookActive'), lang($baseWhere['active'])));
		}

		$userKeyword = NULL;
		if ( $this->input->post('userKeyword') )
		{
			$userKeyword = $this->input->post('userKeyword');
			$this->session->set_flashdata('info', sprintf(lang('root.alertSearchuserKeyword'), $userKeyword));
		}

		// Create pagination links
		$pagination = createPagination('users/root/index', $this->user_model->countBy($baseWhere, $userKeyword));

		// Using this data, get the relevant results
		$this->db
			->order_by('account', 'desc')
			->join('admin_groups', 'admin_groups.id = admin_users.group')
			->join('admin_users_profile', 'admin_users.id = admin_users_profile.userId')
			->limit($pagination['limit'], $pagination['offset']);

		$root = $this->user_model->getManyByAll($baseWhere, $userKeyword);

		$this->template
			->title($this->moduleDetails['name'])
			->set('data', $root)
			->set('baseWhere', $baseWhere)
			->set('pagination', $pagination)
			//->set('team', $this->teamModel->getAll())
			->build('admin/index');
	}
}