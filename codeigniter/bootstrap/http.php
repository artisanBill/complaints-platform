<?php

$hostArray = explode('.', str_replace('www.', '', $_SERVER['HTTP_HOST']));

$retention = [
	'admin'		=> 'system',
	'user'		=> 'member',
];

$route_file = 'default';

if ( isset($retention[$hostArray[0]]) )
{
	$route_file = $retention[$hostArray[0]];
}

$route = include (BOONE . 'codeigniter/bootstrap/http/' . $route_file . '.php');