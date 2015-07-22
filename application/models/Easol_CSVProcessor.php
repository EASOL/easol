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



    public function insert( $updateData = false){
        try {
            $db['default']['db_debug'] = FALSE;
            $csv = array_map('str_getcsv', file($this->csvFile));
            if (is_array($csv)) {

                foreach ($csv as $key => $row) {

                    if ($key != 0) {
                        $primaryKeyValue= null;
                        $insertData = $this->propagateColumnsToDbColumn($this->csvHeader, $row,$primaryKeyValue);
                        //insert data
                        if($primaryKeyValue == null){
                            $this->db->insert('edfi.' . $this->tableName, $insertData);
                        }

                        elseif($updateData){
                            $this->db->where($this->primaryColumn,$primaryKeyValue);
                            $this->db->update('edfi.' . $this->tableName, $insertData);

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

    public function update(){
        $this->insert(true);

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
    /**
     * @param $csvHeaders
     * @param $row
     * @return array
     */
    private function propagateColumnsToDbColumn($csvHeaders,$row, &$primaryKeyValue ){
        $retData = [];
        $data = array_combine($csvHeaders,$row);

        foreach($data as $key => $value){
            if(trim($value)!==""){
                if($key == $this->primaryColumn){
                    $primaryKeyValue = $value;
                }
                else
                    $retData[$key] = $value;
            }
        }

        return $retData;
    }
}