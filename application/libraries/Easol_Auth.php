<?php

Class Easol_Auth {

    protected static $loggedIn = false;
    private static $userInfo=[];

    public function __construct() {

        $this->ci = &get_instance();

        $this->ci->load->config('auth');

        $this->controller = $this->ci->router->fetch_class();
        $this->method = $this->ci->router->fetch_method();

        $this->auth = $this->ci->config->item($this->controller, 'auth');


        self::$userInfo=$this->ci->session->userdata();
        if($this->ci->session->userdata('logged_in') == true)
        {
            self::$userInfo['__ci_last_regenerate']=time();
            $this->ci->session->set_userdata(self::$userInfo);
            self::$loggedIn=true;
        }
        elseif ($this->controller != 'home') {
            redirect('/');
        }

        if ($this->controller == 'home') return true;

        if(!($this->controller == 'schools' && $this->method == 'choose') && self::userdata('SchoolId') == false  ) {
            return redirect('schools/choose');
        }

        if ($this->ci->easol_module->is_module($this->controller) && !$this->ci->easol_module->is_enabled($this->controller)) {
            return redirect('home/accessdenied');
        }
           
        if (!$this->has_permission()) {
            return redirect('home/accessdenied');
        }


    }

	public function has_permission() {

        print_r($this->ci->uri->ruri_to_assoc());

		if (empty($this->auth)) return false;

        return true;
	}

 
    /**
     * return true if the current user logged in
     * @return bool
     */
    public static function isLoggedIn(){
        return self::$loggedIn;
    }

    /**
     * Userdata
     * @param string $field
     * @return mixed
     */
    public static function userdata($field=""){


        if($field=="")
            return self::$userInfo;
        if(array_key_exists($field,self::$userInfo)){
            return self::$userInfo[$field];
        }

        return false;
    }
}
