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

function system_variables() {
	return [
		'$CURRENT_EDORG' => Easol_Auth::userdata("SchoolId"),
		'$CURRENT_YEAR' => date('Y'),
		'$StaffUSI' => Easol_Auth::userdata("StaffUSI"),
		'$CURRENT_SCHOOLYEAR' => Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR'),
		'$CURRENT_TERMID' => Easol_SchoolConfiguration::getValue('CURRENT_TERMID'),
	];
}
function system_variable($variable=null) {
	$variables = system_variables();

	$value = $variables[$variable];

	if (!$value) $value = $variable;

	return $value;
}

function system_variable_filter($string) {

	$variables = system_variables();
		
	foreach ($variables as $variable=>$value) {
		$string = str_replace($variable, $value, $string);
	}

	return $string;
}

function is_json($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}