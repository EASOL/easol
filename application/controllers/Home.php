<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Easol_Controller {


    /**
     * index action
     */
    public function index()
	{
        $this->load->
        $this->load->model('entities/edfi/Staff');

        $this->Staff->findAll();

		$this->render("login");
	}
}
