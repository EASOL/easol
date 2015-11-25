<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

$config['menu'] = [
	'dashboard' => [
		'label' => 'Dashboard',
		'icon'  => 'dashboard',
		'auth'  => ['System Administrator', 'Data Administrator']
	],
	'student'=>[
		'label'=>'Students',
		'icon'=>'graduation-cap',
		'auth'=> ['System Administrator', 'Data Administrator']
	],
	'sections' => [
		'label' => 'Sections',
		'icon'  => 'edit'
	],
	'attendance' => [
		'label' => 'Attendance',
		'icon' => 'qrcode',
		'auth' => ['System Administrator', 'Data Administrator']
	],
	'assessments' => [
		'label' => 'Assessments',
		'icon'  => 'table',
		'auth'  => ['System Administrator', 'Data Administrator']
	],
	'learning-lab' => [
		'label' => 'Learning Lab',
		'url' => '#',
		'attr' => 'data-intro="Learning Lab: Free, Open Education Resources (OER) for supplemental classroom use with usage analytics" data-position="right"',
		'icon'=>'table2'
	],
	'content' => [
		'label' => 'Content',
		'parent' => 'learning-lab'
	],
	'analytics' => [
		'label'  => 'Analytics',
		'parent' => 'learning-lab'
	],
	'cohorts' => [
		'label' => 'Cohorts',
		'icon'  => 'cubes',
		'auth'  => ['System Administrator', 'Data Administrator']
	],
	'reports' => [
		'label' => 'Flex Reports',
		'attr' => 'data-intro="Flex Reports:  customized and dynamic reporting based on school needs" data-position="right"',
		'icon'  => 'bar-chart',
		'auth'  => ['System Administrator', 'Data Administrator']
	],
	'management' => [
		'label' => 'Management',
		'url'   => '#',
		'icon'  => 'sliders',
		'auth' => ['System Administrator', 'Data Administrator']
	],
	'datamanagement' => [
		'label'  => 'Data',
		'parent' => 'management'
	],
	'usermanagement' => [
		'label'  => 'User',
		'parent' => 'management'
	],
	'schoolmanagement' => [
		'label'  => 'School',
		'parent' => 'management'
	],
	'management/system' => [
		'label'  => 'System',
		'parent' => 'management'
	]
];
