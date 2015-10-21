<?php

abstract class Easol_BaseEntity extends CI_Model{


    public $tablePrefix='';

    public $isNewRecord= true;

    public $errors = [];

    public function __construct()
    {

        parent::__construct();


    }

    /**
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name,$value){

        if(!property_exists($this,$name)){
            if(array_key_exists($name,$this->labels()) || substr( $name, 0, 4 ) === "flag"){
                $this->{$name} = $value;
            }
            else
                throw new Exception("Value Cannot be set, column does not exists");
        }
        else
            $this->{$name} = $value;


    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name){
        if(!property_exists($this,$name)){
            if(array_key_exists($name,$this->labels())){
                $this->{$name} = "";
                return $this->$name;
            }
        }
        return parent::__get($name);
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
     * find all row
     * @param array $params
     * @return object
     */
    public function findAllBySql($sql,$params=[]){
        $query = $this->db->query($sql, $params);

        return $query->result();

    }

    /**
     * find single row
     * @param array $params
     * @return object
     */
    public function findOne($params=[]){
        if(!is_array($params)){
            $params = [$this->getPrimaryKey()=>$params];
        }
        $query = $this->db->get_where($this->getTableName(), $params);

        return $query->row();

    }

    /**
     * find single row
     * @param array $params
     * @return object
     */
    public function findOneBySql($sql,$params=[]){
        $query = $this->db->query($sql, $params);

        return $query->row();

    }

    /**
     * Populate retrieved data with the class
     * @param $obj
     * @return static
     */
    public function hydrate($obj){
        $this->isNewRecord = false;

        if(!is_array($obj)){
            $ret = new static;
            $ret->isNewRecord = false;
            foreach ($ret->labels() as $key => $value)
            {
                if(isset($obj->$key))
                    $ret->{$key} = $obj->$key;
                else
                    $ret->{$key} = null;
            }

            return $ret;
        }
        else {
            $retArr = [];
            foreach($obj as $o) {
                $ret = new static;
                $ret->isNewRecord = false;
                foreach ($ret->labels() as $key => $value) {
                    if (isset($o->$key))
                        $ret->{$key} = $o->$key;
                    else
                        $ret->{$key} = null;
                }
                $retArr[] = $ret;
            }

            return $retArr;
        }
    }

    /**
     * Return primary key of the table
     * @return null | string
     */
    public abstract function getPrimaryKey();

    /**
     * @return array
     */
    public function validationRules(){
        return [];
    }

    public function excludedColumns(){
        return [
            'CreatedOn' => '',
            'UpdatedOn' => ''
        ];
    }

    /**
     * @param array $data
     * @return bool
     */
    public function populateForm($data=[]){
        foreach($this->validationRules() as $key => $value){
            if(array_key_exists($key,$data)){
                $this->$key = $data[$key];
            }
        }

        return true;
    }


    public function beforeSave(){

        if($this->isNewRecord){
            if(array_key_exists('CreatedBy',$this->labels())){
                $this->CreatedBy=Easol_Authentication::userdata("StaffUSI");

            }
            if(array_key_exists('CreatedOn',$this->labels())){
                $this->db->set('CreatedOn', 'GETDATE()', FALSE);

            }

        }

        if(array_key_exists('UpdatedBy',$this->labels())){
            $this->UpdatedBy=Easol_Authentication::userdata("StaffUSI");

        }
        if(array_key_exists('UpdatedOn',$this->labels())){
            $this->db->set('UpdatedOn', 'GETDATE()', FALSE);


        }


    }


    /**
     * Save data to database
     */
    public function save(){
        $this->beforeSave();
        if($this->getPrimaryKey()==null){
            throw new \Exception("Primary Key Not Set!!");
        }
        $data = $this->entryData();

        //print_r($data);
        //insert operation

        if($this->isNewRecord){
           if($this->db->insert($this->getTableName(),$data)) {
               $this->isNewRecord = false;
               $this->{$this->getPrimaryKey()} = $this->db->insert_id();
               return true;
           }
        }
        //update operation
        else {
            if($this->getPrimaryKey()==null)
                throw new \Exception("Primary Key not Defined!");
            $this->db->where($this->getPrimaryKey(),$this->{$this->getPrimaryKey()});
            if($this->db->update($this->getTableName(),$data)) {

                return true;

            }
        }

        return false;
    }



    private function entryData(){

        $ret=[];

        foreach($this->labels() as $key => $value){
            if($key!=$this->getPrimaryKey()){
                if(!property_exists($this,$key) || array_key_exists($key,$this->excludedColumns())){
                    continue;
                }
                $ret[$key]=$this->$key;
            }
        }

        return $ret;

    }



}