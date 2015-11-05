<?php

// The proper name for the class would be "Parent", but we can not use it since it's a reserved word.

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class Parents extends ORM {

	public $table = "edfi.Parent";
	public $primary_key = 'ParentUSI';

	function _init() {

		self::$relationships = [
			'StudentParent'=> ORM::has_many('\\Model\\Edfi\\StudentParent'),
		];

		self::$fields = [
			'ParentUSI'            => ORM::field('int[10]'),
			'PersonalTitlePrefix'  => ORM::field('char[75]'),
			'FirstName'            => ORM::field('char[75]'),
			'MiddleName'           => ORM::field('char[75]'),
			'LastSurname'          => ORM::field('char[75]'),
			'GenerationCodeSuffix' => ORM::field('char[75]'),
			'MaidenName'           => ORM::field('char[75]'),
			'SexTypeId'            => ORM::field('int[10]'),
			'LoginId'              => ORM::field('char[60]'),
			'ParentUniqueId'       => ORM::field('char[32]'),
			'Id'                   => ORM::field('char[255]'),
			'LastModifiedDate'     => ORM::field('datetime'),
			'CreateDate'           => ORM::field('datetime'),
		];
	}
}
