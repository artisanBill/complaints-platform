<?php

/**
 *	Class Categories_model.php
 *
 *	@link			http://outshine.boonx.net
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boonx.net>
 *	@version		1.0.0
 *	@package		\Boone\Outshine\
 */

class Categories_model extends Boone_Model
{
	protected $table = 'blog_categories';
	public function create()
	{
		$data = $this->input->post();
		
	}
}