<?php

return [
	[
		'slug'		=> 'siteName',
		'type'		=> 'text',
		'default'	=> 'Boone inc',
		'options'	=> '',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 10000,
	],

	[
		'slug'		=> 'metaTopic',
		'type'		=> 'text',
		'default'	=> 'Boone inc',
		'options'	=> '',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9998,
	],

	[
		'slug'		=> 'dateFormat',
		'type'		=> 'select',
		'default'	=> 'F j, Y',
		'value'		=> NULL,
		'options'	=> 'l, j F, Y=l, j F, Y|j F, Y=j F, Y|j M, y=j M, y|m/d/Y=m/d/Y|Y-m-d=Y-m-d',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9997,
	],

	[
		'slug'		=> 'recordsPerPage',
		'type'		=> 'select',
		'default'	=> 10,
		'value'		=> FALSE,
		'options'	=> '10=10|25=25|50=50|100=100',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9996,
	],

	[
		'slug'		=> 'siteLnaguage',
		'type'		=> 'select',
		'default'	=> 10,
		'value'		=> '',
		'options'	=> 'func:getSupportedLang',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9995,
	],

	[
		'slug'		=> 'siteLang',
		'type'		=> 'select',
		'default'	=> 10,
		'value'		=> '',
		'options'	=> 'func:getSupportedLang',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9994,
	],

	[
		'slug'		=> 'frontendActive',
		'type'		=> 'radio',
		'default'	=> '',
		'value'		=> '',
		'options'	=> '1=Open|0=Closed',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9993,
	],
	[
		'slug'		=> 'unavailableMessage',
		'type'		=> 'textarea',
		'default'	=> 'Sorry, this website is currently unavailable.',
		'value'		=> '',
		'options'	=> '',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9992,
	],
	[
		'slug'		=> 'robots',
		'type'		=> 'textarea',
		'default'	=> 'User-agent: *
						Disallow:
						Sitemap: ',
		'value'		=> '',
		'options'	=> '',
		'isRequired'=> FALSE,
		'isGui'		=> TRUE,
		'module'	=> 'general',
		'order'		=> 9991,
	],

];