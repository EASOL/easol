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
        $this->load->helper('form');
        $user = ($this->uri->segment('3')) ? $this->uri->segment('3') : $this->input->post('StaffUSI');
        if ($user) 
        {
            if (!empty($_POST))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
                $this->form_validation->set_rules('StaffUSI', 'StaffUSI', 'required');
                
                if (!isset($_POST['GoogleAuth']))
                    $this->form_validation->set_rules('Password', 'Password', 'required|min_length[6]');

                if ($this->form_validation->run() === true)
                {
                    // Process the form and show the form with the flash message and the new form field defaults.
                    $data = $this->Usermanagement_M->addEditEasolUser($_POST);
                    // $data is user array on success and a boolean false on failure.
                    if (!$data)
                        $this->session->set_flashdata('error','There was an error processing your request.');
                    else
                        $this->session->set_flashdata('success','The user was edited sucessfully.');

                    redirect('usermanagement');
                }
                else {
                    // If we failed validation then reload the view for the user to show the validation errors.
                    if ($this->input->post('newuser'))
                        $data = $this->Usermanagement_M->getUserFormData();
                    else
                        $data = $this->Usermanagement_M->getUserFormData($user);
                }
            }else
            {
                // We are editing a user from the uri so get the db data necessary to build the form 
                $data = $this->Usermanagement_M->getUserFormData($user);
            }
        }else 
        {   // We are adding a "new" user so get the db data necessary to build the form 
            $data = $this->Usermanagement_M->getUserFormData();
        }

        $data['title'] = 'User Management';

        $this->render('addEdit', [
                'data'      => $data
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
