<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Easol_Controller {


    /**
     * index action
     */
    public function index()
	{

		$this->render("index");
	}
}
