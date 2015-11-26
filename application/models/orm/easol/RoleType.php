<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class RoleType extends ORM {

	public $primary_key = 'RoleTypeId';
	public $table       = "EASOL.RoleType";

	function _init() {

		self::$relationships = [
			'StaffAuthentication'  => ORM::has_many('\\Model\\Easol\\StaffAuthentication'),
			'ReportAccess' => ORM::has_many('\\Model\\Easol\\ReportAccess'),
			'DashboardConfiguration' => ORM::has_many('\\Model\\Easol\\DashboardConfiguration'),
		];

		self::$fields = [
			"RoleTypeId"   => ORM::field('int'),
			"RoleTypeName" => ORM::field('char[75]')
		];
	}
}
