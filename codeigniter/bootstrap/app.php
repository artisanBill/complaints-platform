<?php

//	Define Sites prefix
define('SITE_PREFIX', 'boone');

//define('BOONE_COOKIE_DOMAIN', '.ibrocade.com');
define('BOONE_COOKIE_DOMAIN', '.itousu.net');
//	
define('ADDONPATH', 'addones');

//	Load automatically loaded library support, And give it a stage name of.
require BOONE . 'vendor/Outshine/Support/Autoloader.php';

//	Add a namespace to load, they are Outshine, Database, Wedget, Streams
Boone\Outshine\Support\Autoloader::addNamespaces([
	'Boone\Outshine'	=> BOONE . 'vendor/Outshine/',
]);

//	Register's the autoloader to the SPL autoload stack.
Boone\Outshine\Support\Autoloader::register();