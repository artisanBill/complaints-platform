<?php

/**
 *	Class Protected_Controller.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/codeigniter/application/core/Protected_Controller.php
 */

class Protected_Controller extends Boone_Controller
{
	/**
	 * Constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('member/member_model');

		// Get current user data
		$this->template->currentUser = get_instance()->currentUser = $this->currentUser = $this->member_model->getUser();
	}
}