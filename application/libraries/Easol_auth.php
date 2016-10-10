<?php

Class Easol_Auth {

    protected static $loggedIn = FALSE;
    private static $userInfo=[];

    public function __construct() 
    {

        $this->ci = &get_instance();

        $this->ci->load->config('auth');

        $this->controller = $this->ci->router->fetch_class();
        $this->method = $this->ci->router->fetch_method();

        
        self::$userInfo=$this->ci->session->userdata();
        if($this->ci->session->userdata('logged_in') == TRUE)
        {
            self::$userInfo['__ci_last_regenerate']=time();
            $this->ci->session->set_userdata(self::$userInfo);
            self::$loggedIn=TRUE;
        }
        elseif ($this->controller != 'home') {
            redirect('/');
        }

        if ($this->controller == 'home') return TRUE;

        $this->args = [];
        $index = strpos($this->ci->uri->uri_string(), $this->controller);
        $args = explode("/", $this->ci->uri->uri_string());
        foreach ($args as $k=>$v) {
            if ($k <= $index + 1) continue;
            $this->args[] = $v;
        }

        $this->role = $this->user_role();


        if(!($this->controller == 'schools' && $this->method == 'choose') && self::userdata('SchoolId') == FALSE  ) {
            return redirect('schools/choose');
        }

        if ($this->ci->easol_module->is_module($this->controller) && !$this->ci->easol_module->is_enabled($this->controller)) {
            return redirect('home/accessdenied');
        }
           
        if (!$this->has_permission()) {
            return redirect('home/accessdenied');
        }


    }

	public function has_permission($controller=NULL, $method=NULL) 
 {

        if (!$controller) $controller = $this->controller;
        if (!$method) $method = $this->method;

        $this->auth_config = $this->ci->config->item($controller, 'auth');

        // auth_config is the array for the current controller in config/auth.php
        if (empty($this->auth_config)) return FALSE;

        $auth_config = $this->auth_config[$method];
        if (empty($auth_config)) {
            foreach ($this->auth_config as $k=>$v) {
                if (strpos($k, "*") !== FALSE) {
                    $auth_config = $v;
                    break;
                }
            }
        }

        // at that point, auth_config is the array for current controller and method. If not found, it is the array for "*"
        if (is_array($auth_config) && $auth_config[$this->role]) {
            if (is_array($auth_config[$this->role]['condition'])) {
               
                foreach ($auth_config[$this->role]['condition'] as $function) {
                    if (!method_exists($this, $function)) {
                        return FALSE;
                    }
                    elseif (!$this->$function()) {
                        return FALSE;
                    }
                }
                return TRUE;
            }
            else return (bool)$auth_config[$this->role];
        }
        elseif ($auth_config == "*") return TRUE;

        return FALSE;
	}

    public function user_has_school() 
    {

        $StudentUSI = $this->args[0];
        if (!$StudentUSI) return TRUE;

        $student = Model\Edfi\Student::find($StudentUSI);

        foreach ($student->School() as $school) {
            if ($school->SchoolId == self::userdata('SchoolId')) return TRUE;
        }

        return FALSE;
    }

    public function report_has_access($ReportId = NULL) 
    {

        if (!$ReportId) $ReportId = $this->args[0];
        if (!$ReportId) return TRUE;

        if (in_array($this->role, ['System Administrator', 'Data Administrator'])) return TRUE;

        $report = Model\Easol\Report::find($ReportId);

        foreach ($report->ReportAccess() as $access) {
            if ($access->RoleTypeId == self::userdata('RoleId')) return TRUE;
        }

        return FALSE;
    }


    public function user_role($StaffUSI=NULL) 
    {
        if (!$StaffUSI) $StaffUSI = $this->ci->session->userdata('StaffUSI');
        $user = Model\Easol\StaffAuthentication::find($StaffUSI);
        return $user->Role()->RoleTypeName;
    }

 
    /**
     * return true if the current user logged in
     * @return bool
     */
    public static function isLoggedIn()
    {
        return self::$loggedIn;
    }

    /**
     * Userdata
     * @param string $field
     * @return mixed
     */
    public static function userdata($field="")
    {


        if($field=="")
            return self::$userInfo;
        if(array_key_exists($field, self::$userInfo)){
            return self::$userInfo[$field];
        }

        return FALSE;
    }
}
