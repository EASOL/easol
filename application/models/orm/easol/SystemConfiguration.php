<?php

namespace Model\Easol;

use \Gas\Core;
use \Gas\ORM;

class SystemConfiguration extends ORM {

	public $primary_key = 'SystemConfigurationId';
	public $table       = "EASOL.SystemConfiguration";

	function _init() {

		self::$fields = [
			'SystemConfigurationId' => ORM::field('int[10]'),
			'Key' => ORM::field('char[255]'),
			'Value' => ORM::field('char[255]'),
			'CreatedBy' => ORM::field('int[10]'),
			'CreatedOn' => ORM::field('datetime'),
			'UpdatedBy' => ORM::field('int[10]'),
			'UpdatedOn' => ORM::field('datetime'),
		];
	}
}
