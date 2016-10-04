<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StudentEmail extends ORM {

	public $primary_key = 'StudentUSI';
	public $table = "edfi.StudentElectronicMail";

	public $foreign_key = [
		'\\model\\edfi\\student' => 'StudentUSI'
	];

	function _init() 
 {

		self::$relationships = [
			'Student' => ORM::belongs_to('\\Model\\Edfi\\Student')
		];

		self::$fields = [
			'StudentUSI'                   => ORM::field('int[10]'),
			'ElectronicMailTypeId'         => ORM::field('int[10]'),
			'ElectronicMailAddress'        => ORM::field('char[128]'),
			'PrimaryEmailAddressIndicator' => ORM::field('numeric'),
			'CreateDate'                   => ORM::field('datetime'),
		];
	}
}
