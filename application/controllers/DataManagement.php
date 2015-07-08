<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataManagement extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }



    /**
     * index action
     */
    public function index()
	{
		$this->render("index");
	}

    public function choose(){

        $schools= $this->Edfi_School->getAllSchools();

        if(isset($_POST['school'])){
            foreach($schools as $school){
                if($_POST['school']== $school->EducationOrganizationId){
                    $userdata=Easol_Authentication::userdata();
                    $userdata['__ci_last_regenerate']=time();
                    $userdata['SchoolId'] = $_POST['school'];
                    $this->session->set_userdata($userdata);
                    $this->session->set_flashdata('message', 'School Selected as '. $school->NameOfInstitution);
                    $this->session->set_flashdata('type', 'success');
                    redirect('/student');

                }
            }
        }

        $this->render('choose',['schools' => $schools]);

    }
}
