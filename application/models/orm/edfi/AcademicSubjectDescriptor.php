<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class AcademicSubjectDescriptor extends ORM {

	public $table = "edfi.AcademicSubjectDescriptor";
	public $primary_key = 'AcademicSubjectDescriptorId';

	public $foreign_key = [
		'\\model\\edfi\\academicsubjecttype'     => 'AcademicSubjectTypeId',
	];

	function _init() {

		self::$relationships = [
			'Cohort'=> ORM::has_many('\\Model\\Edfi\\Cohort'),
			'AcademicSubjectType'=> ORM::belongs_to('\\Model\\Edfi\\AcademicSubjectType')
		];

		self::$fields = [
			'AcademicSubjectDescriptorId' => ORM::field('int[10]'),
			'AcademicSubjectTypeId'       => ORM::field('int[10]'),
		];
	}
}
