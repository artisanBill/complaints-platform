<?php

use Boone\Outshine\Support\FixedCryptor;

/**
 *	Class User_expect.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */

class User_expect extends User_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_teams_model');
	}

	public function index()
	{
		$users = $this->db->select([
			'member_teams.*',
			'member_profile.displayName as userDisplayName',
			'member.donation as userDonation',
			'member_profile.bio as userBio',
		])
			->order_by('member_teams.createdOn', 'desc')
			->join('member', 'member.id=member_teams.userId')
			->join('member_profile', 'member_profile.userId=member_teams.userId')
			->where('member_teams.isPass', TRUE)
			->where_not_in('member.id', $this->currentUser->id)
			->get($this->member_teams_model->tableName())
			->result();

		$this->template
			->title('专家求助')
			->set('users', $users)
			->set('cryptor', FixedCryptor::getInstance())
			->build('expect/index');
	}
}