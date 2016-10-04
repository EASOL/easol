<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class RelationType extends ORM {

	public $table = "edfi.RelationType";
	public $primary_key = 'RelationTypeId';

	function _init() 
 {

		self::$relationships = [
			'StudentParent'=> ORM::has_many('\\Model\\Edfi\\StudentParent'),
		];

		self::$fields = [
			'RelationTypeId'   => ORM::field('int[10]'),
			'CodeValue'        => ORM::field('char[50]'),
			'Description'      => ORM::field('char[1024]'),
			'ShortDescription' => ORM::field('char[450]'),
			'Id'               => ORM::field('char[255]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate'       => ORM::field('datetime'),
		];
	}
}
