<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);

class Tools extends Easol_Controller {


    protected function accessRules(){
	    return [
		    "index" => ['System Administrator', 'Data Administrator'],
	    ];
    }

    public function test() {

	    chdir(APPPATH . "tests");
	    system("php phpunit.phar", $output );

	    echo $output;
    }

	public function reset_db() {

		$command = "sqlcmd -S {$this->db->hostname} ";
		if ($this->db->username) $command .= "-U {$this->db->username} ";
		if ($this->db->password) $command .= "-P {$this->db->password}";
		system($command." -i " . APPPATH . "tests/database.sql");
	}

	public function orm() {

		$map = array(
			'auto' => '',
			'char' => '',
			'email' => '',
			'int' => 'bigint,numeric,bit,smallint,decimal,smallmoney,int,tinyint,money',
			'string' => '',
			'spatial' => '',
			'numeric' => '',
			'datetime' => ''
		);

		$query = "SELECT * FROM information_schema.tables";
		$query = $this->db->query($query);

		foreach ($query->result() as $row) {
			print_r($row);

			$file = APPPATH."models/metadata/{$row->TABLE_SCHEMA}.{$row->TABLE_NAME}.json";

			if (file_exists($file)) $metadata = json_decode(file_get_contents($file));
			else $metadata = array();

			$metadata['table'] = "{$row->TABLE_SCHEMA}.{$row->TABLE_NAME}";

			$pk = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE OBJECTPROPERTY(OBJECT_ID(CONSTRAINT_SCHEMA + '.' + CONSTRAINT_NAME), 'IsPrimaryKey') = 1 AND
TABLE_NAME = '$row->TABLE_NAME' AND TABLE_SCHEMA = '$row->TABLE_SCHEMA'";
			$pk = $this->db->query($pk);

			$pk = $pk->row();

			$metadata['primary_key'] = $pk;

			$columns = "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$row->TABLE_NAME' AND TABLE_SCHEMA = '$row->TABLE_SCHEMA'";
			$columns = $this->db->query($columns);

			foreach ($columns->result() as $column) {
				$metadata['fields'][$column->COLUMN_NAME] = "ORM::field()";
			}

				echo "<hr>";
		}
	}
}
