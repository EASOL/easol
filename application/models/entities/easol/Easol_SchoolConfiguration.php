<?php


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

    /**
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }
    
     /**
     * returns peice of query string for filtering out users and filter search object
     * @return array
     */
    public static function userCanFilter() {
    	$data['allowedUser'] = '';
	$data['thefilter'] = ['Term' => ['glue'=>'and'],'Year' => ['glue'=>'and'], 'Course' => ['glue'=>'and'], 'Educator'=> ['glue'=>'and']];
	if( !Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator']) ) { $data['allowedUser'] = "AND Staff.StaffUSI=".Easol_Authentication::userdata('StaffUSI'); $data['thefilter'] = ['Term' => ['glue'=>'and'],'Year' => ['glue'=>'and'], 'Course' => ['glue'=>'and']]; }
	return $data;
    }
    /**
     * sets default of filter field
     * @return string
     */
    public static function setDefault($filtertype, $default) {
    	    if( (isset($_GET['filter'][$filtertype]) && $_GET['filter'][$filtertype]=='') || $default==null) { $default="";}
    	    return $default;
    }
    
}