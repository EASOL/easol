<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Easol_Controller {

    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }

    /**
     * index action
     */
    public function index()
	{

		$this->render("index");
	}
}
