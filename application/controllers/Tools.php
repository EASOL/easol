<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tools extends Easol_Controller {


    protected function accessRules(){
	    return [
		    "index" => ['System Administrator', 'Data Administrator'],
	    ];
    }

    public function test() {
	    //echo APPPATH;
	    system("cd ".APPPATH."tests");
	    system("phpunit", $output );

	    echo $output;
    }
}
