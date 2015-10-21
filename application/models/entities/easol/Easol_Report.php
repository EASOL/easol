<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';

/**
 * example of basic @param usage
 * @param int $ReportId
 * @param $ReportName string
 */
class Easol_Report extends Easol_BaseEntity {

    private $category = null;
    private $school = null;
    private $displayType = null;
    private $accessTypes = null;

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.Report";
    }



    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "ReportId"    =>  "Report Id",
            "ReportName"  =>  "Report Name",
            "ReportCategoryId"  =>  "Report Category",
            "CommandText"  =>  "Command Text",
            "LabelX"  =>  "X Axis Label",
            "LabelY"  =>  "Y Axis Label",
            "ReportDisplayId"  =>  "Display Type",
            "CreatedBy"  =>  "Created By",
            "CreatedOn"  =>  "CreatedOn",
            "UpdatedBy"  =>  "UpdatedBy",
            "UpdatedOn"  =>  "UpdatedOn",
            "SchoolId"  =>  "SchoolId",
        ];
    }

    public function beforeSave(){
        $this->SchoolId = Easol_Authentication::userdata("SchoolId");
        parent::beforeSave();
    }

    /**
     * @return array
     */
    public function validationRules(){
        return [
            'ReportName' => ['string','Required'],
            'ReportCategoryId' => ['int','Required'],
            'CommandText' => ['string','Required','Is Safe Query'],
            'LabelX' => ['string','Required'],
            'LabelY' => ['string','Required'],
            'ReportDisplayId' => ['int','Required'],
        ];
    }

    /**
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        return "ReportId";
    }


    public function getCategory(){
        if($this->category==null) {
            $this->load->model('entities/easol/Easol_ReportCategory');
            $category = new Easol_ReportCategory();
            $this->category = $category->findOne(['ReportCategoryId' => $this->ReportCategoryId]);
        }
        return $this->category;
    }

    public function getSchool(){

        if($this->school==null) {
            $this->load->model('entities/edfi/Edfi_EducationOrganization');
            $school = new Edfi_EducationOrganization();
            $this->school = $school->hydrate($school->findOne($this->SchoolId));
        }
        return $this->school;
    }

    public function getDisplayType(){

        if($this->displayType==null) {
            $this->load->model('entities/easol/Easol_ReportDisplay');
            $displayType = new Easol_ReportDisplay();
            $this->displayType = $displayType->hydrate($displayType->findOne($this->ReportDisplayId));
        }
        return $this->displayType;
    }

    /**
     * @return null|object
     */
    //public $dt=0;
    public function getAccessTypes(){

        if($this->accessTypes==null && !property_exists($this,"flagAccessTypes")) {
            $this->flagAccessTypes = true;
            //echo '#'.(++$this->dt).'sspd';
            $this->accessTypes = [];
            $this->load->model('entities/easol/Easol_ReportAccess');
            $accessType = new Easol_ReportAccess();

            $this->accessTypes = $accessType->findAllBySql("SELECT EASOL.RoleType.* FROM EASOL.ReportAccess, EASOL.RoleType WHERE EASOL.RoleType.RoleTypeId=EASOL.ReportAccess.RoleTypeId AND EASOL.ReportAccess.ReportId=? ORDER BY RoleTypeName ASC",[$this->ReportId]);


        }

        return $this->accessTypes;

    }

    public function getReportData(){

        if($this->ReportDisplayId==2 || $this->ReportDisplayId==4)
            return $this->findAllBySql($this->CommandText);
        if($this->ReportDisplayId==3)
            return $this->findOneBySql($this->CommandText);

    }

    public function getViewName(){
        switch($this->ReportDisplayId){

            case 1:
                return "display-table";
                break;
            case 2:
                return "display-bar-chart";
                break;
            case 3:
                return "display-pie-chart";
                break;
            case 4:
                return "display-stacked-bar-chart";
                break;
            default:
                throw new \Exception("Invalid Report Display type..");

        }
    }
}