<?php

// baeconfig file,you can config bae correspoing service in this file
return array(
	
	// preloading 'log' component
	'preload'=>array('log'),
    	
	// application components
	 'components'=>array(	
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host='.getenv('HTTP_BAE_ENV_ADDR_SQL_IP').';port='.getenv('HTTP_BAE_ENV_ADDR_SQL_PORT').';dbname=GLJJJhtzrpAHWHTstqYu',
			'username'=>getenv('HTTP_BAE_ENV_AK'),
			'password'=>getenv('HTTP_BAE_ENV_SK'),
			'emulatePrepare' => true,
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
		),
		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CBaeLogRoute',
					'levels'=>'error, warning,trace',
				),
				array(
					'class'=>'CEmailLogRoute',
					'levels'=>'error, warning',
					'queueName'=>'8d51b9cc77dfdee3233856b468d3f243',
					'emails'=>'your_email@baidu.com',
				),
			),
		),
		 'cache'=>array(
            'class'=>'system.caching.CBaeMemCache',
            ),
		),
);
