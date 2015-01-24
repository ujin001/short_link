<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return [
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'Укротитель УРЛов',

	'preload' => ['log'],

	'import' => [
		'application.models.*',
		'application.components.*',
	],

	'modules' => [
		'gii' => [
			'class' => 'system.gii.GiiModule',
			'password' => '123',
			'ipFilters' => ['127.0.0.1', '::1'],
		],

	],

	'components' => [

		'urlGenerator' => [
			'class' => 'application.components.Bijective',
		],

		'user' => [
			'allowAutoLogin' => true,
		],
		'urlManager' => [
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => [
				'/' => 'default/index',
				'/<hash:\w+>'=>'default/redirect',
			],
		],

		'db' => require(dirname(__FILE__) . '/database.php'),

		'errorHandler' => [
			'errorAction' => 'site/error',
		],

		'log' => [
			'class' => 'CLogRouter',
			'routes' => [
				[
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				],
			],
		],

	],
	'params' => [
		'adminEmail' => 'webmaster@example.com',
	],
];
