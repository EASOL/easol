<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class User extends ORM {

	public $primary_key = 'StaffUSI';
	public $table       = "Edfi.Staff";

	function _init() 
 {

		self::$relationships = [
			'staff' => ORM::belongs_to('\\Model\\Easol\\StaffAuthentication')
		];

		self::$fields = [
			'StaffUSI' => ORM::field('auto[10]'),
			'Password' => ORM::field('char[75]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate' => ORM::field('datetime'),
			'RoleId' => ORM::field('int'),
			'Locked' => ORM::field('int[1]'),
			'GoogleAuth' => ORM::field('int[1]')
		];
	}
}
