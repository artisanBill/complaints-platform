<?php

/**
 *	Class Admin_group_model.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/users/models/Admin_group_model.php
 */
class Admin_group_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'admin_groups';

	private $groups = [];

	/**
	 * Get all the team, in addition to a team of developers.
	 *
	 * @return array
	 */
	public function getGroupAll()
	{
		$this->db->where_not_in('id', 1);

		return $this->getAll();
	}

	/**
	 * Get the permission rules for a group.
	 *
	 * @param int $groupId The id for the group.
	 * @return array
	 */
	public function getGroupPermission($groupId)
	{
		// Save a query if you can
		if (isset($this->groups[$groupId]))
		{
			return $this->groups[$groupId];
		}

		// Execute the query
		$result = $this->db
			->where('id', $groupId)
			->get($this->table)
			->result();

		// Store the final rules here
		$rules = [];

		// Either pass roles or just true
		foreach ($result as $row)
		{
			// Either pass roles or just true
			$rules = $row->permissions ? json_decode($row->permissions, true) : true;
		}

		// Save this result for later
		$this->groups[$groupId] = $rules;

		return $rules;
	}

}
