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
class Easol_ReportCategory extends Easol_BaseEntity {

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.ReportCategory";
    }



    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "ReportCategoryId"    =>  "Report Category Id",
            "ReportCategoryName"  =>  "Report Category Name",
        ];
    }

    /**
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        return "ReportCategoryId";
    }
}