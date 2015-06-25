<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 2:02 AM
 */

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Easol_SchoolConfiguration extends Easol_BaseEntity {

    private static $conf;

    public function __construct(){
        parent::__construct();
        self::$conf = $this;


    }

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.SchoolConfiguration";
    }

    /**
     * @param $key
     * @return null
     */
    public static function getValue($key,$EducationOrganizationId=''){
        if($EducationOrganizationId=='')
            $EducationOrganizationId = Easol_Authentication::userdata('SchoolId');

        $data=self::$conf->findOne(['Key'=>$key,'EducationOrganizationId'=>$EducationOrganizationId]);
        if(isset($data->Value)) return $data->Value;

        return null;

    }

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "EducationOrganizationId"    =>  "Education Organization Id",
            "Key"  =>  "Key",
            "Value"  =>  "Value"
        ];
    }
}