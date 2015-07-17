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
        return  "EASOL.RoleType";
    }

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "RoleTypeId"    =>  "Role Type ID",
            "RoleTypeName"  =>  "Role Type Name"
        ];
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