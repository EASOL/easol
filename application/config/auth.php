<?php
$config['auth'] = [];

$config['auth']['dashboard'] = [
	"*"=>"*"
];

$config['auth']['student'] = [
	'*' => [
		'System Administrator' => TRUE,
		'Data Administrator' => TRUE,
		'School Administrator' => [
			'condition' => ['user_has_school']
		]
	],
	
];

$config['auth']['sections'] = [
	'*'=>'*'
];

$config['auth']['attendance'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE,'School Administrator' => TRUE]
];

$config['auth']['assessments'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE,'School Administrator' => TRUE]
];

$config['auth']['cohorts'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE,'School Administrator' => TRUE]
];
$config['auth']['cron'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE,'School Administrator' => TRUE]
];

$config['auth']['schools'] = [
	'*' => [
		'System Administrator' => TRUE,
		'Data Administrator' => TRUE,
		'School Administrator' => [
			'condition' => ['user_has_school']
		]
	],
	'choose' =>  [ 'System Administrator' => TRUE, 'Data Administrator' => TRUE ]
	
];

$config['auth']['content'] = [
	'*'=>'*'
];

$config['auth']['analytics'] = [
	'*'=>'*'
];

$config['auth']['reports'] = [
	'*'=>[
		'System Administrator' => TRUE,
		'Data Administrator' => TRUE,
		'School Administrator' => [
			'condition'=> ['report_has_access']
		]
	],
	'edit'=>[
		'System Administrator' => TRUE,
		'Data Administrator' => TRUE,
		'School Administrator' => FALSE
	],
	'view'=>[
		'System Administrator' => TRUE,
		'Data Administrator' => TRUE,
		'School Administrator' => [
			'condition'=> ['report_has_access']
		],
		'Educator' => [
			'condition'=> ['report_has_access']
		]
	],
];


$config['auth']['datamanagement'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE]
];

$config['auth']['user'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE]
];

$config['auth']['schoolmanagement'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE]
];

$config['auth']['system'] = [
	'*'=>['System Administrator' => TRUE,'Data Administrator' => TRUE]
];
