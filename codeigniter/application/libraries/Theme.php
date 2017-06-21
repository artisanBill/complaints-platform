<?php
/**
 *	Class Theme
 *
 *	@link			http://cms.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		BooneCPS
 */
abstract class Theme
{
	/**
	 * Theme name
	 *
	 * @var  string
	 */
	public $name;

	/**
	 * Author name
	 *
	 * @var  string
	 */
	public $author;

	/**
	 * Authors website
	 *
	 * @var  string
	 */
	public $authorWebsite;

	/**
	 * Theme website
	 *
	 * @var  string
	 */
	public $website;

	/**
	 * Theme description
	 *
	 * @var  string
	 */
	public $description;

	/**
	 * The version of the theme.
	 *
	 * @var  string
	 */
	public $version;
	
	/**
	 * Front-end or back-end.
	 *
	 * @var  string
	 */
	public $type;

	/**
	 * Designer defined options.
	 *
	 * @var  string
	 */
	public $options;
	
	/**
	 * __get
	 *
	 * Allows this class and classes that extend this to use $this-> just like you were in a controller.
	 *
	 * @access	public
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->{$var};
	}
}