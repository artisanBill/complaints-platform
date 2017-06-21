<?php

class Setting_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'settings';

	/**
	 * Get
	 *
	 * Gets a setting based on the $where param.  $where can be either a string containing a slug name or an array of WHERE options.
	 *
	 * @param	mixed
	 * @return	object
	 */
	public function get($where)
	{
		if ( ! is_array($where))
		{
			$where = array('slug' => $where);
		}

		return $this->db
			->select('*, IF(`value` = "", `default`, `value`) as `value`', FALSE)
			->where($where)
			->get($this->table)
			->row();
	}

	/**
	 * Get Many By
	 *
	 * Gets all settings based on the $where param.  $where can be either a string containing a module name or an array of WHERE options.
	 *
	 * @param	mixed
	 * @return	object
	 */
	public function getManyBy($where = array())
	{
		if ( ! is_array($where))
		{
			$where = array('module' => $where);
		}

		$this->db
			->select('*, IF(`value` = "", `default`, `value`) as `value`', FALSE)
			->where($where)
			->order_by('`order`', 'DESC');
		
		return $this->getAll();
	}

	/**
	 * Update
	 *
	 * Updates a setting for a given $slug.
	 *
	 * @param	string	$slug
	 * @param	array	$params
	 * @return	bool
	 */
	public function update($slug = '', $params = array(), $skipValidation = FALSE)
	{
		return $this->db->update($this->table, $params, array('slug' => $slug));
	}

	/**
	 * Statistics Percentage share of the completed
	 *
	 * @return int
	 */
	public function percentage()
	{
		$count = $this->countBy(array('isGui' => 1));
		
		$empty = $this->countBy(array('value' => '', 'isGui' => 1));

		$return = (1 - ($empty / $count)) * 100;
		return number_format($return, 2);
	}

	/**
	 * Sections
	 *
	 * Gets all the sections (modules) from the settings table.
	 *
	 * @return	array
	 */
	public function sections()
	{
		$sections = $this->select('module')
			->distinct()
			->where('module != ""')
			->getAll();

		$result = array();

		foreach ($sections as $section)
		{
			$result[] = $section->module;
		}

		return $result;
	}
}