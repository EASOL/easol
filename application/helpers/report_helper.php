<?php

function report_filter_types() 
{
	return ['Free Text'=>'Free Text', 'Static List'=>'Static List', 'Dynamic List'=>'Dynamic List', 'System Variable'=>'System Variable'];
}

function report_display_types() 
{
	return ['table'=>'Table', 'bar-chart'=>'Bar Chart', 'pie-chart'=>'Pie Chart'];
}

function report_display_type($type) 
{
	$types = report_display_types();

	return $types[$type];
}


function report_data_types() 
{
	return ['char'=>'Character', 'string'=>'String', 'int'=>'Integer', 'decimal'=>'Decimal', 'percentage'=>'Percentage'];
}
function report_operators() 
{
	return ['equal' => '=', 'in'=>'IN', 'like'=>'LIKE', 'greater'=>">", 'greater_or_equal'=>">=", 'lesser'=>'<', 'lesser_or_equal'=>'<=', 'between'=>'> AND <', 'between_closed'=>">= AND =<"];
}
function report_value_fits($value, $variable, $operator) 
{
	$function = "report_value_$operator";
	return $function($value, $variable);
}
function report_value_equal($value, $variable) 
{
	return $value == $variable;
}
function report_value_in($value, $variable) 
{
	$variables = explode(",", $variable);
	foreach ($variables as $k=>$v ){
		$variables[$k] = trim($v);
	}

	return in_array($value, $variables);
}
function report_value_like($value, $variable) 
{
	return preg_match("/$variable/i", $value);
}
function report_value_greater($value, $variable) 
{
	return $value > $variable; 
}
function report_value_lesser($value, $variable) 
{
	return $value < $variable;	
}

function report_value_greater_or_equal($value, $variable) 
{
	return $value >= $variable; 
}
function report_value_lesser_or_equal($value, $variable) 
{
	return $value <= $variable;	
}
function report_value_between($value, $variable) 
{

	$variable = explode(";", $variable);
	foreach ($variable as $k=>$v ){
		$variable[$k] = trim($v);
	}
	if (!isset($variable[1])) return report_value_greater($value, $variable[0]);
	return ($value > $variable[0] and $value < $variable[1]);
}
function report_value_between_closed($value, $variable) 
{

	$variable = explode(";", $variable);
	foreach ($variable as $k=>$v ){
		$variable[$k] = trim($v);
	}
	if (!isset($variable[1])) return report_value_greater_or_equal($value, $variable[0]);
	return ($value >= $variable[0] and $value <= $variable[1]);
}


function report_filter_options($list) 
{

	$ci = &get_instance();

	$list = system_variable_filter($list);

	$options = [''=>'All'];
	if (stripos($list, "SELECT") !== FALSE) {

		$query = $ci->db->query($list);
		foreach ($query->result_array() as $row) {
			$keys = array_keys($row);
			$options[$row[$keys[0]]] = $row[$keys[1]];
		}
	}
	else {
		$list = explode(",", $list);
		foreach ($list as $row) {
			$options[$row] = $row;
		}
	}

	return $options;
}

function report_column_link($column_no, $record, $links) 
{
	if (empty($links)) return "";

	$link = NULL;
	foreach ($links as $rec) {
		if ($column_no == $rec->ColumnNo) {
			$link = $rec;
			break;
		}
	}

	if ($link) {
		$link = $link->URL;
		foreach ($record as $column=>$value) {
			$link = str_replace("$".$column, $value, $link);
		}

		return $link;
	}

	return "";
}

function report_colors($type='sequential', $index=FALSE) 
{

	if (!$type) $type = 'sequential';
	$colors = [];
	$colors['sequential'] = [
		['rgb(237,248,251)', 'rgb(178,226,226)', 'rgb(102,194,164)', 'rgb(44,162,95)', 'rgb(0,109,44)'],
		['rgb(237,248,251)', 'rgb(179,205,227)', 'rgb(140,150,198)', 'rgb(136,86,167)', 'rgb(129,15,124)'],
		['rgb(240,249,232)', 'rgb(186,228,188)', 'rgb(123,204,196)', 'rgb(67,162,202)', 'rgb(8,104,172)'],
		['rgb(254,240,217)', 'rgb(253,204,138)', 'rgb(252,141,89)', 'rgb(227,74,51)', 'rgb(179,0,0)'],
		['rgb(241,238,246)', 'rgb(189,201,225)', 'rgb(116,169,207)', 'rgb(43,140,190)', 'rgb(4,90,141)'],
		['rgb(246,239,247)', 'rgb(189,201,225)', 'rgb(103,169,207)', 'rgb(28,144,153)', 'rgb(1,108,89)'],
		['rgb(241,238,246)', 'rgb(215,181,216)', 'rgb(223,101,176)', 'rgb(221,28,119)', 'rgb(152,0,67)'],
		['rgb(254,235,226)', 'rgb(251,180,185)', 'rgb(247,104,161)', 'rgb(197,27,138)', 'rgb(122,1,119)'],
		['rgb(255,255,204)', 'rgb(194,230,153)', 'rgb(120,198,121)', 'rgb(49,163,84)', 'rgb(0,104,55)'],
		['rgb(255,255,204)', 'rgb(161,218,180)', 'rgb(65,182,196)', 'rgb(44,127,184)', 'rgb(37,52,148)'],
		['rgb(255,255,212)', 'rgb(254,217,142)', 'rgb(254,153,41)', 'rgb(217,95,14)', 'rgb(153,52,4)']
	];

	$colors['diverging'] = [
		['rgb(166,97,26)', 'rgb(223,194,125)', 'rgb(245,245,245)', 'rgb(128,205,193)', 'rgb(1,133,113)'],
		['rgb(208,28,139)', 'rgb(241,182,218)', 'rgb(247,247,247)', 'rgb(184,225,134)', 'rgb(77,172,38)']
	];

	if ($index === NULL) $index = 0;

	if ($index !== FALSE) $options = $colors[$type][$index];
	else $options = $colors[$type];

	if (!$options) $options = [];

	return $options;
}
