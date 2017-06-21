<?php

/**
 *	Class Wysiwy_model.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/wysiwyg/model/Wysiwy_model.php
 */

class Wysiwyg_model extends Boone_Model
{
	/**
	 * The table name.
	 *
	 * @var string
	 */
	protected $table = 'wysiwyg';

	/**
     * The primary key, by default set to `id`, for use in some functions.
     *
     * @var string
     */
    protected $primaryKey = 'slug';

}