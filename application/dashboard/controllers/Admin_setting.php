<?php

class Admin_setting extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['settings/setting_model', 'wysiwyg/wysiwyg_model']);
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
			->build('setting/index');
	}
}