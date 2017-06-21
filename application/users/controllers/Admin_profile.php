<?php

class Admin_profile extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Show my Profile.
	 *
	 * @param  int    $id
	 * @return void
	 */
	public function index(int $id)
	{
		if ( $id != $this->currentUser->id )
		{
			show_404();
		}

		$backgrounImages = [
			'urban',
			'power-lines',
			'ravine'
		];

		$this->template
			->title($this->currentUser->displayName)
			->set('loginBackImg', $backgrounImages[array_rand($backgrounImages)])
			->build('admin/profile');
	}
}