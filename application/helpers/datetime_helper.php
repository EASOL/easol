<?php

function timezone_listing() {

	// $timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, 'US');
	$timezone_listing = array(
		'America/New_York'    => 'Eastern',
		'America/Chicago'     => 'Central',
		'America/Denver'      => 'Mountain',
		'America/Los_Angeles' => 'Pacific',
		'America/Yakutat'     => 'Alaskan',
		'Pacific/Honolulu'    => 'Hawaiian'
	);

	return $timezone_listing;
}

function easol_date($date, $format='m/d/Y') {
	if (!$date)
		return NULL;

	$my_date = date('m/d/Y', strtotime($date));

	return $my_date;
}
