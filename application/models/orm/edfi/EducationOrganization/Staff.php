<?php

namespace Model\Edfi\EducationOrganization;

use \Gas\Core;
use \Gas\ORM;

class Staff extends ORM {

	public $primary_key = 'StaffUSI';
	public $table       = "edfi.StaffEducationOrganizationEmploymentAssociation";
	public $foreign_key = array('\\model\\edfi\\educationorganization' => 'EducationOrganizationId', '\\model\\edfi\\staff' => 'StaffUSI');

	function _init() {

		self::$relationships = [
			'EducationOrganization' => ORM::belongs_to('\\Model\\Edfi\\EducationOrganization'),
			'Staff' => ORM::belongs_to('\\Model\\Edfi\\Staff')
		];

		self::$fields = [
			'StaffUSI' => ORM::field('int'),
			'EducationOrganizationId' => ORM::field('int'),
			'EmploymentStatusDescriptorId' => ORM::field('int'),
			'HireDate' => ORM::field('datetime'),
			'EndDate' => ORM::field('datetime'),
			'SeparationTypeId' => ORM::field('int'),
			'SeparationReasonDescriptorId' => ORM::field('int'),
			'Department' => ORM::field('char[3]'),
			'FullTimeEquivalency' => ORM::field('char[45]'),
			'OfferDate' => ORM::field('datetime'),
			'HourlyWage' => ORM::field('char[120]'),
			'Id' => ORM::field('char[255]'),
			'LastModifiedDate' => ORM::field('datetime'),
			'CreateDate'       => ORM::field('datetime')
		];
	}
}
