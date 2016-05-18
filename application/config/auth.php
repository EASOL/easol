<?php
$config['auth'] = [];

$config['auth']['dashboard'] = [
	"*"=>"*"
];

$config['auth']['student'] = [
	'*' => [
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => [
			'condition' => ['user_has_school']
		],
		'Educator' => [
			'condition' => ['user_has_school']
		]
	],
	
];

$config['auth']['sections'] = [
	'*'=>'*',
	'details'=>[
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => true, 
		'Educator' => [
			'condition' => ['user_has_section']
		]
	]
];

$config['auth']['attendance'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true,'School Administrator' => true]
];

$config['auth']['assessments'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true,'School Administrator' => true]
];

$config['auth']['cohorts'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true,'School Administrator' => true]
];

$config['auth']['schools'] = [
	'*' => [
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => [
			'condition' => ['user_has_school']
		]
	],
	'choose' =>  [ 'System Administrator' => true, 'Data Administrator' => true ]
	
];

$config['auth']['content'] = [
	'*'=>'*'
];

$config['auth']['analytics'] = [
	'*'=>'*'
];

$config['auth']['reports'] = [
	'*'=>[
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => [
			'condition'=> ['report_has_access']
		]
	],
	'edit'=>[
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => false
	],
	'view'=>[
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => [
			'condition'=> ['report_has_access']
		],
		'Educator' => [
			'condition'=> ['report_has_access']
		]
	],
];


$config['auth']['datamanagement'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true]
];

$config['auth']['user'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true]
];

$config['auth']['schoolmanagement'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true]
];

$config['auth']['system'] = [
	'*'=>['System Administrator' => true,'Data Administrator' => true]
];