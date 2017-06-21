<?php

class Admin_root extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$backgrounImages = [
			'urban',
			'power-lines',
			'ravine'
		];

		$this->template
			->title('用户控制台')
			->set('loginBackImg', $backgrounImages[array_rand($backgrounImages)])
			->build('admin/index');
	}
}