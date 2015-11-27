<?php

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
