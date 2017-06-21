<?php

return [
	//	User
	'default_controller'		=> 'user/index',
	'center'					=> 'member/user_center/index',
	'profile'					=> 'member/user_center/profile',
	'security'					=> 'member/user_center/security',

	//	Honesty
	'honesty'				=> 'honesty/user_honesty/index',
	'honesty/helper/(:any)'	=> 'honesty/user_honesty/index/$1',
	'honesty/create'		=> 'honesty/user_honesty/create',
	'honesty/viewinput'		=> 'honesty/user_honesty/viewinput',
	'honesty/execute'		=> 'honesty/user_honesty/execute',

	//	Blog
	'blog'						=> 'blog/user_blog/index',
	'blog/list/(:num)'			=> 'blog/user_blog/list/$1',
	'blog/(:any)'				=> 'blog/user_blog/$1',
	'blog/loader/(:num)'		=> 'blog/user_blog/loader/$1',
	'blog/update/(:num)'		=> 'blog/user_blog/update/$1',
	'blog/editer/(:num)/(:num)'	=> 'blog/user_blog/editer/$1/$2',
	'blog/remove/(:num)/(:num)'	=> 'blog/user_blog/remove/$1/$2',
	'blog/delete/(:num)'		=> 'blog/user_blog/delete/$1',

	'setting'			=> 'blog/user_setting/index',

	'categorie/create'			=> 'blog/user_categories/create',
	'categorie/delete/(:num)'	=> 'blog/user_categories/delete/$1',
	'categorie/update/(:num)'	=> 'blog/user_categories/update/$1',
	'categorie/editer/(:num)'	=> 'blog/user_categories/editer/$1',

	//	Teams
	'join-team'			=> 'member/user_teams/index',

	'expect-help'		=> 'member/user_expect/index',

	//	Message
	'message/send-to/(:any)'	=> 'message/user_message/index/$1',
	'message'					=> 'message/user_message/index',

	//	File
	'upload/avatar'		=> 'file/user_upload/avatar',
	'upload/reality'	=> 'file/user_upload/reality',
	'edite/upload'		=> 'file/user_upload/index',
	'upload/choose'		=> 'file/user_upload/after',
	'recent-img/upload'	=> 'file/user_upload/execute',
	'uploaded/preview'	=> 'file/user_upload/preview',

	'404_override'		=> 'home/error404',
];