<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class StudentRace extends ORM {

	public $table = "edfi.StudentRace";
	public $primary_key = 'StudentUSI';

	public $foreign_key = [
		'\\model\\edfi\\student' => 'StudentUSI',
		'\\model\\edfi\\racetype' => 'RaceTypeId',
	];

	function _init() 
 {

		self::$relationships = [
			'Student'=> ORM::belongs_to('\\Model\\Edfi\\Student'),
			'RaceTypeId'=> ORM::belongs_to('\\Model\\Edfi\\RaceType')
		];

		self::$fields = [
			'StudentUSI' => ORM::field('int[10]'),
			'RaceTypeId' => ORM::field('int[10]'),
			'CreateDate' => ORM::field('datetime'),
		];
	}
}
