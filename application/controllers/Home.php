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

         if( (isset($_POST['login']) && $data=$this->input->post('login')) || isset($_REQUEST['idtoken']) ) {
            
            $this->load->model('entities/edfi/Edfi_Staff','Edfi_Staff');   

            if(isset($_REQUEST['idtoken'])) {
            	    
            	    /*echo "begin testing<br /><br />";
            	    $this->load->model('External_Auth','vToken');
            	    //$validToken = 
            	    $this->vToken->validate_google_token();
            	    
            	    echo "<br /><br />end testing";
            	    
            	    exit;
            	    */
            	    
              $this->load->model('entities/edfi/Edfi_StaffElectronicMail','Edfi_StaffElectronicMail');
              $staffbyEmail = $this->Edfi_StaffElectronicMail->hydrate($this->Edfi_StaffElectronicMail->findOne(['ElectronicMailAddress' => $_REQUEST['uemail']]));
              if($staffbyEmail) {
                $staffEmailIndicator = $staffbyEmail->PrimaryEmailAddressIndicator;
                $staffUSI = $staffbyEmail->StaffUSI;
                if($staffEmailIndicator==1) {
                	// GOOGLE & EASOL EMAILS MATCH AND WE CAN USE EMAIL
                        //$staff=$staffbyEmail;
                        $staff = $this->Edfi_Staff->hydrate($this->Edfi_Staff->findOne(['StaffUSI' => $staffUSI]));
                      if($staff) {
			$this->load->model('entities/easol/Easol_StaffAuthentication','easol_authentication');
			$authentication=$this->easol_authentication->findOne(['StaffUSI' => $staffUSI]);
			    //var_dump($authentication); exit;
	                    // && $authentication->Password== sha1($data['password'])
			if($authentication){
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
			    //return redirect('/student');
			    echo "gloginValid";
			} else { /* authentication failed */ echo "Error Logging in - final authentication failed - Please contact Support";}
		      } else { /* authentication failed */ echo "Error Logging in - can't pull staff record - Please contact Support";}


                } else { /* NO permission to use email */ echo "Error Logging in - no permission to use email - Please contact Support"; /* return $this->render("login",['message' => 'Error Logging in - Please contact Support']); */ } 
              } else { /* NO matching email found */ echo "Error Logging in - no matching email - Please contact Support"; /* return $this->render("login",['message' => 'Error Logging in - Please contact Support']); */ }
            } 

            if( isset($_POST['login']) && $data=$this->input->post('login') ) {
            	     // NORMAL LOGIN THROUGH EASOL
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
            
            } // end if post login
         }
         
		if( isset($_REQUEST['idtoken']) ) {} else {$this->render("login");}
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