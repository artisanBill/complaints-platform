<?php
/*
|--------------------------------------------------------------------------
| Supported Languages
|--------------------------------------------------------------------------
|
| Contains all languages your site will store data in. Other languages can still be displayed via language files, thats totally different.
|
| Check for HTML equivilents for characters such as � with the URL below:
|    http://htmlhelp.com/reference/html40/entities/latin1.html
|
|
|    array('en'=> 'English', 'fr'=> 'French', 'de'=> 'German')
|
*/
$config['supportedLanguages'] = array(
	'en' => array(
		'name'			=> 'English',
		'folder'		=> 'english',
		'direction'		=> 'ltr',
		'codes'			=> array('en', 'english', 'en_US'),
	),
	'cn' => array(
		'name'			=> '简体中文',
		'folder'		=> 'chineseSimplified',
		'direction'		=> 'ltr',
		'codes'			=> array('cn', 'chinese-simplified', 'zh_CN'),
	),
	'tw' => array(
		'name'			=> '繁體中文',
		'folder'		=> 'chinese_traditional',
		'direction'		=> 'ltr',
		'codes'			=> array('tw', 'chinese-traditional', 'zh_TW'),
	),
);

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| If no language is specified, which one to use? Must be in the array above
|
|    en
|
*/
$config['defaultLanguage'] = 'cn';

/*
|--------------------------------------------------------------------------
| Detect language using Accept-Language
|--------------------------------------------------------------------------
|
| Whether or not to take into account the Accept-Language client header
|
| Only turn it on for admin panel:
| 	$config['checkHttpAcceptLanguage'] = (bool) preg_match('@\/admin(\/.+)?$@', $_SERVER['REQUEST_URI']);
|
*/
$config['checkHttpAcceptLanguage'] = TRUE;
