<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataManagement extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }



    /**
     * index action
     */
    public function index()
	{
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
        $this->load->model('DataManagementQueries');
       // echo DataManagementQueries::getPrimaryKey($_POST['tableName']);

       // print_r($_FILES);
       // print_r($csv = array_map('str_getcsv', file($_FILES['csvFile']['tmp_name'])));
    }
}
