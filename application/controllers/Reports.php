<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Easol_Controller {

    protected function accessRules(){
        return [
           // "index"     =>  ['@'],
            //"index"     =>  ['System Administrator','Data Administrator'],
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
        if($this->input->post('report') && $model->populateForm($this->input->post('report'))){
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
                return $this->render("display-table",['model' => $model,'pageNo' => $pageNo]);
                break;
            case 2:
                return $this->render("display-bar-chart",['model' => $model]);
                break;
            case 3:
                return $this->render("display-pie-chart",['model' => $model]);
                break;
            case 4:
                return $this->render("display-stacked-bar-chart",['model' => $model]);
                break;
            default:
                throw new \Exception("Invalid Report Display type..");

        }

       // return $this->render();

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
