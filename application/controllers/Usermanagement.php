<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends Easol_Controller {

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('Usermanagement_M');
    }

    protected function accessRules()
    {
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }

    public function index()
	{
        $users = $this->Usermanagement_M->getEasolUsers();

        $this->render('index', [
                'users' => $users,
            ]);
	}

    public function delete()
    {
        $user = $this->uri->segment('3');
        if ($user)
        { 
            $result = $this->Usermanagement_M->deleteEasolUsers($user);
            // $result is null when the delete was successful.
            if ($result)
                $this->session->set_flashdata('message', $result);
        }
        // send them back to the user listing to see the list, sans the deleted user.
        redirect('/usermanagement');
    }    
}
