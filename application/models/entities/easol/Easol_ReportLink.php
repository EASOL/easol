<?php

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Easol_ReportLink extends Easol_BaseEntity {

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.ReportLink";
    }

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "ReportLinkId"    =>  "Report Link Id",
            "ReportId"    =>  "Report Id",
            "URL"  =>  "URL",
            "ColumnNo"  =>  "Column No"
            
        ];
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        return 'ReportLinkId';
    }

    public function delete($ReportId=null) {
        if ($ReportId) $this->db->where('ReportId', $ReportId);
        $this->db->delete($this->getTableName());
    }
}