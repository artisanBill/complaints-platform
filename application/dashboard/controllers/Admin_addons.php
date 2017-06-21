<?php

class Admin_addons extends Admin_Controller
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
			->title('附加功能面板')
			->set('loginBackImg', $backgrounImages[array_rand($backgrounImages)])
			->build('admin/index');
	}
}