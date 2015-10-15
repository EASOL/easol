<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class RoleType extends ORM {

	public $primary_key = 'RoleTypeId';
	public $table       = "EASOL.RoleType";

	function _init() {

		self::$relationships = [
			'staffAuthentication'  => ORM::has_many('\\Model\\Easol\\StaffAuthentication'),
		];

		self::$fields = [
			"RoleTypeId"   => ORM::field('int'),
			"RoleTypeName" => ORM::field('char[75]')
		];
	}
}
