<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Easol_Controller {

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
        $this->load->model('entities/easol/Easol_Report');
        $report = new Easol_Report();

		$this->render("index",['reports' => $report->hydrate($report->findAll()->result())]);
	}

    /**
     * index action
     */
    public function create()
    {
        $this->load->model('entities/easol/Easol_Report');

        $model= new Easol_Report();
       //die(print_r($this->input->post('access[access]')));
        if($this->input->post('report') && $model->populateForm($this->input->post('report'))){
                if($model->save()){

                    $this->load->model('entities/easol/Easol_ReportAccess');

                    foreach($this->input->post('access[access]') as $access){
                       $displayAccess = new Easol_ReportAccess();
                        $displayAccess->ReportId = $model->ReportId;
                        $displayAccess->RoleTypeId = $access;
                        $displayAccess->save();
                    }
                    $this->session->set_flashdata('message', 'New Report Added : '. $model->ReportName);
                    $this->session->set_flashdata('type', 'success');

                    return redirect(site_url("reports/index"));

                }

        }
       // $report->ReportName = "Report";
       /* echo $report->ReportName."sdd";
        echo $report->ReportName."sdd"; */
        //$report->save();
        $this->render("create",['model' => $model]);
    }
}
