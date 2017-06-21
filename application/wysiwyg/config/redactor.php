
<?php

$config = [
	'buttons'		=> [
		'format'			=> ['icon' => 'fa fa-paragraph'],
		'bold'				=> ['icon' => 'fa fa-bold'],
		'italic'			=> ['icon' => 'fa fa-italic'],
		'deleted'			=> ['icon' => 'fa fa-strikethrough'],
		'lists'				=> ['icon' => 'fa fa-list'],
		'link'				=> ['icon' => 'fa fa-link'],
		'horizontalrule'	=> ['icon' => 'fa fa-minus'],
		'underline'			=> ['icon' => 'fa fa-underline'],
	],

	'plugins'		=> [
		'alignment'	=> [
			'icon'	=> 'fa fa-align-left',
			'scripts' => [
				'boone.wysiwyg::js/plugins/alignment/alignment.js'
			],
			'styles'  => [
				'boone.wysiwyg::js/plugins/alignment/alignment.css'
			]
		],
		'inlinestyle'  => [
			'button'  => 'inline',
			'icon'	=> 'fa fa-quote-right',
			'scripts' => [
				'boone.wysiwyg::js/plugins/inlinestyle.js'
			]
		],
		'table'		=> [
			'icon'	=> 'fa fa-table',
			'scripts' => [
				'boone.wysiwyg::js/plugins/table.js'
			]
		],
		'video'		=> [
			'icon'	=> 'fa fa-video-camera',
			'scripts' => [
				'boone.wysiwyg::js/plugins/video.js'
			]
		],
		'filemanager'  => [
			'icon'	=> 'fa fa-paperclip',
			'scripts' => [
				'boone.wysiwyg::js/plugins/filemanager.js'
			]
		],
		'imagemanager' => [
			'icon'	=> 'fa fa-picture-o',
			'scripts' => [
				'boone.wysiwyg::js/plugins/imagemanager.js'
			]
		],
		'source'	   => [
			'icon'	=> 'fa fa-code',
			'scripts' => [
				'boone.wysiwyg::js/plugins/source.js'
			]
		],
		'fullscreen'   => [
			'icon'	=> 'fa fa-arrows-alt',
			'scripts' => [
				'boone.wysiwyg::js/plugins/fullscreen.js'
			]
		]
	],
	'configurations' => [
		'default' => [
			'buttons' => [
				'bold',
				'italic',
				'deleted',
				'lists',
				'link',
				'format',
				'horizontalrule',
				'underline'
			],
			'plugins' => [
				'source',
				'table',
				'video',
				'inlinestyle',
				'filemanager',
				'imagemanager',
				'fullscreen',
				'alignment'
			]
		],
		'basic'   => [
			'buttons' => [
				'bold',
				'italic',
				'lists',
				'link',
				'underline'
			],
			'plugins' => [
				'fullscreen'
			]
		]
	],
	'height'      => [
        'type'     => 'boone.integer',
        'required' => true,
        'config'   => [
            'step' => 50,
            'min'  => 200
        ]
    ],
];
