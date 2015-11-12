<?php
defined('BASEPATH') OR exit('No direct script access allowed');
set_time_limit(0);
class DataManagement extends Easol_Controller {

    /**
     * default constructor
     */
    public function __construct(){
        parent::__construct();
    }

    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }

    /**
     * index action
     */
    public function index(){

		$this->render("index");
	}

    public function showAllTable(){

        $msg = [];
        $msg['status']['type'] = 'success';
        $msg['status']['msg'] = '';

        if(!isset($_POST['tableType'])){
            $msg['status']['type'] = 'failed';
            $msg['status']['msg'] = 'Table Type Not Set';
        }
        else{
            $this->load->model('DataManagementQueries');
            switch($_POST['tableType']){
                case 'object':
                    $msg['objects'] = DataManagementQueries::getObjectsList(false);
                    break;
                case 'association':
                    $msg['objects'] = DataManagementQueries::getAssociationsList(false);
                    break;
                case 'type':
                    $msg['objects'] = DataManagementQueries::getTypesList(false);
                    break;
                case 'descriptor':
                    $msg['objects'] = DataManagementQueries::getDescriptorsList(false);
                    break;
                default:
                    $msg['status']['type'] = 'failed';
                    $msg['status']['msg'] = 'Invalid Table Type';

            }
        }

        echo json_encode($msg);
    }

    public function ShowTableInfo(){
        $msg = [];
        $msg['status']['type'] = 'success';
        $msg['status']['msg'] = '';
        if(!isset($_POST['tableName'])){
            $msg['status']['type'] = 'failed';
            $msg['status']['msg'] = 'Table Name Not Set';
        }
        else{
            $this->load->model('DataManagementQueries');
            $msg['objects'] = DataManagementQueries::getTableDetails($_POST['tableName']);
        }
        echo json_encode($msg);
    }

    /**
     *
     */
    public function showTableDetails(){

        $msg = [];
        $msg['status']['type'] = 'success';
        $msg['status']['msg'] = '';
        if(!isset($_POST['tableName']) || !isset($_POST['start']) || !isset($_POST['pageSize'])){
            $msg['status']['type'] = 'failed';
            $msg['status']['msg'] = 'Table Name Not Set';
        }
        else{
            $this->load->model('DataManagementQueries');
            $msg['total'] = DataManagementQueries::getTableDataCount($_POST['tableName'])->total;
            $msg['objects'] = DataManagementQueries::getTableData($_POST['tableName'],$_POST['start'],$_POST['pageSize']);
        }
        echo json_encode($msg);

    }

    /**
     * @param null $tableName
     * @throws Exception
     */
    public function downloadTableTemplate($tableName=null){
        if($tableName==null)
            throw new \Exception("Table not Set");


        $this->load->model('DataManagementQueries');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$tableName);
        header("Pragma: no-cache");
        header("Expires: 0");
        echo $this->renderPartial("download-table-headers",['data' => DataManagementQueries::getTableDetails(str_replace(".csv","",$tableName)) ]);
    }

    /**
     * @param null $tableName
     * @throws Exception
     */
    public function downloadTableData($tableName=null){
        if($tableName==null)
            throw new \Exception("Table not Set");


        $this->load->model('DataManagementQueries');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=".$tableName.'_'.date('Y_m_d_h:i_a').".csv");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $this->renderPartial("download-table-data",['data' => DataManagementQueries::getAllTableData($tableName) ]);



    }

    /**
     *
     */
    public function uploadcsv(){
        //$this->load->model('DataManagementQueries');
       // echo DataManagementQueries::getPrimaryKey($_POST['tableName']);

       // print_r($_FILES);
       // print_r($csv = array_map('str_getcsv', file($_FILES['csvFile']['tmp_name'])));

        $msg = [];
        $msg['status']['type'] = 'success';
        $msg['status']['msg'] = '';
        if(!isset($_POST['tableName']) || !isset($_POST['data_action'])){
            $msg['status']['type'] = 'failed';
            $msg['status']['msg'] = 'Table Name Not Set';
        }
        else{ //data_action
            if(isset($_FILES['csvFile'])) {
                if($_FILES['csvFile']['error']==0) {

                    if($this->checkFile($_FILES['csvFile']['tmp_name'], $_POST['tableName'])) {
                        $this->load->model('DataManagementQueries');
                        $this->load->model('Easol_CSVProcessor');
                        $csvProcessor = new Easol_CSVProcessor($_FILES['csvFile']['tmp_name'],$_POST['tableName']);
                        //print_r($csv = array_map('str_getcsv', file($_FILES['csvFile']['tmp_name'])));
                        switch($_POST['data_action']){
                            case 'insert' :
                                try {
                                    if($csvProcessor->insert()){
                                        $msg['status']['msg'] = 'Data Inserted Successfully';
                                    }
                                }
                                catch(\Exception $ex){
                                    $msg['status']['type'] = 'failed';
                                    $msg['status']['msg'] = $ex->getMessage();
                                }
                                break;
                            case 'update' :
                                try {
                                    if($csvProcessor->update()){
                                        $msg['status']['msg'] = 'Data Updated Successfully';
                                    }
                                }
                                catch(\Exception $ex){
                                    $msg['status']['type'] = 'failed';
                                    $msg['status']['msg'] = $ex->getMessage();
                                }
                                break;
                            case 'delete' :
                                try {
                                    if($csvProcessor->delete()){
                                        $msg['status']['msg'] = 'Data Deleted Successfully';
                                    }
                                }
                                catch(\Exception $ex){
                                    $msg['status']['type'] = 'failed';
                                    $msg['status']['msg'] = $ex->getMessage();
                                }
                                break;
                            default:
                                $msg['status']['type'] = 'failed';
                                $msg['status']['msg'] = 'Invalid Operation Selected';
                        }
                    }
                    else {
                        $msg['status']['type'] = 'failed';
                        $msg['status']['msg'] = 'File Upload Error Core : The file structure is not correct.';
                    }
                }
                else {
                    $msg['status']['type'] = 'failed';
                    $msg['status']['msg'] = 'File Upload Error Code : '.$_FILES['csvFile']['error'];
                }
            }
            else {
                $msg['status']['type'] = 'failed';
                $msg['status']['msg'] = 'File Upload Error!';
            }
        }
        echo json_encode($msg);
    }

    public function checkFile($file, $tableName) {

        $this->load->model('DataManagementQueries');

        $content = array_map('str_getcsv', file($file));
        $columns = DataManagementQueries::getTableDetails($tableName);


        foreach ($content[0] as $k=>$column_name) {
            if (trim(strtolower($columns[$k]->COLUMN_NAME)) !== trim(strtolower($column_name))) {
               return false;
            }
        }

        return true;
    }
}
