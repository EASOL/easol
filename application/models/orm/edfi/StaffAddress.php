<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class StaffAddress extends ORM {

	public $primary_key = 'StaffUSI';
	public $table = "edfi.StaffAddress";

	public $foreign_key = array('\\model\\edfi\\staff' => 'StaffUSI');

	function _init() 
 {

		self::$relationships = [
			'Staff' => ORM::belongs_to('\\Model\\Edfi\\Staff')
		];

		self::$fields = [

		];
	}
}
