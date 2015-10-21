<?php

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Easol_StaffAuthentication extends Easol_BaseEntity {

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            'StaffUSI'              => 'StaffUSI',
            'Password'   => 'Password',
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
        return "EASOL.StaffAuthentication";
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