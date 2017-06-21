<?php

/**
 *	Class Member_teams_model.php
 *
 *	@link			http://outshine.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.ren>
 *	@version		1.0.0
 *	@package		\Boone\
 */

class Member_teams_model extends Boone_Model
{
	/**
	 * The tabale name.
	 *
	 * @var string
	 */
	protected $table = 'member_teams';

	public function checkActive()
	{
		$user = $this->db->select('isPass')
			->where('userId', $this->currentUser->id)
			->get($this->table)
			->row();

		return $user && $user->isPass;
	}
}