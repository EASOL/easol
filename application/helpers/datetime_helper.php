<?php

function easol_date($date, $format='m/d/Y') {
	if (!$date)
		return NULL;

	$my_date = date('m/d/Y', strtotime($date));

	return $my_date;
}
