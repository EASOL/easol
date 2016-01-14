<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class ReportFilter extends ORM {

	public $primary_key = 'ReportFilterId';
	public $table       = "EASOL.ReportFilter";
	public $foreign_key = [
		'\\model\\easol\\report' => 'ReportId'
	];

	function _init() {

		self::$relationships = [
			'Report' => ORM::belongs_to('\\Model\\Easol\\Report')
		];

		self::$fields = [
			'ReportFilterId' => ORM::field('int[10]'),
			'ReportId'       => ORM::field('int[10]'),
			'DisplayName'     => ORM::field('char[75]'),
			'FieldName'     => ORM::field('char[75]'),
			'FieldType'     => ORM::field('char[75]'),
			'FilterOptions'     => ORM::field('char'),
			'DefaultValue'     => ORM::field('char[75]'),
		];
	}
}
