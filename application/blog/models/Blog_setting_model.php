<?php

/**
 *	Class Blog_setting_model.php
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */
class Blog_setting_model extends Boone_Model
{
	protected $table = 'blog_settings';

	public function home()
	{
		return $this->getBy([
			'userId'	=> $this->currentUser->id
		]);
	}

	public function domainBy($domain)
	{
		$this->db->select([
			'blog_settings.*',
			'member.avatar as userAvater',
			'member_teams.industrys',
			'member_teams.experience'
		])
		->join('member', 'member.id=blog_settings.userId')
		->join('member_teams', 'member_teams.userId=blog_settings.userId');
		return $this->getBy([
			'domain'	=> $domain
		]);
	}
}