<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class RaceType extends ORM {

	public $table = "edfi.RaceType";
	public $primary_key = 'RaceTypeId';


	function _init() {

		self::$relationships = [
			'StudentRace'=> ORM::has_many('\\Model\\Edfi\\StudentRace'),
		];

		self::$fields = [
			'RaceTypeId'       => ORM::field('int[10]'),
			'CodeValue'        => ORM::field('char[50]'),
			'Description'      => ORM::field('char[1024]'),
			'ShortDescription' => ORM::field('char[450]'),
			'Id'               => ORM::field('char[255]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate'       => ORM::field('datetime'),
		];
	}
}
