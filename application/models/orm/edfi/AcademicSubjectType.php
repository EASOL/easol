<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class AcademicSubjectType extends ORM {

	public $table = "edfi.AcademicSubjectType";
	public $primary_key = 'AcademicSubjectTypeId';

	function _init() 
 {

		self::$relationships = [
			'AcademicSubjectDescriptor'=> ORM::has_many('\\Model\\Edfi\\AcademicSubjectDescriptor'),
		];

		self::$fields = [
			'AcademicSubjectTypeId' => ORM::field('int[10]'),
			'CodeValue'             => ORM::field('char[50]'),
			'Description'           => ORM::field('char[1024]'),
			'ShortDescription'      => ORM::field('char[450]'),
			'Id'                    => ORM::field('char[255]'),
			'LastModifiedDate'      => ORM::field('datetime'),
			'CreateDate'            => ORM::field('datetime'),
		];
	}
}
