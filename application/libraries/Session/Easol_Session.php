<?php


class Easol_Session extends CI_Session {
	public function __construct() {
		parent::__construct();
	}

	public function userdata($key=null) {
		if (ENVIRONMENT == 'testing') {
			return $data = [
				'LoginId'   => 207219,
				'StaffUSI'  => 2072019,
				'RoleId'    => 1,
				'logged_in' => true,
				'SchoolId'  => 255901001
			];
		}
		else {
			return parent::userdata($key);
		}
	}
}
