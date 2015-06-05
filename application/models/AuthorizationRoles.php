<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 1:59 AM
 */

class AuthorizationRoles extends CI_Model {

    protected static $roles=[];

    protected static $loggedIn = false;

    /**
     * default constructor
     */
    public function __construct(){
        $this->getRoles();
        if($this->session->userdata('logged_in')== true)
        {
            self::$loggedIn=true;
        }
        parent::__construct();
    }

    /**
     * Initialize RoleTypes
     */
    public function getRoles(){
        $this->load->model('entities/easol/RoleType','authentication');
        $obj= new RoleType();

        $roles=$obj->findAll();

        foreach($roles->result() as $role){
            self::$roles[$role->RoleTypeName]=$role->RoleTypeId;
        }

    }

    /**
     * return the role id based on the role type name
     * @param string $name
     * @return int
     */
    public static function getRoleIdByName($name){
        if(array_key_exists($name,self::$roles))
            return self::$roles[$name];
        return null;
    }

    /**
     * check the request is authorize
     * @param array $allowedRules
     * @return bool
     */
    public static function hasAccess($allowedRules=[]){
        if(self::isLoggedIn()){
            return true;
        }
        return false;

    }

    /**
     * return if the current user logged in
     * @param bool $loggedInRedirect
     * @return bool
     */
    public static function isLoggedIn($loggedInRedirect=true){
        if($loggedInRedirect && !self::$loggedIn){
                return redirect('/');
        }
        return self::$loggedIn;
    }


}