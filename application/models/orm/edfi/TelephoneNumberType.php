<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class TelephoneNumberType extends ORM {

	public $table = "edfi.TelephoneNumberType";
	public $primary_key = 'TelephoneNumberTypeId';


	function _init() {

		self::$relationships = [
			'StudentTelephone'=> ORM::has_many('\\Model\\Edfi\\StudentTelephone')
		];

		self::$fields = [
			'TelephoneNumberTypeId' => ORM::field('int[10]'),
			'CodeValue'             => ORM::field('char[50]'),
			'Description'           => ORM::field('char[1024]'),
			'ShortDescription'      => ORM::field('char[450]'),
			'Id'                    => ORM::field('char[255]'),
			'LastModifiedDate'      => ORM::field('datetime'),
			'CreateDate'            => ORM::field('datetime'),
		];
	}
}
