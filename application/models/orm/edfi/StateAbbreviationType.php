<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StateAbbreviationType extends ORM {

	public $table = "edfi.StateAbbreviationType";
	public $primary_key = 'StateAbbreviationTypeId';

	function _init() {

		self::$relationships = [
			'Student'=> ORM::has_many('\\Model\\Edfi\\Student'),
		];

		self::$fields = [
			'StateAbbreviationTypeId' => ORM::field('int[10]'),
			'CodeValue'               => ORM::field('char[50]'),
			'Description'             => ORM::field('char[1024]'),
			'ShortDescription'        => ORM::field('char[450]'),
			'Id'                      => ORM::field('char[255]'),
			'LastModifiedDate'        => ORM::field('datetime'),
			'CreateDate'              => ORM::field('datetime'),
		];
	}
}
