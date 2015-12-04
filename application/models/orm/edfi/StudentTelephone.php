<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StudentTelephone extends ORM {

	public $table = "edfi.StudentTelephone";
	public $primary_key = 'StudentUSI';

	public $foreign_key = [
		'\\model\\edfi\\student' => 'StudentUSI',
		'\\model\\edfi\\telephonenumbertype' => 'TelephoneNumberTypeId',
	];

	function _init() {

		self::$relationships = [
			'Student'=> ORM::belongs_to('\\Model\\Edfi\\Student'),
			'TelephoneNumberType'=> ORM::belongs_to('\\Model\\Edfi\\TelephoneNumberType')
		];

		self::$fields = [
			'StudentUSI'                     => ORM::field('int[10]'),
			'TelephoneNumberTypeId'          => ORM::field('int[10]'),
			'OrderOfPriority'                => ORM::field('int[10]'),
			'TextMessageCapabilityIndicator' => ORM::field('numeric'),
			'TelephoneNumber'                => ORM::field('char[24]'),
			'CreateDate'                     => ORM::field('datetime'),
		];
	}
}
