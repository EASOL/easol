<?php

function set_timezone() 
{

	$timezone     = get_timezone();
	date_default_timezone_set($timezone);
}

function get_timezone() 
{

	$timezone = Model\Easol\SystemConfiguration::limit(1)->find_by_key('timezone', FALSE);
	if ($timezone) {
		$timezone         = json_decode($timezone->Value);
		$timezone_listing = timezone_listing();
		if (isset($timezone_listing[$timezone])) {
			return $timezone_listing[$timezone];
		}
	}

	return date_default_timezone_get();

}


function timezone_listing() 
{

	$timezone_listing = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

	return $timezone_listing;
}

function easol_date($date, $format='m/d/Y') 
{
	if (!$date)
		return NULL;

	$my_date = date('m/d/Y', strtotime($date));

	return $my_date;
}

function easol_time($time, $timezone=NULL) 
{

	if (!$timezone) {
		$timezone = get_timezone();
	}

	$date = new DateTime(date("Y-m-d ") . $time);
	$date->setTimezone(new DateTimeZone($timezone));

	return $date->format('H:i:s.u');

}

function easol_datetime_from_utc($time, $timezone=NULL) 
{
	if (!$timezone) {
		$timezone = get_timezone();
	}

	$dt = new DateTime($time, new DateTimeZone('UTC'));
	$dt->setTimeZone(new DateTimeZone($timezone));

	return $dt->format('m/d/Y H:i:s');
}
