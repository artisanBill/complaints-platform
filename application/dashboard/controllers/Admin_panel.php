<?php

class Admin_panel extends Admin_Controller
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
			->title('控制台面板')
			->set('loginBackImg', $backgrounImages[array_rand($backgrounImages)])
			->build('admin/index');
	}
}