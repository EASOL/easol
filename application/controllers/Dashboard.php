<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Easol_Controller {


    /**
     * index action
     */
    public function index()
	{


		$this->render("index");
	}
}
