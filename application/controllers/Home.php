<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Easol_Controller {


    /**
     * index action
     */
    public function index()
	{
        if($this->session->userdata('logged_in')== true)
        {
            return redirect('/dashboard');
        }

        if(isset($_POST['login']) && $data=$this->input->post('login')) {

            $this->load->model('entities/edfi/Staff');
            /* @var $this ->Staff Staff */
            $staff = $this->Staff->findOne(['LoginId' => $data['username']]);
            if($staff) {

                $this->load->model('entities/easol/StaffAuthentication','authentication');
                $authentication=$this->authentication->findOne(['StaffUSI' => $staff->StaffUSI]);
                if($authentication && $authentication->Password== sha1($data['password'])){
                    $this->session->sess_expiration =   '1200';
                    $this->session->set_userdata(
                        [
                            'LoginId'   =>      $staff->LoginId,
                            'StaffUSI'  =>      $staff->StaffUSI,
                            'StaffUSI'  =>      $authentication->Roleid,
                            'logged_in' => TRUE,

                        ]
                    );
                    return redirect('/dashboard');
                }
            }
            return $this->render("login",['message' => 'Invalid username/password']);
        }
		$this->render("login");
	}

    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
}
