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
}
