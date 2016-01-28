<?php

function system_google_auth_enabled() {
	$google_auth = Model\Easol\SystemConfiguration::limit(1)->find_by_key('google_auth', false);

	$google_auth = json_decode($google_auth->Value);

	if ($google_auth->enabled == 'yes') return true;
	return false;
}

function system_google_auth_app_id() {
	$google_auth = Model\Easol\SystemConfiguration::limit(1)->find_by_key('google_auth', false);

	$google_auth = json_decode($google_auth->Value);

	return $google_auth->app_id;
}

function system_variable($variable) {
	$variables = [
		'$CURRENT_EDORG' => Easol_Authentication::userdata("SchoolId"),
		'$CURRENT_YEAR' => date('Y'),
	];

	$value = $variables[$variable];

	if (!$value) $value = $variable;

	return $value;
}