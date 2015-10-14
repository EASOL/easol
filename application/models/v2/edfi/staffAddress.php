<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class StaffAddress extends ORM {

	public $primary_key = 'StaffUSI';
	public $table = "edfi.StaffAddress";

	function _init() {

		self::$relationships = [
			'address' => ORM::belongs_to('\\Model\\Staff')
		];
	}
}
