<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/2/2015
 * Time: 9:02 PM
 */

abstract class Easol_BaseEntity {

    public $tablePrefix='';

    /**
     * return table name
     * @return string
     */
    public abstract function getTableName();

    /**
     * labels for the database fields
     * @return array
     */
    public abstract function labels();
}