<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

$config['menu'] = [
	'dashboard' => [
		'label' => 'Dashboard',
		'icon'  => 'dashboard',
		'attr'  => 'data-intro="Dashboard: Customized reporting tool per school for administrators and teachers" data-position="right"',
		'auth'  => '@'
	],
	'student'=>[
		'label'=>'Students',
		'icon'=>'graduation-cap',
		'auth'=> ['System Administrator', 'Data Administrator','School Administrator','Educator'],
		'group'=>'student',
	],
	'sections' => [
		'label' => 'Sections',
		'icon'  => 'edit',
		'group' => 'student',
	],
	'attendance' => [
		'label' => 'Attendance',
		'icon' => 'qrcode',
		'auth' => ['System Administrator', 'Data Administrator','School Administrator'],
		'group' => 'student',
	],
	'assessments' => [
		'label' => 'Assessments',
		'icon'  => 'table',
		'auth'  => ['System Administrator', 'Data Administrator','School Administrator'],
		'group' => 'student',
	],
	'cohorts' => [
		'label' => 'Cohorts',
		'icon'  => 'cubes',
		'auth'  => ['System Administrator', 'Data Administrator','School Administrator'],
		'group' => 'student',
	],
	'learning-lab' => [
		'label' => 'Learning Lab',
		'url' => '#',
		'attr' => 'data-intro="Learning Lab: Free, Open Education Resources (OER) for supplemental classroom use with usage analytics" data-position="right"',
		'icon'=>'table2',
		'auth'=>"@"
	],
	'content' => [
		'label' => 'Content',
		'parent' => 'learning-lab'
	],
	'analytics' => [
		'label'  => 'Analytics',
		'parent' => 'learning-lab'
	],
	'reports' => [
		'label' => 'Flex Reports',
		'attr' => 'data-intro="Flex Reports:  customized and dynamic reporting based on school needs" data-position="right"',
		'icon'  => 'bar-chart',
		'auth'  => ['System Administrator', 'Data Administrator','School Administrator','Educator']
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
	'management/user' => [
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

$config['menu_group'] = [
	'student'=>[
		'attr'=>'data-intro="Student Data Management: View students, sections and grades, attendance and assessments" data-position="right"'
	]
];
