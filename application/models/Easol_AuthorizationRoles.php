<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 1:59 AM
 */

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
     * @return bool
     * @internal param array $allowedRules
     */
    public static function hasAccess($allowedRoles=[]){

        if(!Easol_Authentication::userdata('RoleId'))
            return false;

        foreach($allowedRoles as $role){
            if(array_key_exists($role, self::$roles) && self::$roles[$role]==Easol_Authentication::userdata('RoleId')){

                return true;

            }
        }

        return false;
    }




}