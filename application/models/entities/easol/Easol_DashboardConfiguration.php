<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 7/31/2015
 * Time: 11:28 AM
 */

require_once APPPATH.'/core/Easol_BaseEntity.php';

/**
 * example of basic @param usage
 * @param int $ReportId
 * @param $ReportName string
 */
class Easol_DashboardConfiguration extends Easol_BaseEntity {


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
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        return "DashboardConfigurationId";
    }


}