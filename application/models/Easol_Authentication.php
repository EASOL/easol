<?php

class Easol_Authentication extends CI_Model {

    protected static $loggedIn = false;
    private static $userInfo=[];


    public function __construct(){
        self::$userInfo=$this->session->userdata();
        if($this->session->userdata('logged_in')== true)
        {
            self::$userInfo['__ci_last_regenerate']=time();
            $this->session->set_userdata(self::$userInfo);
            self::$loggedIn=true;
        }

        parent::__construct();

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