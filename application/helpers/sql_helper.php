<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('clean_subquery')) {

function clean_subquery($sql) {
	$sql = trim($sql);
	$sql = str_replace(array(";"), "", $sql);

	return $sql;
}

}