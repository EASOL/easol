<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class SexType extends ORM {

	public $table = "edfi.SexType";
	public $primary_key = 'SexTypeId';

	function _init() 
 {

		self::$relationships = [
			'Student'=> ORM::has_many('\\Model\\Edfi\\Student'),
		];

		self::$fields = [
			'SexTypeId'        => ORM::field('int[10]'),
			'CodeValue'        => ORM::field('char[50]'),
			'Description'      => ORM::field('char[1024]'),
			'ShortDescription' => ORM::field('char[450]'),
			'Id'               => ORM::field('char[255]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate'       => ORM::field('datetime'),
		];
	}
}
