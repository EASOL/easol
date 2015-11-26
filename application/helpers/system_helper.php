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
