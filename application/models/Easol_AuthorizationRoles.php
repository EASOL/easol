<?php

class Easol_AuthorizationRoles extends CI_Model {

    protected static $roles=[];


    /**
     * default constructor
     */
    public function __construct(){

        $this->getRoles();
        parent::__construct();
    }

    /**
     * Initialize RoleTypes
     */
    public function getRoles(){
        $this->load->model('entities/easol/Easol_RoleType','Easol_RoleType');

        $roles=$this->Easol_RoleType->findAll();

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
     * @param array $allowedRoles
     * $allowedRoles * for grant all access, @ for all logged in users, [] for specific user
     * @return bool
     */
    public static function hasAccess($allowedRoles=[], $section=null){

        if ($section) {
            $ci = &get_instance();
            if ($ci->easol_module->is_module($section) && !$ci->easol_module->is_enabled($section)) {
                return false;
            }
        }

        if(!is_array($allowedRoles)){
            if($allowedRoles=='*' || $allowedRoles == '')
                return true;
            if($allowedRoles=='@' && Easol_Auth::isLoggedIn())
                return true;
        }

        if(!Easol_Auth::userdata('RoleId'))
            return false;

        foreach($allowedRoles as $role){
            if(array_key_exists($role, self::$roles) && self::$roles[$role]==Easol_Auth::userdata('RoleId')){

                return true;

            }
        }

        return false;
    }

}
