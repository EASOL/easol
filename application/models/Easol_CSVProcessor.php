<?php

class Easol_CSVProcessor extends CI_Model {

    private $csvFile;
    private $tableName;
    private $tableColumns;
    private $csvHeader;

    private $primaryColumn="";

    public $result = ['inserted'=>[], 'updated'=>[], 'skipped'=>[], 'deleted'=>[], 'error'=>[]];

    /**
     * @param $csvData
     * @param $tableName
     */
    public function __construct($csvFile="",$tableName=""){
        $this->csvFile = $csvFile;
        $this->tableName = $tableName;
        $this->load->model('Datamanagementqueries');

        $this->primaryColumn =  Datamanagementqueries::getPrimaryKey($tableName);


    }


    /**
     * @param bool $updateData
     * @return bool
     */
    public function insert( $updateData = false){

        $this->db->db_debug = false;
        $csv = array_map('str_getcsv', file($this->csvFile));
        if (is_array($csv)) {

            foreach ($csv as $key => $row) {
                //If this is not header line
                if ($key != 0) {

                    // Prepare an array for data insertion
                    $insertData = $this->propagateColumnsToDbColumn($this->csvHeader, $row);


                    //if current row doesn't have duplicats with the primary keys - we insert it
                    if(!$this->rowExists($this->csvHeader,$row)){
                        //Short fix for Student table - so far only this table has this property
                     //   if($this->tableName == 'Student')
                        $this->db->query("set identity_insert edfi.".$this->tableName." on");
                        $this->db->insert('edfi.' . $this->tableName, $insertData);

                        $error = $this->db->error();

                        if (!$error['message'])
                            $this->result['inserted'][] = ['line'=>$key];

                        else {
                            $this->result['error'][] = ['line' => $key, 'reason' => $error['code'].' - '.$error['message']];
                        }


                        //else if we can update data, then we can work even with duplicated rows
                    }elseif($updateData && !$this->identicalRow($insertData)){
                        //get an array of all primary keys and their values
                        $where = $this->getPrimaryKeysArray($this->csvHeader,$row);

                        //removing primary keys from the data insertion
                        foreach($where as $k => $v) unset($insertData[$k]);

                        $this->db->where($where);
                        $this->db->update('edfi.' . $this->tableName, $insertData);

                        $error = $this->db->error();

                        if (!$error['message'])
                            $this->result['updated'][] = ['line' => $key];
                        else {
                            $this->result['error'][] = ['line' => $key, 'reason' => $error['code'] . ' - ' . $error['message']];
                        }

                    }else{
                        //Data was a duplicate and Update was not allowed to be done
                        $this->result['skipped'][] = ['line' => $key, 'reason'=>'Duplicated Record'];
                    }



                } else {
                    //this is header and we save it
                    $this->csvHeader = $row;
                }
            }
        }
        // var_dump($inserted);
        //var_dump($updated);
        // var_dump($skipped);

        return true;
    }




    /**
     * @return bool
     */
    public function update(){
        return $this->insert(true);

    }

    public function delete(){

        try {
            $this->db->db_debug = false;
            $csv = array_map('str_getcsv', file($this->csvFile));
            if (is_array($csv)) {

                foreach ($csv as $key => $row) {

                    if ($key != 0) {
                        $data = array_combine($this->csvHeader, $row);
                        //If primary column is 1 value, then we just use 1 line, otherwise we need to loop through each.
                        if (is_array(($this->primaryColumn))) {
                            $where = array();
                            foreach ($this->primaryColumn as $k) {

                                $where[$k] = $data[$k];
                            }
                        } else {
                            $where = array($this->primaryColumn => $data[$this->primaryColumn]);
                        }
                        $this->db->where($where);
                        $this->db->delete('edfi.' . $this->tableName);

                        $error = $this->db->error();

                        if (!$error['message'])
                            $this->result['deleted'][] = ['line'=>$key];
                        else {
                            $this->result['error'][] = ['line' => $key, 'reason' => $error['code'] . ' - ' . $error['message']];
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
    private function propagateColumnsToDbColumn($csvHeaders,$row){
        $retData = [];
        $data = array_combine($csvHeaders,$row);

        foreach($data as $key => $value){
            if(trim($value)!=="" && trim($value) !== 'NULL'){
                $retData[$key] = $value;
            }
        }
        unset($retData['Id']);
        unset($retData['LastModifiedDate']);
        unset($retData['CreateDate']);
        return $retData;
    }

    /**
     * @param $csvHeaders
     * @param $row
     * @return boolean
     */
    private function rowExists($csvHeaders, $row){

        $data = array_combine($csvHeaders,$row);

        //If primary column is 1 value, then we just use 1 line, otherwise we need to loop through each.
        if(is_array(($this->primaryColumn))){
            $where = array();
            foreach($this->primaryColumn as $key){

                $where[$key] =  $data[$key];
            }

        }else{
            $where = array($this->primaryColumn => $data[$this->primaryColumn]);
        }
        $this->db->where($where);
        $num = $this->db->count_all_results("edfi.".$this->tableName);
        if ($num > 0) return true;
        return false;
    }

    /**
     * @param $csvHeaders
     * @param $row
     * @return array
     */
    private function getPrimaryKeysArray($csvHeaders, $row){

        $data = array_combine($csvHeaders,$row);
        $result = array();
        //If primary column is 1 value, then we just use 1 line, otherwise we need to loop through each.
        if(is_array(($this->primaryColumn))){
            $result = array();
            foreach($this->primaryColumn as $key){
                $result[$key] =  $data[$key];
            }

        }else{
            $result = array($this->primaryColumn => $data[$this->primaryColumn]);
        }
        return $result;

    }
    /**
     * @param $data
     * @return boolean
     */
    private function identicalRow($data){

        $this->db->where($data);
        $num = $this->db->count_all_results("edfi.".$this->tableName);
        if ($num > 0) return true;
        return false;
    }
}
