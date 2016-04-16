<?php
$config['auth'] = [];
$config['auth']['student'] = [
	'*/:id' => [
		'System Administrator' => true,
		'Data Administrator' => true,
		'School Administrator' => [
			'condition' => 'user_has_school'
		]
	],
	
];