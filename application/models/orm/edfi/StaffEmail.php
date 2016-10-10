<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StaffEmail extends ORM {

	public $primary_key = 'StaffUSI';
	public $table = "edfi.StaffElectronicMail";

	public $foreign_key = array('\\model\\edfi\\staff' => 'StaffUSI');

	function _init() 
 {

		self::$relationships = [
			'Staff' => ORM::belongs_to('\\Model\\Edfi\\Staff')
		];

		self::$fields = [
			'StaffUSI'                     => ORM::field('int'),
			'ElectronicMailTypeId'         => ORM::field('int'),
			'ElectronicMailAddress'        => ORM::field('char[128]'),
			'PrimaryEmailAddressIndicator' => ORM::field('int[1]'),
			'CreateDate'                   => ORM::field('datetime')
		];
	}
}
