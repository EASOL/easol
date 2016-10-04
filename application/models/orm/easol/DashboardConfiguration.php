<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class DashboardConfiguration extends ORM {

	public $primary_key = 'DashboardConfigurationId';
	public $table       = "EASOL.DashboardConfiguration";
	public $foreign_key = ['\\model\\edfi\\educationorganization' => 'EducationOrganizationId', '\\model\\easol\\roletype' => 'RoleTypeId'];

	function _init() 
 {

		self::$relationships = [
			'School' => ORM::belongs_to('\\Model\\Edfi\\EducationOrganization'),
			'Role' => ORM::belongs_to('\\Model\\Easol\\RoleType')
		];

		self::$fields = [
			'DashboardConfigurationId' => ORM::field('int[10]'),
			'RoleTypeId'               => ORM::field('int[10]'),
			'EducationOrganizationId'  => ORM::field('int[10]'),
			'LeftChartReportId'        => ORM::field('int[10]'),
			'RightChartReportId'       => ORM::field('int[10]'),
			'BottomTableReportId'      => ORM::field('int[10]'),
			'CreatedBy'                => ORM::field('int[10]'),
			'CreatedOn'                => ORM::field('datetime'),
			'UpdatedBy'                => ORM::field('int[10]'),
			'UpdatedOn'                => ORM::field('datetime'),
		];
	}
}
