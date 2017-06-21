<?php

return [
	'default_controller'		=> 'home',
	'login'						=> 'member/public_user/index',
	'logout'					=> 'member/public_user/logout',
	'user-validation'			=> 'member/public_user/validation',
	'login-execute'				=> 'member/public_user/execute',
	'account/change'			=> 'member/public_account/index',

	//	Blog
	
	'blog'						=> 'blog/public_blog/index',
	'blog/heart'				=> 'blog/public_blog/heart',
	'center'					=> 'blog/public_blog/center',
	'center/(:any)'				=> 'blog/public_blog/center/$1',
	'center/(:any)/(:num)'		=> 'blog/public_blog/center/$1/$2',
	'preview/(:any)/(:any)'		=> 'blog/public_blog/preview/$1/$2',

	//	Post
	'post'								=> 'post/public_post/index',
	'post/(:num)'						=> 'post/public_post/index/$1',
	//'post/categories/(:num)'			=> 'post/public_post/categories/$1',
	'post/preview/([a-zA-Z0-9_-]+)'		=> 'post/public_post/preivew/$1',

	//	Helper
	'helper'							=> 'helper/public_helper/index',
	'helper/list/(:num)'				=> 'helper/public_helper/list/$1',
	'helper/content/(:any)'				=> 'helper/public_helper/content/$1',

	//	Site map
	'post/sitemap'						=> 'post/sitemap/xml',

	//	Honesty
	'honesty'							=> 'honesty/public_preview/index',
	'honesty/preview/(:any)'			=> 'honesty/public_preview/preview/$1',

	'comments/create/(:any)'			=> 'comments/public_post/create/$1',
	'comments/loader/(:any)'			=> 'comments/public_post/loader/$1',
	'comments/prepend/(:any)'			=> 'comments/public_post/prepend/$1',
	'comments/vote/(:any)'				=> 'comments/public_post/uservote/$1',

	//	Page
	'page/([a-zA-Z0-9_-]+)'				=> 'helper/public_helper/page/$1',

	/**
	 * Tool manage
	 */
	//	captcha create
	'captcha-create'		=> 'member/public_user/captcha',

	'404_override'		=> 'home/error404',
];