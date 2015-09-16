<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends Easol_Controller {

    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }

    public function index()
	{
        $this->load->model('Usermanagement_M');
        $users = $this->Usermanagement_M->getEasolUsers();

        $this->render('index', [
                'users' => $users,
            ]);
	}
}
