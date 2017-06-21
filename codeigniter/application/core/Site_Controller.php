<?php defined('BOONE') OR exit('No direct script access allowed.');

/**
 *  Class Site_Controller
 *
 *  @link           http://cms.boone.ren
 *  @author         Boone <ililianjin@iCloud.com>
 *  @author         Outshine Development Team <outshine@boone.red>
 *  @version        1.0.0
 */
class Site_Controller extends Protected_Controller
{
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->benchmark->mark('site_controller_start');
		$this->load->model('member/member_model');
		$this->load->model('blog/blog_setting_model');
		Events::trigger('site_controller');

		$this->load->helper('file');

		$this->template->publicNavigation = [
			[
				'url'	=> 'honesty',
				'name'	=> '投诉预览'
			],
			[
				'url'	=> 'blog',
				'name'	=> '博客'
			],
			[
				'url'	=> 'helper',
				'name'	=> '帮助中心'
			],
			[
				'url'	=> 'about',
				'name'	=> '加入我们'
			]
		];

		// Assign segments to the template the new way
		$this->template->server = $_SERVER;
		
		$this->template
			->enable_parser(FALSE)
			->set_theme('itousu')
			->set_layout('default');

		$this->benchmark->mark('site_controller_end');
	}
}