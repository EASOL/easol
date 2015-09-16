<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Easol_Controller {


    protected function accessRules(){
        return [
            "index" => "@",
        ];
    }


    /**
     * index action
     */
    public function index($pageNo=1)
	{
        $this->load->model('entities/easol/Easol_DashboardConfiguration');

        $dashboardConf = (new Easol_DashboardConfiguration())->findOne(['RoleTypeId'=>Easol_Authentication::userdata('RoleId'), 'EducationOrganizationId'=>Easol_Authentication::userdata('SchoolId')]);
        if($dashboardConf!=null){
            $dashboardConf = (new Easol_DashboardConfiguration())->hydrate($dashboardConf);
        }

        $this->render("index",['dashboardConf' =>$dashboardConf,'tablePageNo' => $pageNo]);
	}
}
