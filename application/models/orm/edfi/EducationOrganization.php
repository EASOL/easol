<?php

namespace Model\Edfi;

use \Gas\Core;
use \Gas\ORM;

class EducationOrganization extends ORM {

	public $primary_key = 'EducationOrganizationId';
	public $table = "edfi.EducationOrganization";

	function _init() {

		self::$relationships = [
			'School'=> ORM::has_one('\\Model\\Edfi\\School')
		];

		self::$fields = [
			'EducationOrganizationId' => ORM::field('auto[10]'),
			'StateOrganizationId'     => ORM::field('char[60]'),
			'NameOfInstitution'       => ORM::field('char[75]'),
			'ShortNameOfInstitution'  => ORM::field('char[75]'),
			'WebSite'                 => ORM::field('char[255]'),
			'OperationalStatusTypeId' => ORM::field('int'),
			'Id'                      => ORM::field('char[75]'),
			'LastModifiedDate'        => ORM::field('datetime'),
			'CreateDate'              => ORM::field('datetime')
		];
	}
}
