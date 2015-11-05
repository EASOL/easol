<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class StaffAuthentication extends ORM {

	public $primary_key = 'StaffUSI';
	public $table       = "EASOL.StaffAuthentication";
	public $foreign_key = array('\\model\\edfi\\staff' => 'StaffUSI', '\\model\\easol\\roletype'=> 'RoleId');

	function _init() {

		self::$relationships = [
			'Staff' => ORM::belongs_to('\\Model\\Edfi\\Staff'),
			'Role' => ORM::belongs_to('\\Model\\Easol\\RoleType')
		];

		self::$fields = [
			'StaffUSI' => ORM::field('int'),
			'Password' => ORM::field('char[75]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate' => ORM::field('datetime'),
			'RoleId' => ORM::field('int'),
			'Locked' => ORM::field('int[1]'),
			'GoogleAuth' => ORM::field('int[1]')
		];
	}
}
