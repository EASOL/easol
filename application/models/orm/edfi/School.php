<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class School extends ORM {

	public $table = "edfi.School";
	public $primary_key = 'SchoolId';

	public $foreign_key = array('\\model\\edfi\\educationorganization' => 'SchoolId');

	function _init() {

		self::$relationships = [
			'EducationOrganization'=> ORM::belongs_to('\\Model\\Edfi\\EducationOrganization'),
			'Staff' => ORM::has_many('\\Model\\Edfi\\EducationOrganization\\Staff => \\Model\\Edfi\\Staff'),
			'Student' => ORM::has_many('\\Model\\Edfi\\School\\Student => \\Model\\Edfi\\Student'),
			'Cohort' => ORM::has_many('\\Model\\Edfi\\Cohort')
		];

		self::$fields = [
			'SchoolId'                                 => ORM::field('int'),
			'LocalEducationAgencyId'                   => ORM::field('int'),
			'SchoolTypeId'                             => ORM::field('int'),
			'CharterStatusTypeId'                      => ORM::field('int'),
			'TitleIPartASchoolDesignationTypeId'       => ORM::field('int'),
			'MagnetSpecialProgramEmphasisSchoolTypeId' => ORM::field('int'),
			'AdministrativeFundingControlDescriptorId' => ORM::field('int'),
			'InternetAccessTypeId'                     => ORM::field('int')
		];
	}
}
