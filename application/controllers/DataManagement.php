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
                        $this->importedFileName = $_FILES['csvFile']['name'];
                        //print_r($csv = array_map('str_getcsv', file($_FILES['csvFile']['tmp_name'])));
					/* Tarlles: Why do we have $this->insertCount, $this->failCount, etc in the controller if we already have it in the Easol_CSVProcessor? I guess we can remove it, no? */
                        switch($_POST['data_action']){
                            case 'insert' :
                                try {
                                    if($csvProcessor->insert()){
                                        $msg['status']['msg'] = '<p>Data Inserted Successfully</p>';
                                        $this->insertCount++;
                                    }
                                }
                                catch(\Exception $ex){
                                    $msg['status']['type'] = 'failed';
                                    $msg['status']['msg'] = $ex->getMessage();
                                    $this->failCount++;
                                }
                                break;
                            case 'update' :
                                try {
                                    if($csvProcessor->update()){
                                        $msg['status']['msg'] = '<p>Data Updated Successfully</p>';
                                        $this->updateCount++;
                                    }
                                }
                                catch(\Exception $ex){
                                    $msg['status']['type'] = 'failed';
                                    $msg['status']['msg'] = $ex->getMessage();
                                    $this->failCount++;
                                }
                                break;
                            case 'delete' :
                                try {
                                    if($csvProcessor->delete()){
                                        $msg['status']['msg'] = '<p>Data Deleted Successfully</p>';
                                        //$this->deleteCount++;
                                    }
                                }
                                catch(\Exception $ex){
                                    $msg['status']['type'] = 'failed';
                                    $msg['status']['msg'] = $ex->getMessage();
                                    $this->failCount++;
                                }
                                break;
                            default:
                                $msg['status']['type'] = 'failed';
                                $msg['status']['msg'] = 'Invalid Operation Selected';
                                $this->failCount++;
                        }
                        if ($msg['status']['type'] != 'failed') {
                            foreach ($csvProcessor->result as $type=>$result) {
                                if (!empty($result)) {
                                    if ($type == 'error'){
                                        $msg['status']['msg'] .= "<p>" . sizeof($result) . " records produced errors and could not be processed.</p>";
                                        $this->failCount++;
                                    } else
                                        $msg['status']['msg'] .= "<p>".sizeof($result)." records $type</p>";
                                }
                            }
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
        $this->writeLog($csvProcessor);
        echo json_encode($msg);
    }

    public function checkFile($file, $tableName) {

        $this->load->model('DataManagementQueries');
        $this->objectDescription = $tableName;
        $content = array_map('str_getcsv', file($file));
        $columns = DataManagementQueries::getTableDetails($tableName);


        foreach ($content[0] as $k=>$column_name) {
            if (trim(strtolower($columns[$k]->COLUMN_NAME)) !== trim(strtolower($column_name))) {
               return false;
            }
        }

        return true;
    }

    private function writeLog ($csvProcessor){
	    /* Tarlles: Instead of doing $this->insertCount = $csvProcessor->__getCount... we could just do count($csvProcessor->result['inserted'] */
        $this->insertCount = $csvProcessor->__getCount('insertCount');
        $this->updateCount = $csvProcessor->__getCount('updateCount');
        $this->deleteCount = $csvProcessor->__getCount('deleteCount');
        $this->failCount = $csvProcessor->__getCount('failCount');

	    /* Tarlles: if you already autoloaded the library (in the autoload.php config file), you don't need to load it again with $this->load->library */
        //$this->load->library('Easol_logs');

	    /* Tarlles: Instead of instantiate a new Easol_logs(), CodeIgniter gets it ready to be used, so you can do $this->easol_logs->Log() -- note the library name must be lowercase. Instantiate is fine too, but using $this->easol_logs keeps the code shorter. */
        //$logs = new Easol_logs();

	    /* Tarlles: I removed the StaffUSI, Controller, Method, and IpAddress from here. They will be set in the library class itself, so we don't need to set that up every time we want to call the Log function. */
	    /* Tarlles: A minor detail here. PHP now allows you to declare and set up arrays with a shorter syntax. Instead of $someArray = array('a', 'b', 'c'), we can now do $someArray = ['a', 'b', 'c']. Let's stick with that syntax. */
        $this->easol_logs->Log( [
            'Description'=>'Data Management (Data Upload)',
            "Object"=>$this->objectDescription,
            "ImportedFileName"=>$this->importedFileName,
            "RowsDetails"=>'Inserted['.$this->insertCount.'] Updated['.$this->updateCount.'] Deleted['.$this->deleteCount.'] Failed['.$this->failCount.']',

        ]);

	    /* One last note: This log feature can and probably will be applied in other areas, and more specific fields may be needed. At the end, we may have a lot of columns, and the values would be null for a lot of other columns that wouldn't be used for each log case. For example, we already have the ModelId column that is not being used here. Consider to create a column for "Data" or "Details", and store additional info in a json encoded array. Something like that:

	    $this->easol_logs->Log([
	    	'Description'=>'Data Management (Data Upload)',
	    	'Data'=>["Object"=>$this->objectDescription, "ImportedFileName"=>$this->importedFileName, "Result"=>$csvProcessor->result],
	    ]);

	    In the Easol_Log library, we would do that: $data['Data'] = json_encode($data['Data']).

	    Note that MSSQL has JSON functions so I think it's a good idea to store in json format.

	    If you agree and have time to implement that, please do it. Otherwise, leave as it is, but keep that in mind, so for future implementation of a Log feature in a different area that would require another specific column, then we move to that approach.

	    */
    }

}
