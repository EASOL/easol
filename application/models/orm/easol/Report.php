<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class Report extends ORM {

	public $primary_key = 'ReportId';
	public $table       = "EASOL.Report";
	public $foreign_key = [
		'\\model\\edfi\\school' => 'SchoolId',
		'\\model\\easol\\reportcategory' => 'ReportCategoryId',
	];

	function _init() {

		self::$relationships = [
			'School' => ORM::belongs_to('\\Model\\Edfi\\School'),
			'ReportCategory' => ORM::belongs_to('\\Model\\Easol\\ReportCategory'),
			'ReportDisplay' => ORM::belongs_to('\\Model\\Easol\\ReportDisplay'),
			'ReportAccess' => ORM::has_many('\\Model\\Easol\\ReportAccess'),
			'ReportFilter' => ORM::has_many('\\Model\\Easol\\ReportFilter')
		];

		self::$fields = [
			'ReportId'         => ORM::field('int[10]'),
			'ReportName'       => ORM::field('[255]'),
			'ReportCategoryId' => ORM::field('int[10]'),
			'CommandText'      => ORM::field('char[255]'),
			'CreatedBy'        => ORM::field('int[10]'),
			'CreatedOn'        => ORM::field('datetime'),
			'UpdatedBy'        => ORM::field('int[10]'),
			'UpdatedOn'        => ORM::field('datetime'),
			'SchoolId'         => ORM::field('int[10]'),
			'LabelX'           => ORM::field('char[50]'),
			'LabelY'           => ORM::field('char[50]'),
		];
	}
}
