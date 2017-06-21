<?php

/**
 *	Class settings.php
 *
 *	@link			http://boone.red
 *	@author			Boone <ililianjin@iCloud.com>
 *	@author			Outshine Development Team <outshine@boone.red>
 *	@version		1.0.0
 *	@package		/developer/wwwroot/bcms.com/itousu/application/comments/settings.php
 */

return [
	[
		'slug' => 'enableComments',
		'type' => 'radio',
		'default' => true,
		'value' => true,
		'options' => '1=Enabled|0=Disabled',
		'isRequired' => 1,
		'isGui' => 1,
		'module' => 'comments',
		'order' => 968,
	],
	[
		'slug' => 'commentOrder',
		'type' => 'select',
		'default' => 'ASC',
		'value' => 'ASC',
		'options' => 'ASC=Oldest First|DESC=Newest First',
		'isRequired' => 1,
		'isGui' => 1,
		'module' => 'comments',
		'order' => 966,
	],
	[
		'slug' => 'commentMarkdown',
		'type' => 'select',
		'default' => '0',
		'value' => '0',
		'options' => '0=Text Only|1=Allow Markdown',
		'isRequired' => 1,
		'isGui' => 1,
		'module' => 'comments',
		'order' => 965,
	],
];