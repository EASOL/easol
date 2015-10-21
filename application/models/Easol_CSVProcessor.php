<?php

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


    /**
     * @param bool $updateData
     * @return bool
     */
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

    /**
     * @return bool
     */
    public function update(){
        return $this->insert(true);

    }

    public function delete(){

        try {
            $db['default']['db_debug'] = FALSE;
            $csv = array_map('str_getcsv', file($this->csvFile));
            if (is_array($csv)) {

                foreach ($csv as $key => $row) {

                    if ($key != 0) {
                        $primaryKeyValue= null;
                        $insertData = $this->propagateColumnsToDbColumn($this->csvHeader, $row,$primaryKeyValue);
                        //delete data
                        if($primaryKeyValue != null){
                            $this->db->delete('edfi.' . $this->tableName,array($this->primaryColumn => $primaryKeyValue));

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

    /**
     * validate csv header with table columns
     * @return bool
     */
    private function validateData(){

        return false;

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