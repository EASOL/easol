<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_StaffSchoolAssociation extends Easol_baseentity {

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            'StaffUSI'              => 'StaffUSI',
            'ProgramAssignmentDescriptorId'   => 'Program Assignment Descriptor Id',
            'SchoolId'             => 'SchoolId',
            'SchoolYear'            => 'School Year',
            'Id'           => 'Id',
            'LastModifiedDate'      =>  'LastModifiedDate',
            'CreateDate'            =>  'CreateDate'


        ];
    }


    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.StaffSchoolAssociation";
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }
}