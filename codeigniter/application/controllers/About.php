<?php
class About extends Site_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template
			->title('加入我们')
			->build('about/index');
	}

	public function version()
	{
		$this->template
			->title('平台版本更新记录')
			->build('about/version');
	}

	public function summary()
	{
		$this->template
			->title('简介')
			->build('about/summary');
	}

	public function declare()
	{
		$this->template
			->title('简介')
			->build('about/declare');
	}
}