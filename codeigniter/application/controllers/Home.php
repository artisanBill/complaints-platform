<?php

class Home extends Site_Controller
{
	/**
	 *	Constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('post/post_model');
		$postData = $this->post_model->getFeatured(6);

		$this->template
			->title(Setting::get('siteName'))
			->set_metadata('og:title', Setting::get('siteName'), 'og')
			->set_metadata('og:type', 'home', 'og')
			->set_metadata('og:url', current_url(), 'og')
			->set_metadata('og:description', Setting::get('metaTopic'), 'og')
			->set_metadata('description', Setting::get('metaTopic'))
			->set_metadata('keywords', Setting::get('metaTopic'))
			->set('postData', $postData)
			->set('viewBanner', TRUE)
			->build('home/index');
	}

	public function error404()
	{
		$this->template
			->title('页面开小车啦')
			->build('home/error404');
	}
}