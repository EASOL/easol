<?php

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Easol_ReportFilter extends Easol_BaseEntity {

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.ReportFilter";
    }

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "ReportFilterId"    =>  "Report Filter Id",
            "ReportId"    =>  "Report Id",
            "DisplayName"  =>  "Display Name",
            "FieldName"  =>  "Field Name",
            "FilterType"  =>  "Filter Type",
            "FilterOptions"  =>  "Filter Options",
            "DefaultValue"  =>  "Default Value"
            
        ];
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        return 'ReportFilterId';
    }

    public function delete($ReportId=null) {
        if ($ReportId) $this->db->where('ReportId', $ReportId);
        $this->db->delete($this->getTableName());
    }
}