<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class Cohort extends ORM {

	public $table = "edfi.Cohort";
	public $primary_key = 'EducationOrganizationId';

	public $foreign_key = [
		'\\model\\edfi\\educationorganization' => 'EducationOrganizationId',
		'\\model\\edfi\\cohorttype' => 'CohortTypeId',
		'\\model\edfi\\cohortscopetype' => 'CohortScopeTypeId',
		'\\model\\edfi\\academicsubjectdescriptor' => 'AcademicSubjectDescriptorId',
	];

	function _init() {

		self::$relationships = [
			'School'=> ORM::belongs_to('\\Model\\Edfi\\EducationOrganizationId'),
			'CohortType'=> ORM::belongs_to('\\Model\\Edfi\\CohortType'),
			'CohortScopeType' => ORM::belongs_to('\\Model\\Edfi\\CohortScopeType'),
			'AcademicSubjectDescriptor' => ORM::belongs_to('\\Model\\Edfi\\AcademicSubjectDescriptior'),
		];

		self::$fields = [
			'EducationOrganizationId'     => ORM::field('int[10]'),
			'CohortIdentifier'            => ORM::field('char[20]'),
			'CohortDescription'           => ORM::field('char[1024]'),
			'CohortTypeId'                => ORM::field('int[10]'),
			'CohortScopeTypeId'           => ORM::field('int[10]'),
			'AcademicSubjectDescriptorId' => ORM::field('int[10]'),
			'Id'                          => ORM::field('char[255]'),
			'LastModifiedDate'            => ORM::field('datetime'),
			'CreateDate'                  => ORM::field('datetime'),
		];
	}
}
