<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'reports/create'=>array(
		array(
			'field' => 'report[CommandText]',
			'label' => 'Command Text',
			'rules' => 'trim|required|is_safe_query'
		)
	),
	'reports/edit'=>array(
		array(
			'field' => 'report[CommandText]',
			'label' => 'Command Text',
			'rules' => 'trim|required|is_safe_query'
		)
	),
	'reports/preview'=>array(
		array(
			'field' => 'report[CommandText]',
			'label' => 'Command Text',
			'rules' => 'trim|required|is_safe_query'
		)
	)
);