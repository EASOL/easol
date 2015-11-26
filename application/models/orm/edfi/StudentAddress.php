<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StudentAddress extends ORM {

	public $table = "edfi.StudentAddress";
	public $primary_key = 'StudentUSI';

	public $foreign_key = [
		'\\model\\edfi\\student' => 'StudentUSI',
		'\\model\\edfi\\addresstype' => 'AddressTypeId',
	];

	function _init() {

		self::$relationships = [
			'Student'=> ORM::belongs_to('\\Model\\Edfi\\Student'),
			'AddressType'=> ORM::belongs_to('\\Model\\Edfi\\AddressType')
		];

		self::$fields = [
			'StudentUSI'               => ORM::field('int[10]'),
			'AddressTypeId'            => ORM::field('int[10]'),
			'StreetNumberName'         => ORM::field('char[150]'),
			'ApartmentRoomSuiteNumber' => ORM::field('char[50]'),
			'BuildingSiteNumber'       => ORM::field('char[20]'),
			'City'                     => ORM::field('char[30]'),
			'StateAbbreviationTypeId'  => ORM::field('int[10]'),
			'PostalCode'               => ORM::field('char[17]'),
			'NameOfCounty'             => ORM::field('char[30]'),
			'CountyFIPSCode'           => ORM::field('char[5]'),
			'Latitude'                 => ORM::field('char[20]'),
			'Longitude'                => ORM::field('char[20]'),
			'BeginDate'                => ORM::field('datetime'),
			'EndDate'                  => ORM::field('datetime'),
			'CreateDate'               => ORM::field('datetime'),
		];
	}
}
