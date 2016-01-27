<?php

function report_types() {
	return ['Free Text'=>'Free Text', 'Static List'=>'Static List', 'Dynamic List'=>'Dynamic List', 'System Variable'=>'System Variable'];
}
function report_valueColumn() {
	return ['Column 3'=>'Column 3', '/student/profile/$variable'=>'/student/profile/$variable', 'Column 1'=>'Column 1'];
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