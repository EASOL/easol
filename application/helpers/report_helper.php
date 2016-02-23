<?php

function report_filter_types() {
	return ['Free Text'=>'Free Text', 'Static List'=>'Static List', 'Dynamic List'=>'Dynamic List', 'System Variable'=>'System Variable'];
}

function report_display_types() {
	return ['table'=>'Table', 'bar-chart'=>'Bar Chart', 'pie-chart'=>'Pie Chart'];
}

function report_display_type($type) {
	$types = report_display_types();

	return $types[$type];
}


function report_data_types() {
	return ['char'=>'Character', 'string'=>'String', 'int'=>'Integer', 'decimal'=>'Decimal', 'percentage'=>'Percentage'];
}
function report_operators() {
	return ['equal' => '=', 'in'=>'IN', 'like'=>'LIKE', 'greater'=>">", 'lesser'=>'<', 'between'=>'> AND <'];
}
function report_value_fits($value, $variable, $operator) {
	$function = "report_value_$operator";
	return $function($value, $variable);
}
function report_value_equal($value, $variable) {
	return $value == $variable;
}
function report_value_in($value, $variable) {
	$variables = explode(",", $variable);
	foreach ($variables as $k=>$v ){
		$variables[$k] = trim($v);
	}

	return in_array($value, $variables);
}
function report_value_like($value, $variable) {
	return preg_match("/$value/i", $variable);
}
function report_value_greater($value, $variable) {
	return $value > $variable; 
}
function report_value_lesser($value, $variable) {
	return $value < $variable;	
}
function report_value_between($value, $variable) {

	$variable = explode("-", $variable);
	foreach ($variable as $k=>$v ){
		$variable[$k] = trim($v);
	}
	if (!isset($variable[1])) return report_value_greater($value, $variable[0]);
	return ($value > $variable[0] and $value < $variable[1]);
}


function report_filter_options($list) {

	$ci = &get_instance();

	$options = [''=>'All'];
	if (stripos($list, "SELECT") !== false) {
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

function report_column_link($column_no, $record, $links) {
	if (empty($links)) return "";

	$link = null;
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