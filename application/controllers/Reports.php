<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Easol_Controller {

    /**
     * default constructor
     */
    public function __construct(){
        parent::__construct();
    }

    protected function accessRules(){
        return [
           // "index"     =>  ['@'],
           "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }

    /**
     * index action
     */
    public function index()
	{
	
        $this->load->model('entities/easol/Easol_Report');
        $this->load->model('entities/easol/Easol_DashboardConfiguration');
        $report = new Easol_Report();
        if($this->input->post('dashboardConf')){
            //print_r($this->input->post('dashboardConf'));
            foreach($this->input->post('dashboardConf') as $roleId => $conf){
                $dashConf= (new Easol_DashboardConfiguration())->findOne(['RoleTypeId'=>$roleId,'EducationOrganizationId' => Easol_Authentication::userdata('SchoolId')]);
                if($dashConf==null){
                    $dashConf = new Easol_DashboardConfiguration();
                    $dashConf->RoleTypeId = $roleId;
                    $dashConf->EducationOrganizationId = Easol_Authentication::userdata('SchoolId');


                } else{
                    $dashConf = (new Easol_DashboardConfiguration())->hydrate($dashConf);

                }
                $dashConf->LeftChartReportId = $conf['left'];
                $dashConf->RightChartReportId = $conf['right'];
                $dashConf->BottomTableReportId = $conf['bottom'];
                $dashConf->save();
            }
            $this->session->set_flashdata('message_dash_conf', 'Dashboard Configuration Saved');

            return redirect(site_url("reports/index#dashConf"));

        }

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

                if ($this->form_validation->run() != FALSE) {
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

        }

       // $report->ReportName = "Report";
       /* echo $report->ReportName."sdd";
        echo $report->ReportName."sdd"; */
        //$report->save();
        $this->render("create",['model' => $model]);
    }


    /**
     * @param null | int $id
     * @throws Exception
     */
    public function edit($id=null){
        if($id==null)
            throw new \Exception("Invalid report Id");

        $this->load->model('entities/easol/Easol_Report');

        $model= new Easol_Report();
        $model= $model->hydrate($model->findOne($id));

       // die(print_r($model));
        //die(print_r($this->input->post('access[access]')));
        if($this->input->post('report') && $model->populateForm($this->input->post('report'))) {

            if ($this->form_validation->run() != FALSE) {
                if($model->save()){

                    $this->load->model('entities/easol/Easol_ReportAccess');
    /*
                    foreach($this->input->post('access[access]') as $access){
                        $displayAccess = new Easol_ReportAccess();
                        $displayAccess->ReportId = $model->ReportId;
                        $displayAccess->RoleTypeId = $access;
                        $displayAccess->save();
                    }
    */

                    $aRoles=[];
                    foreach($model->getAccessTypes() as $role){
                        if(!in_array($role->RoleTypeId,$this->input->post('access[access]'))){
                            $this->db->delete('EASOL.ReportAccess', array('ReportId' => $model->ReportId,'RoleTypeId'=>$role->RoleTypeId));
                        }
                        $aRoles[] = $role->RoleTypeId;
                    }

                    foreach($this->input->post('access[access]') as $access){
                        if(in_array($access,$aRoles))
                            continue;
                        $displayAccess = new Easol_ReportAccess();
                        $displayAccess->ReportId = $model->ReportId;
                        $displayAccess->RoleTypeId = $access;
                        $displayAccess->save();
                    }


                    $this->session->set_flashdata('message', 'Report Updated Successfully : '. $model->ReportName);
                    $this->session->set_flashdata('type', 'success');

                    return  redirect(site_url("reports/edit/".$model->ReportId));

                }
            }
        }
        // $report->ReportName = "Report";
        /* echo $report->ReportName."sdd";
         echo $report->ReportName."sdd"; */
        //$report->save();
        $this->render("edit",['model' => $model]);

    }

    public function view($id=null, $pageNo=1){
        if($id==null)
            throw new \Exception("Invalid report Id");
        $this->load->model('entities/easol/Easol_Report');

        $model= new Easol_Report();
        $model= $model->hydrate($model->findOne($id));

        switch($model->ReportDisplayId){

            case 1:
                return $this->render("display-table",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true]);
                break;
            case 2:
                return $this->render("display-bar-chart",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true]);
                break;
            case 3:
                return $this->render("display-pie-chart",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true]);
                break;
            case 4:
                return $this->render("display-stacked-bar-chart",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true]);
                break;
            default:
                throw new \Exception("Invalid Report Display type..");

        }

       // return $this->render();

    }

    public function preview() {
        $post = $this->input->post();
       
        if ($this->form_validation->run() == FALSE) {
            $response = array('status'=>'error', 'message'=>validation_errors());
            exit(json_encode($response));
        }

        $this->load->model('entities/easol/Easol_Report');
        $model = new Easol_Report();
        foreach ($post['report'] as $field=>$value) {
            $model->$field = $value;
        }

        $pageNo = 1;

        $response = array();
        $response['status'] = 'success';

        switch($model->ReportDisplayId){

            case 1:
                $response['html'] = $this->load->view("reports/display-table",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true], true);
                break;
            case 2:
                $response['html'] = $this->load->view("reports/display-bar-chart",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true], true);
                break;
            case 3:
                $response['html'] = $this->load->view("reports/display-pie-chart",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true], true);
                break;
            case 4:
                $response['html'] = $this->load->view("reports/display-stacked-bar-chart",['model' => $model,'pageNo' => $pageNo,'displayTitle'=>true], true);
                break;
            default:
                throw new \Exception("Invalid Report Display type..");

        }

        exit(json_encode($response));
    }

    public function delete($id= null){
        if($id==null)
            throw new \Exception("Invalid report Id");
        $this->db->delete('EASOL.Report', array('ReportId' => $id));

        $this->session->set_flashdata('message', 'Report Successfully deleted');
        $this->session->set_flashdata('type', 'success');

        return  redirect(site_url("reports"));


    }

    public function createCategory(){
        $this->load->model('entities/easol/Easol_ReportCategory');

        $model = new Easol_ReportCategory();
        if($this->input->post('ReportCategory') && $model->populateForm($this->input->post('ReportCategory'))){


            if($model->save()){
                $this->session->set_flashdata('message', 'Category : '.$model->ReportCategoryName.' Successfully added');
                $this->session->set_flashdata('type', 'success');

                return  redirect(site_url("reports/create"));

            }
        }


        return $this->render("createcategory",['model' => $model]);
    }
}
