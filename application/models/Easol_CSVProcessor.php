<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 7/17/2015
 * Time: 8:49 PM
 */

class Easol_CSVProcessor extends CI_Model {

    private $csvFile;
    private $tableName;
    private $tableColumns;

    /**
     * @param $csvData
     * @param $tableName
     */
    public function __construct($csvFile,$tableName){
        $this->csvFile = $csvFile;
        $this->tableName = $tableName;
        $this->load->model('DataManagementQueries');
    }



    public function insert(){

    }

    public function update(){

    }

    public function delete(){

    }

    /**
     * validate csv header with table columns
     * @return bool
     */
    private function validateData(){

        return false;

    }

    /**
     *
     * @return array
     */
    private function getCSVHeader(){
        return [];

    }



}