<?php

/**
 *	Class User.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/codeigniter/application/controllers/User.php
 */

class User extends User_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template
			->title('欢迎您', $this->currentUser->displayName)
			->build('usercenter/index');
	}
}