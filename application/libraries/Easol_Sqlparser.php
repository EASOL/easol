<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Easol_SQLParser {
	public function __construct() {
		require_once('PHP-SQL-Parser/src/PHPSQLParser.php');
		require_once('PHP-SQL-Parser/src/PHPSQLCreator.php');
	}

	public function Parse($sql) {
		$parser = new PHPSQLParser($sql);

  		return $parser->parsed; 
	}

	public function Create($parsedSQL) {

		$creator = new PHPSQLCreator();
		$creator->create($parsedSQL); 
		
		return $save = $creator->created;
	}
}