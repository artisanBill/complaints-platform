<?php defined('BOONE') OR exit('No direct script access allowed.');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";

/**
 *	Class Boone_Loader
 *
 *	@link			http://cms.boone.ren
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		BooneCPS
 */
class Boone_Loader extends MX_Loader
{
	public function __construct()
	{
		parent::__construct();
		$this->_ci_view_paths[BOONE . 'themes/admin/views/partials/'] = 1;
		$this->_ci_view_paths[BOONE . 'themes/admin/views/'] = 1;
		$this->_ci_view_paths[BOONE . 'themes/itousu/views/public/'] = 1;
	}

	/**
	 * Since parent::_ci_view_paths is protected we use this setter to allow
	 * things like plugins to set a view location.
	 *
	 * @param array $path
	 */
	public function setViewPath(array $path)
	{
		$this->_ci_view_paths = array_merge($this->_ci_view_paths, $path);
	}

	/**
	 * Since parent::_ci_view_paths is protected we use this to retrieve them.
	 *
	 * @return array
	 */
	public function getViewPath()
	{
		// return the full array of paths
		return $this->_ci_view_paths;
	}
}