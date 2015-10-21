<?php

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Easol_ReportAccess extends Easol_BaseEntity {

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.ReportAccess";
    }

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "ReportAccessId"    =>  "Report Access Id",
            "ReportId"    =>  "Report Id",
            "RoleTypeId"  =>  "Role Type Id"
        ];
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        return 'ReportAccessId';
    }
}