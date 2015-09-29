<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schoolmanagement extends Easol_Controller {

    public function __construct ()
    {
        parent::__construct();
        $this->load->model('Schoolmanagement_M');
    }

    protected function accessRules()
    {
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }

    public function index()
	{
        $schools = $this->Schoolmanagement_M->getSchools();

        $this->render('index', [
                'schools' => $schools,
            ]);
	}

    public function details()
    {
        $school = $this->uri->segment('3');

        if ($post = $this->input->post()) {
            // we are processing the school details form submitted via AJAX
            $result = $this->Schoolmanagement_M->setSchoolDetails($school, $post);
            if (!$result)
                $this->session->set_flashdata('error','There was an error processing your request.');
            else
                $this->session->set_flashdata('success','The edits were saved sucessfully.');

            // send the response to the AJAX for processing.
            exit(json_encode($result));
        }else 
        {   // we load the details for the school.
            $results = $this->Schoolmanagement_M->getSchoolDetails($school);

            $this->load->library('Schoolmanagement_L');
            $config = $this->schoolmanagement_l->getConfig(true);

            foreach ($results['details'] as $key => $value) {
                if (isset($config['schoolattributes'][$value->Key]))
                    $results['details'][$key]->config = $config['schoolattributes'][$value->Key];
            }
        }

        $this->render('details', [
                'results' => $results,
            ]);
    }

    public function addschooldetails()
    {
        $school = $this->uri->segment('3');

        if ($post = $this->input->post()) {
            $result = $this->Schoolmanagement_M->addSchoolDetails($school, $post);
            if (!$result)
                $this->session->set_flashdata('error','There was an error processing your request.');
            else
                $this->session->set_flashdata('success','The configurations were saved sucessfully.');

            redirect('/schoolmanagement/details/'.$school);
        }else 
        {   // we load the form to add new school configs.
            $this->load->library('Schoolmanagement_L');
            $config = $this->schoolmanagement_l->getConfig();
            $data = $this->Schoolmanagement_M->getSchools($school);
        }

        $this->render('addschooldetails', [
                'school' => $data,
                'config' => $config,
            ]);
    }
}
