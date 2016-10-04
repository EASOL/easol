<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class ReportCategory extends ORM {

	public $primary_key = 'ReportCategoryId';
	public $table       = "EASOL.ReportCategory";

	function _init() 
 {

		self::$relationships = [
			'Report' => ORM::has_many('\\Model\\Easol\\Report'),
		];

		self::$fields = [
			'ReportCategoryId'   => ORM::field('int[10]'),
			'ReportCategoryName' => ORM::field('char[255]'),
		];
	}
}
