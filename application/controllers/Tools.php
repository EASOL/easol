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
}
