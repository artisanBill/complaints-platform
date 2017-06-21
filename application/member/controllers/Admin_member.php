<?php

class Admin_member extends Admin_Controller
{
	/**
	 * The current active section
	 *
	 * @var string
	 */
	public $section = 'member';

	/**
	 * Constructor.
	 *
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['member_model', 'member_group_model']);

		$this->template->groups = $this->member_group_model->getAll();
	}

	/**
	 * Get all registered users.
	 *
	 * @return void
	 */
	public function index()
	{
		$baseWhere = [];
		/**
		 * User Filters
		 */
		// Determine group param
		if ( $this->input->get('group') )
		{
			$baseWhere['group'] = $this->input->get('group');
		}

		$keywords = NULL;
		// Keyphrase param
		if ( $this->input->get('keywords') )
		{
			$keywords = $this->input->get('keywords');
		}

		// Create pagination links
		$pagination = createPagination('root/member', $this->member_model->countBy($baseWhere, $keywords));

		// Using this data, get the relevant results
		$this->db->select([
			'member.*',
			'member_profile.displayName userDisplayName',
			'member_profile.firstName userFirstName',
			'member_profile.lastName userLastName',
			'member_profile.gender userGender',
			])
			->order_by('createdOn', 'desc')
			->join('member_group', 'member_group.id = member.group')
			->join('member_profile', 'member_profile.userId = member.id')
			//->where_not_in('groups.name', $skip_admin)
			->limit($pagination['limit'], $pagination['offset']);

		$users = $this->member_model->getManyBy($baseWhere, $keywords);

		$this->template
			->title($this->moduleDetails['name'])
			->set('pagination', $pagination)
			->set('users', $users)
			->build('admin/index');
	}
}