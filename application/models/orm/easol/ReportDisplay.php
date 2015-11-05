<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class ReportDisplay extends ORM {

	public $primary_key = 'ReportDisplayId';
	public $table       = "EASOL.ReportDisplay";

	function _init() {

		self::$relationships = [
			'Report' => ORM::has_many('\\Model\\Easol\\Report'),
		];

		self::$fields = [
			'ReportDisplayId' => ORM::field('int[10]'),
			'DisplayName'     => ORM::field('char[255]'),
		];
	}
}
