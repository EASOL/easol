<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Easol_Controller {

    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator'],
            "default"   =>  ['System Administrator']
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
