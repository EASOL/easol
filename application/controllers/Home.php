<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Easol_Controller {


    /**
     * index action
     */
    public function index()
	{

        $this->load->model('db/edfi/Staff');

        $this->Staff->findAll();

		$this->render("login");
	}
}
