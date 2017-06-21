<?php

/**
 *	Class Helper_categories_model.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/helper/models/Helper_categories_model.php
 */

class Helper_categories_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'helper_categories';

	/**
	 * Get all categories.
	 *
	 * @return array
	 */
	public function getCategories()
	{
		$this->db->where('isDisplay', TRUE);
		if ( $this->input->post('userKeyword') )
		{
			$userKeyword = $this->input->post('userKeyword');
			$this->db->like('title', $userKeyword)
				->or_like('keywords', $userKeyword);
		}
		$data = $this->getAll();

		$result = [];
		foreach ( $data as $item )
		{
			if ( $item->parent == 0 )
			{
				$sub = $this->subCategories($data, $item->id);
				$result[$item->id] = [
					'id'			=> $item->id,
					'title'			=> $item->title,
					'description'	=> $item->description,
					'faIcon'		=> $item->faIcon,
					'data'			=> $sub
				];
			}
		}

		return $result;
	}

	/**
	 * Data acquisition sub-category.
	 *
	 * @param  array  $data
	 * @param  int    $condition
	 * @return array
	 */
	protected function subCategories(array $data, int $condition)
	{
		$return = [];
		foreach ( $data as $val )
		{
			if ( $val->parent == $condition )
			{
				$return[] = [
					'id'	=> $val->id,
					'title'	=> $val->title,
				];
			}
		}
		return $return;
	}
}