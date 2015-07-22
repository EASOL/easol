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
    private $csvHeader;

    private $primaryColumn="";

    /**
     * @param $csvData
     * @param $tableName
     */
    public function __construct($csvFile="",$tableName=""){
        $this->csvFile = $csvFile;
        $this->tableName = $tableName;
        $this->load->model('DataManagementQueries');

        $this->primaryColumn =  DataManagementQueries::getPrimaryKey($tableName);
    }



    public function insert(){
        //echo $this->primaryColumn;
        try {
            $db['default']['db_debug'] = FALSE;
            $csv = array_map('str_getcsv', file($this->csvFile));
            if (is_array($csv)) {

                foreach ($csv as $key => $row) {

                    if ($key != 0) {
                        //print_r();
                        if(!$this->checkDataExists($row)){

                            $this->db->insert('edfi.' . $this->tableName, $this->propagateColumnsToDbColumn($this->csvHeader, $row));

                            //print_r($this->propagateColumnsToDbColumn($this->csvHeader, $row));

                        }
                    } else {
                        $this->csvHeader = $row;
                    }
                }
            }


            return true;
        }
        catch(  \Exception $ex){
           // throw $ex;
        }

    }

    public function update(){

        //echo $this->primaryColumn;
        try {
            $db['default']['db_debug'] = FALSE;
            $csv = array_map('str_getcsv', file($this->csvFile));
            if (is_array($csv)) {

                foreach ($csv as $key => $row) {
                    if ($key != 0) {
                        //insert new data
                        if(!$this->checkDataExists($row)){
                            $this->db->insert('edfi.' . $this->tableName, $this->propagateColumnsToDbColumn($this->csvHeader, $row));

                        }
                        //update existing data
                        else{
                            $updateData=[];
                            foreach($row as $col => $colValue){
                                //primary column
                                if($col == $this->primaryColumn){
                                    $this->db->where($col, $colValue);

                                }
                            }

                            //$this->db->where('id', $id);
                           $this->db->update('edfi.' . $this->tableName, $updateData);

                        }
                    } else {
                        $this->csvHeader = $row;
                    }
                }
            }


            return true;
        }
        catch(  \Exception $ex){
            // throw $ex;
        }

    }

    public function delete(){

        try {
            $db['default']['db_debug'] = FALSE;
            $csv = array_map('str_getcsv', file($this->csvFile));
            if (is_array($csv)) {

                foreach ($csv as $key => $row) {
                    if ($key != 0) {
                        //delete operation
                        if($this->checkDataExists($row)){


                        }

                    } else {
                        $this->csvHeader = $row;
                    }
                }
            }


            return true;
        }
        catch(  \Exception $ex){

        }


    }

  //  private function processRow($dbRow,$csvRow){}

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


    private function checkDataExists($data){
        return false;
    }

    /**
     * @param $csvHeaders
     * @param $row
     * @return array
     */
    private function propagateColumnsToDbColumn($csvHeaders,$row){
        $retData = [];
        $data = array_combine($csvHeaders,$row);

        foreach($data as $key => $value){
            if(trim($value)!==""){
                $retData[$key] = $value;
            }
        }

        return $retData;
    }
}