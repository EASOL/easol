<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class SchoolConfiguration extends ORM {

	public $primary_key = 'EducationOrganizationId';
	public $table       = "EASOL.SchoolConfiguration";
	public $foreign_key = array('\\model\\edfi\\educationorganization' => 'EducationOrganizationId');

	function _init() 
 {

		self::$relationships = [
			'school' => ORM::belongs_to('\\Model\\Edfi\\EducationOrganization')
		];

		self::$fields = array(
			'EducationOrganizationId' => ORM::field('int[10]'),
			'Key'                     => ORM::field('char[255]'),
			'Value'                   => ORM::field('char[255]'),
		);
	}
}
