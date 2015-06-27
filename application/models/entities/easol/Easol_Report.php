<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/5/2015
 * Time: 2:02 AM
 */

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Easol_RoleType extends Easol_BaseEntity {

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
            "ReportDisplayId"  =>  "ReportDisplayId",
            "CreatedBy"  =>  "Created By",
            "CreatedOn"  =>  "CreatedOn",
            "UpdatedBy"  =>  "UpdatedBy",
            "UpdatedOn"  =>  "UpdatedOn",
            "SchoolId"  =>  "SchoolId",
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