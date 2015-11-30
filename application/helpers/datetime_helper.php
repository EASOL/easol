<?php

function set_timezone() {
	//$ini_timezone = date_default_timezone_get();
	$timezone     = Model\Easol\SystemConfiguration::limit(1)->find_by_key('timezone', false);
	if ($timezone) {
		$timezone = json_decode($timezone->Value);
		$timezone_listing = timezone_listing();
		if (isset($timezone_listing[$timezone])) {
			date_default_timezone_set($timezone_listing[$timezone]);
		}
	}
}


function timezone_listing() {

	$timezone_listing = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

	return $timezone_listing;
}

function easol_date($date, $format='m/d/Y') {
	if (!$date)
		return NULL;

	$my_date = date('m/d/Y', strtotime($date));

	return $my_date;
}
