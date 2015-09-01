<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "*",
            "logout"    =>  "@",
            "accessdenied"  =>  "@"
        ];
    }
    /**
     * index page
     */
    public function index()
	{
        if($this->session->userdata('logged_in')== true)
        {
            return redirect('/dashboard');
        }
        
        if(isset($_POST['googLogin_x'])) { 
         $this->load->library('google_api/Google_api');
         $tokens = $this->google_api->authorize_user( 'openid', 'http://localhost/easol/' );
        
         var_dump($tokens); exit;}

        if(isset($_POST['login']) && $data=$this->input->post('login')) {
        	
        	

            $this->load->model('entities/edfi/Edfi_Staff','Edfi_Staff');
            /* @var $this->Staff Edfi_Staff */
            // = $this->Edfi_Staff->findOne(['LoginId' => $data['username']]);
            $staff = $this->Edfi_Staff->hydrate($this->Edfi_Staff->findOne(['LoginId' => $data['username']]));
            if($staff) {
                $this->load->model('entities/easol/Easol_StaffAuthentication','easol_authentication');
                $authentication=$this->easol_authentication->findOne(['StaffUSI' => $staff->StaffUSI]);

                if($authentication && $authentication->Password== sha1($data['password'])){
                    $this->session->sess_expiration =   '1200';
                    $data=[
                            'LoginId'   =>      $staff->LoginId,
                            'StaffUSI'  =>      $staff->StaffUSI,
                            'RoleId'  =>      $authentication->RoleId,
                            'logged_in' => TRUE,
                        ];
                    if($authentication->RoleId==3 || $authentication->RoleId==4) {
                        $school = $staff->getAssociatedSchool();
                        if ($school != null) {
                            $data['SchoolId'] = $school->EducationOrganizationId;
                            $data['SchoolName'] = $school->NameOfInstitution;
                        }
                    }

                    $this->session->set_userdata($data);
                    return redirect('/student');
                }
            }
            return $this->render("login",['message' => 'Invalid username/password']);
        }
		$this->render("login");
	}

    /**
     * logout page
     */
    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }

    /**
     * access denied page
     */
    public function accessdenied(){
        $this->render("access-denied");
    }
}