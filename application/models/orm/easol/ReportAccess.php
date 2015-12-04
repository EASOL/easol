<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class ReportAccess extends ORM {

	public $primary_key = 'ReportAccessId';
	public $table       = "EASOL.ReportAccess";
	public $foreign_key = [
		'\\model\\easol\\report' => 'ReportId',
		'\\model\\easol\\roletype' => 'RoleTypeId'
	];

	function _init() {

		self::$relationships = [
			'Report' => ORM::belongs_to('\\Model\\Easol\\Report'),
			'RoleType' => ORM::belongs_to('\\Model\\Easol\\RoleType'),
		];

		self::$fields = [
			'ReportAccessId' => ORM::field('int[10]'),
			'ReportId'       => ORM::field('int[10]'),
			'RoleTypeId'     => ORM::field('int[10]'),
		];
	}
}
