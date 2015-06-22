<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
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
