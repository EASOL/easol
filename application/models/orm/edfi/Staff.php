<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class Staff extends ORM {

	public $table = "edfi.Staff";
	public $primary_key = 'StaffUSI';

	function _init() {

		self::$relationships = [
			'Address' => ORM::has_many('\\Model\\Edfi\\StaffAddress'),
			'Email' => ORM::has_many('\\Model\\Edfi\\StaffEmail'),
			'Authentication' => ORM::has_many('\\Model\\Easol\\StaffAuthentication'),
			'EducationOrganization' => ORM::has_many('\\Model\\Edfi\\EducationOrganization\\Staff => \\Model\\Edfi\\EducationOrganization')
		];

		self::$fields = [
			'StaffUSI' => ORM::field('auto[10]'),
			'PersonalTitlePrefix' => ORM::field('char[75]'),
			'FirstName' => ORM::field('char[75]'),
			'MiddleName' => ORM::field('char[75]'),
			'LastSurname' => ORM::field('char[75]'),
			'GenerationCodeSuffix' => ORM::field('char[75]'),
			'MaidenName' => ORM::field('char[75]'),
			'SexTypeId' => ORM::field('int[1]'),
			'BirthDate' => ORM::field('datetime'),
			'HispanicLatinoEthnicity' => ORM::field('int[1]'),
			'OldEthnicityTypeId' => ORM::field('int[1]'),
			'HighestCompletedLevelOfEducationDescriptorId' => ORM::field('int[1]'),
			'YearsOfPriorProfessionalExperience' => ORM::field('int[1]'),
			'YearsOfPriorTeachingExperience' => ORM::field('int[1]'),
			'HighlyQualifiedTeacher' => ORM::field('int[1]'),
			'LoginId' => ORM::field('char[60]'),
			'CitizenshipStatusTypeId'=> ORM::field('int[1]'),
			'StaffUniqueId' => ORM::field('char[32]'),
			'Id' => ORM::field('char[75]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate' => ORM::field('datetime')
		];
	}
}
