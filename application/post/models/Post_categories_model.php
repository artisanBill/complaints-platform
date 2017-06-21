<?php

use Boone\Outshine\Support\Arrayeg;

class Post_categories_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'posts_categories';

	/**
	 * Get all categories.
	 *
	 * @return array
	 */
	public function getCategories()
	{
		$data = $this->getAll();

		$result = [];
		foreach ( $data as $item )
		{
			if ( $item->parent == 0 )
			{
				$sub = $this->subCategories($data, $item->id);
				$result[$item->id] = [
					'name'	=> $item->name,
					'data'	=> $sub
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
					'name'	=> $val->name
				];
			}
		}
		return $return;
	}
}