<?php

require_once APPPATH.'/core/Easol_BaseEntity.php';

/**
 * example of basic @param usage
 * @param int $ReportId
 * @param $ReportName string
 */
class Easol_DashboardConfiguration extends Easol_BaseEntity {

    private $leftReport = null;
    private $rightReport = null;
    private $bottomReport = null;

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.DashboardConfiguration";
    }



    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "DashboardConfigurationId"    =>  "Dashboard Configuration Id",
            "RoleTypeId"  =>  "Role Type",
            "EducationOrganizationId"  =>  "Report Category",
            "LeftChartReportId"  =>  "Left Chart",
            "RightChartReportId"  =>  "Right Chart",
            "BottomTableReportId"  =>  "Bottom Table",
            "CreatedBy"  =>  "Created By",
            "CreatedOn"  =>  "CreatedOn",
            "UpdatedBy"  =>  "UpdatedBy",
            "UpdatedOn"  =>  "UpdatedOn"
        ];
    }

    public function beforeSave(){
        $this->EducationOrganizationId = Easol_Authentication::userdata("SchoolId");
        parent::beforeSave();
    }

    /**
     * @return array
     */
    public function validationRules(){
        return [
            'RoleTypeId' => ['int','Required'],
            'EducationOrganizationId' => ['int','Required'],
            'LeftChartReportId' => ['int','Required'],
            'RightChartReportId' => ['int','Required'],
            'BottomTableReportId' => ['int','Required'],
        ];
    }

    /**
     * @return Easol_Report
     */
    public function getLeftChart(){
        $this->load->model('entities/easol/Easol_Report');
        if($this->leftReport==null && !property_exists($this,"flagLeftChart") ) {
            $this->flagLeftChart = true;
            $this->leftReport = (new Easol_Report())->findOne(["ReportId" => $this->LeftChartReportId]);
            $this->leftReport = (new Easol_Report())->hydrate($this->leftReport);
        }
        return $this->leftReport;
    }
    /**
     * @return Easol_Report
     */
    public function getRightChart(){
        $this->load->model('entities/easol/Easol_Report');
        if($this->rightReport==null) {
            $this->rightReport = (new Easol_Report())->findOne(["ReportId" => $this->RightChartReportId]);
            $this->rightReport = (new Easol_Report())->hydrate($this->rightReport);
        }
        return $this->rightReport;

    }
    /**
     * @return Easol_Report
     */
    public function getBottomTable(){
        $this->load->model('entities/easol/Easol_Report');
        if($this->bottomReport==null) {
            $this->bottomReport = (new Easol_Report())->findOne(["ReportId" => $this->BottomTableReportId]);
            $this->bottomReport = (new Easol_Report())->hydrate($this->bottomReport);
        }
        return $this->bottomReport;

    }

    /**
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        return "DashboardConfigurationId";
    }


}