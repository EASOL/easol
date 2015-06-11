<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/2/2015
 * Time: 9:02 PM
 */

abstract class Easol_BaseEntity extends CI_Model{


    public $tablePrefix='';

    public $isNewRecord= true;

    public function __construct()
    {

        parent::__construct();
    }


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

    /**
     * select all row
     * @return array
     */
    public function findAll($params=[]){
        if(count($params)>0)
            return $this->db->get_where($this->getTableName(), $params);
        return $this->db->get($this->getTableName());

    }

    /**
     * find single row
     * @param array $params
     * @return object
     */
    public function findOne($params=[]){
        $query = $this->db->get_where($this->getTableName(), $params);

        return $query->row();

    }
}