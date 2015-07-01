<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 2:02 AM
 */

require_once APPPATH.'/core/Easol_BaseEntity.php';

/**
 * example of basic @param usage
 * @param int $ReportId
 * @param $ReportName string
 */
class Easol_Report extends Easol_BaseEntity {

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
            'CommandText' => ['string','Required'],
            'ReportDisplayId' => ['int','Required'],
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
}