<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class CohortType extends ORM {

	public $table = "edfi.CohortType";
	public $primary_key = 'CohortTypeId';

	function _init() {

		self::$relationships = [
			'Cohort'=> ORM::has_many('\\Model\\Edfi\\Cohort'),
		];

		self::$fields = [
			'CohortTypeId'     => ORM::field('int[10]'),
			'CodeValue'        => ORM::field('char[50]'),
			'Description'      => ORM::field('char[1024]'),
			'ShortDescription' => ORM::field('char[450]'),
			'Id'               => ORM::field('char[255]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate'       => ORM::field('datetime'),
		];
	}
}
