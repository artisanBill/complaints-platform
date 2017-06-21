<?php

return [
	'default_controller'	=> 'admin',
	'logout'				=> 'admin/logout',

	//	Helper
	'helper/(:any)'			=> '$1/admin_helper/index',

	//	Modules index page

	//	dashboard
	'home'					=> 'dashboard/admin_panel',
	'application'			=> 'dashboard/admin_addons',
	'root'					=> 'dashboard/admin_root',
	'setting'				=> 'dashboard/admin_setting',
	'content'				=> 'dashboard/admin_content',
	'structure'				=> 'dashboard/admin_structure',
	'data'					=> 'dashboard/admin_data',

	//	addon
	'application/addon'					=> 'addon/admin_app',
	'application/addon/info/(:any)'		=> 'addon/admin_app/info/$1',
	'application/addon/install/(:any)'	=> 'addon/admin_app/install/$1',

	//	Database
	'application/database'				=> 'database/admin_basic/index',

	//	Logs
	'application/inspector'				=> 'inspector/admin_logger/index',

	//	File
	'content/file'						=> 'file/admin_file/index',
	'content/file/delete'				=> 'file/admin_file/delete',
	'content/file/preview/(:any)'		=> 'file/admin_file/preview/$1',
	'content/file/folder'				=> 'file/admin_folder/index',
	'content/file/folder/create'		=> 'file/admin_folder/create',
	'content/file/folder/change'		=> 'file/admin_folder/change',
	'content/file/upload/(:num)'		=> 'file/admin_upload/index/$1',
	'content/file/upload/recent'		=> 'file/admin_upload/recent',
	'content/file/upload/preview'		=> 'file/admin_upload/preview',

	//	Uploader ile
	'content/file/upload-file'			=> 'file/admin_imageuploader/index',
	'content/file/upload-selected'		=> 'file/admin_imageuploader/selected',
	'content/file/upload-execute'		=> 'file/admin_imageuploader/upload',
	'content/file/upload-preview'		=> 'file/admin_imageuploader/preview',
	'content/file/upload-choose'		=> 'file/admin_imageuploader/choose',

	//	Post
	'content/post'							=> 'post/admin_post',
	'content/post/change'					=> 'post/admin_post/change',
	'content/post/delete'					=> 'post/admin_post/delete',
	'content/post/create/(:num)'			=> 'post/admin_post/create/$1',

	'content/post/categories'				=> 'post/admin_categories',
	'content/post/categories/create'		=> 'post/admin_categories/create',
	'content/post/categories/create/(:num)'	=> 'post/admin_categories/create/$1',
	'content/post/categories/edit/(:num)'	=> 'post/admin_categories/edit/$1',
	'content/post/categories/delete'		=> 'post/admin_categories/delete',
	'content/post/categories/change'		=> 'post/admin_categories/change',

	'content/helper'							=> 'helper/admin_helper/index',
	'content/helper/change'						=> 'helper/admin_helper/change',
	'content/helper/create/(:num)'				=> 'helper/admin_helper/create/$1',
	'content/helper/categories'					=> 'helper/admin_categories/index',
	'content/helper/categories/change'			=> 'helper/admin_categories/change',
	'content/helper/categories/create'			=> 'helper/admin_categories/create',
	'content/helper/categories/create/(:num)'	=> 'helper/admin_categories/create/$1',

	//	Honesty
	'data/honesty'		=> 'honesty/admin_censor/index',

	//	Users
	'root/users'							=> 'users/admin_user',
	'root/users/profile/(:num)'				=> 'users/admin_profile/index/$1',
	'root/users/teams'						=> 'users/admin_group/index',
	'root/users/teams/create'				=> 'users/admin_group/create',
	'root/users/teams/permissions/(:num)'	=> 'users/admin_group/permissions/$1',

	//	Members
	'root/member'					=> 'member/admin_member',
	'root/member/accessment'		=> 'member/admin_teams/index',
	'root/member/profile/(:num)'	=> 'member/admin_teams/profile/$1',
	'root/member/pass/(:num)'		=> 'member/admin_teams/pass/$1',

	//	Setting
	'setting/settings'					=> 'settings/admin_basic/index/general',
	'setting/settings/(:any)'			=> 'settings/admin_basic/index/$1',
	'setting/settings/update/(:any)'	=> 'settings/admin_basic/update/$1',

	//	Wysiwyg
	'setting/wysiwyg'					=> 'wysiwyg/admin_wysiwyg/index',
	'setting/wysiwyg/create'			=> 'wysiwyg/admin_wysiwyg/create',
];