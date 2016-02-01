<?php

function report_types() {
	return ['Free Text'=>'Free Text', 'Static List'=>'Static List', 'Dynamic List'=>'Dynamic List', 'System Variable'=>'System Variable'];
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