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

    /*
    * Since both "user adds" and "user edits" both use the same form 
    * and the same backend processing, we use a single MVC to keep
    * the codebase as DRY as possible.
    */
    public function addEdit()
    {
        $user = ($this->uri->segment('3')) ? $this->uri->segment('3') : $this->input->post('staffusi');
        if ($user) 
        {
            if (!empty($_POST))
            {
                // Process the form and show the form with the flash message and the new form field defaults.
                $data = $this->Usermanagement_M->addEditEasolUser($_POST);
                // $result is ???? on success
                if ($error)
                    $this->session->set_flashdata('message', $result);
                else
                    $this->session->set_flashdata('message', 'The user was edited sucessfully.');
            }else
            {
                // Get the db data necessary to build the form 
                $data = $this->Usermanagement_M->getUserFormData($user);
            }
        }else 
        {   // Get the db data necessary to build the form 
            $data = $this->Usermanagement_M->getUserFormData();
        }

        $data['title'] = 'User Management';

        $this->render('addEdit', [
                'data' => $data,
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
            else
                $this->session->set_flashdata('message', 'The user was deleted sucessfully.');
        }
        // send them back to the user listing to see the list, sans the deleted user.
        redirect('/usermanagement');
    }    
}
