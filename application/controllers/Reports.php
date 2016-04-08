<?php

set_time_limit(0);
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
            "index"     =>  ['System Administrator','Data Administrator','School Administrator'],
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

        $post = $this->input->post('report');
        if (!empty($post['Settings'])) {
            $post['Settings'] = json_encode($post['Settings']);
        } 
        //die(print_r($this->input->post('access[access]')));
        if($this->input->post('report') && $model->populateForm($post)){

            if ($this->form_validation->run() != FALSE) {
                if($model->save()){

                    $this->load->model('entities/easol/Easol_ReportAccess');

                    if (is_array($this->input->post('access[access]'))) {
                        foreach ($this->input->post('access[access]') as $access) {
                            $displayAccess             = new Easol_ReportAccess();
                            $displayAccess->ReportId   = $model->ReportId;
                            $displayAccess->RoleTypeId = $access;
                            $displayAccess->save();
                        }
                    }

                    $this->load->model('entities/easol/Easol_ReportFilter');
                    $this->Easol_ReportFilter->delete($model->ReportId);

                    if (is_array($this->input->post('filter'))) {
                        foreach ($this->input->post('filter') as $filter) {
                            $ReportFilter             = new Easol_ReportFilter();
                            $ReportFilter->ReportId   = $model->ReportId;
                            $ReportFilter->DisplayName = $filter['DisplayName'];
                            $ReportFilter->FieldName = $filter['FieldName'];
                            $ReportFilter->FilterType = $filter['FilterType'];
                            $ReportFilter->FilterOptions = $filter['FilterOptions'];
                            $ReportFilter->DefaultValue = $filter['DefaultValue'];
                            $ReportFilter->save();
                        }
                    }
                    
                    $this->load->model('entities/easol/Easol_ReportLink');
                    $this->Easol_ReportLink->delete($model->ReportId);

                    if (is_array($this->input->post('link'))) {
                        foreach ($this->input->post('link') as $link) {
                            $ReportLink             = new Easol_ReportLink();
                            $ReportLink->ReportId   = $model->ReportId;
                            $ReportLink->URL = $link['URL'];
                            $ReportLink->ColumnNo = $link['ColumnNo'];
                            $ReportLink->save();
                        }
                    }
                    
                    $this->session->set_flashdata('message', 'New Report Added : '. $model->ReportName);
                    $this->session->set_flashdata('type', 'success');

                    $this->easol_logs->Log( [
                        'Description'=>'Flex Report (create)',
                        'Data'=>["ModelId"=>$model->ReportId]
                    ]);
                    

                    return redirect(site_url("reports/index"));

                }
            }
            else {
                $post = $this->input->post();
                foreach ($post['report'] as $field=>$value) {
                    if (is_array($value)) $model->$field = json_decode(json_encode($value));
                    else $model->$field = $value;
                }
                
                if (!empty($post['filter'])) {
                    $model->filters = [];
                    foreach ($post['filter'] as $field=>$value) {
                        if (is_array($value)) {
                            $model->filters[$field] = json_decode(json_encode($value));
                            $model->filters[$field]->ReportFilterId = $field;
                        }
                        else $model->filters[$field] = $value;
                    }   
                }
                
                if (!empty($post['link'])){
                    $model->links = [];
                    foreach ($post['link'] as $field=>$value) {
                        if (is_array($value)) {
                            $model->links[$field] = json_decode(json_encode($value));
                            $model->links[$field]->ReportLinkId = $field;
                        }
                        else $model->links[$field] = $value;
                    }
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
        if (is_json($model->Settings)) $model->Settings = json_decode($model->Settings);

        // die(print_r($model));
        //die(print_r($this->input->post('access[access]')));
        $post = $this->input->post('report');
        if (!empty($post['Settings'])) {
            $post['Settings'] = json_encode($post['Settings']);
        } 
        
        if($this->input->post('report') && $model->populateForm($post)) {

            if ($this->form_validation->run() != FALSE) {
                $arrOldValue = $this->stdToArray($model->findOne($id));
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

                    if (is_array($this->input->post('access[access]'))) {
                        foreach ($this->input->post('access[access]') as $access) {
                            if (in_array($access, $aRoles))
                                continue;
                            $displayAccess             = new Easol_ReportAccess();
                            $displayAccess->ReportId   = $model->ReportId;
                            $displayAccess->RoleTypeId = $access;
                            $displayAccess->save();
                        }
                    }

                    $this->load->model('entities/easol/Easol_ReportFilter');
                    $this->Easol_ReportFilter->delete($model->ReportId);

                    if (is_array($this->input->post('filter'))) {
                        foreach ($this->input->post('filter') as $filter) {
                            $ReportFilter             = new Easol_ReportFilter();
                            $ReportFilter->ReportId   = $model->ReportId;
                            $ReportFilter->DisplayName = $filter['DisplayName'];
                            $ReportFilter->FieldName = $filter['FieldName'];
                            $ReportFilter->FilterType = $filter['FilterType'];
                            $ReportFilter->FilterOptions = $filter['FilterOptions'];
                            $ReportFilter->DefaultValue = $filter['DefaultValue'];
                            $ReportFilter->save();
                        }
                    }

                    $this->load->model('entities/easol/Easol_ReportLink');
                    $this->Easol_ReportLink->delete($model->ReportId);

                    if (is_array($this->input->post('link'))) {
                        foreach ($this->input->post('link') as $link) {
                            $ReportLink             = new Easol_ReportLink();
                            $ReportLink->ReportId   = $model->ReportId;
                            $ReportLink->URL = $link['URL'];
                            $ReportLink->ColumnNo = $link['ColumnNo'];
                            $ReportLink->save();
                        }
                    }
                    
                    $this->session->set_flashdata('message', 'Report Updated Successfully : '. $model->ReportName);
                    $this->session->set_flashdata('type', 'success');

                    unset($arrOldValue['ReportId'], $arrOldValue['CreatedBy'], $arrOldValue['CreatedOn'], $arrOldValue['UpdatedBy'], $arrOldValue['UpdatedOn'], $arrOldValue['SchoolId']);
                    $this->easol_logs->Log( [
                        'Description'=>'Flex Report (Update)',
                        'Data'=>["ModelId"=>$model->ReportId, 'OldValue'=>json_encode($this->stdToArray($arrOldValue)),'NewValue'=>json_encode($this->input->post('report'))]
                    ]);

                    return  redirect(site_url("reports/edit/".$model->ReportId));

                }
            }
            else {
                $post = $this->input->post();
                foreach ($post['report'] as $field=>$value) {
                    if (is_array($value)) $model->$field = json_decode(json_encode($value));
                    else $model->$field = $value;
                }
                
                if (!empty($post['filter'])) {
                    $model->filters = [];
                    foreach ($post['filter'] as $field=>$value) {
                        if (is_array($value)) {
                            $model->filters[$field] = json_decode(json_encode($value));
                            $model->filters[$field]->ReportFilterId = $field;
                        }
                        else $model->filters[$field] = $value;
                    }   
                }
                
                if (!empty($post['link'])){
                    $model->links = [];
                    foreach ($post['link'] as $field=>$value) {
                        if (is_array($value)) {
                            $model->links[$field] = json_decode(json_encode($value));
                            $model->links[$field]->ReportLinkId = $field;
                        }
                        else $model->links[$field] = $value;
                    }
                }
            }
        }
        // $report->ReportName = "Report";
        /* echo $report->ReportName."sdd";
         echo $report->ReportName."sdd"; */
        //$report->save();
        $this->render("edit",['model' => $model]);

    }

    public function stdToArray($obj) {
        $reaged = (array) $obj;
        foreach ($reaged as $key => &$field) {
            if (is_object($field))
                $field = stdToArray($field);
        }
        return $reaged;
    }

    public function view($id=null){
        if($id==null)
            throw new \Exception("Invalid report Id");
        $this->load->model('entities/easol/Easol_Report');

        $model= new Easol_Report();
        $model= $model->hydrate($model->findOne($id));

        switch($model->DisplayType){

            case 'table':
                return $this->render("display-table",['model' => $model, 'displayTitle'=>true]);
                break;
            case 'bar-chart':
                return $this->render("display-bar-chart",['model' => $model, 'displayTable' => true,'displayTitle'=>true]);
                break;
            case 'pie-chart':
                return $this->render("display-pie-chart",['model' => $model, 'displayTable' => true,'displayTitle'=>true]);
                break;
            
            default:
                throw new \Exception("Invalid Report Display type..");

        }

       // return $this->render();

    }

    public function preview() {
        $post = $this->input->post();

        if ($this->form_validation->run() == FALSE) {
            $response = array('status'=>'error', 'html'=>validation_errors());
            exit(json_encode($response));
        }

        $this->load->model('entities/easol/Easol_Report');
        $model = new Easol_Report();
        foreach ($post['report'] as $field=>$value) {
            if (is_array($value)) $model->$field = json_encode($value);
            else $model->$field = $value;
        }
        $model->filters = [];
        if (!empty($post['filter'])) {
            foreach ($post['filter'] as $field=>$value) {
                if (is_array($value)) {
                    $model->filters[$field] = json_decode(json_encode($value));
                    $model->filters[$field]->ReportFilterId = $field;
                }
                else $model->filters[$field] = $value;
            }    
        }

        $model->links = [];
        if (!empty($post['link'])) {
            foreach ($post['link'] as $field=>$value) {
                if (is_array($value)) {
                    $model->links[$field] = json_decode(json_encode($value));
                    $model->links[$field]->ReportLinkId = $field;
                }
                else $model->links[$field] = $value;
            }
        }
       
        $response = array();
        $response['status'] = 'success';

        switch($model->DisplayType){

            case 'table':
                $response['html'] = $this->load->view("reports/display-table",['model' => $model, 'displayTitle'=>true], true);
                break;
            case 'bar-chart':
                $response['html'] = $this->load->view("reports/display-bar-chart",['model' => $model,'displayTitle'=>true], true);
                break;
            case 'pie-chart':
                $response['html'] = $this->load->view("reports/display-pie-chart",['model' => $model,'displayTitle'=>true], true);
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

        $this->easol_logs->Log( [
            'Description'=>'Flex Report (delete)',
            'Data'=>["ModelId"=>$id]
        ]);

        return  redirect(site_url("reports"));


    }

    public function export($id) {

        $this->db->where('ReportId', $id);
        $this->db->join('EASOL.ReportCategory', 'ReportCategory.ReportCategoryId = Report.ReportCategoryId', 'left');
        $query = $this->db->get('EASOL.Report');

        $report = [];
        $report['Report'] = $query->row_array();

        $related = ['ReportFilter', 'ReportLink'];
        foreach ($related as $table) {
            $report[$table] = [];
            $this->db->where('ReportId', $id);
            $query = $this->db->get("EASOL.{$table}");
            foreach ($query->result_array() as $row) {
                $report[$table][] = $row; 
            }
        }

        $filename = slug($report['Report']['ReportName']);

        header('Content-disposition: attachment; filename='.$filename.'.json');
        header('Content-type: application/json');
        echo json_encode($report);
         
    }

    public function import() {

        $error = false;
        if (!$file = $_FILES['import']) {
            $this->session->set_flashdata('message', 'Please Select a File.');
            $this->session->set_flashdata('type', 'error');

            $error = true;
        }
        else {
            $input = file_get_contents($file['tmp_name']);
            $input = json_decode($input, true);
            if (json_last_error()) {
                $this->session->set_flashdata('message', 'Please Select a Valid Flex Report Export File.');
                $this->session->set_flashdata('type', 'error');

                $error = true;
            }
        }

        if (!$error) {
             $this->load->model('entities/easol/Easol_Report');
            if ($ReportId = $this->input->post('ReportId')) {
                
                $model= new Easol_Report();
                $model= $model->hydrate($model->findOne($ReportId));
            }
            else {             

                $model= new Easol_Report();
            }

            $report = $input['Report'];
            if (!$report) {
                $this->session->set_flashdata('message', 'The export file has invalid report data.');
                $this->session->set_flashdata('type', 'error');

                $error = true;
            }
            else {                   

                $report['ReportCategoryId'] = $this->_import_category($report);
                 unset($report['ReportId'], $report['CreatedBy'], $report['CreatedOn'], $report['UpdatedBy'], $report['UpdatedOn'], $report['ReportCategoryName']);

                 if ($ReportId) $report['ReportId'] = $ReportId;

                $model->populateForm($report);
                if ($model->save()) {
                    
                    if (!empty($input['ReportFilter'])) {
                        $this->load->model('entities/easol/Easol_ReportFilter');
                        $this->Easol_ReportFilter->delete($model->ReportId);
                        foreach ($input['ReportFilter'] as $filter) {
                            $ReportFilter             = new Easol_ReportFilter();
                            $ReportFilter->ReportId   = $model->ReportId;
                            $ReportFilter->DisplayName = $filter['DisplayName'];
                            $ReportFilter->FieldName = $filter['FieldName'];
                            $ReportFilter->FilterType = $filter['FilterType'];
                            $ReportFilter->FilterOptions = $filter['FilterOptions'];
                            $ReportFilter->DefaultValue = $filter['DefaultValue'];
                            $ReportFilter->save();
                        }
                    }

                    if (!empty($input['ReportLink'])) {
                    
                        $this->load->model('entities/easol/Easol_ReportLink');
                        $this->Easol_ReportLink->delete($model->ReportId);
                        
                        foreach ($input['ReportLink'] as $link) {
                            $ReportLink             = new Easol_ReportLink();
                            $ReportLink->ReportId   = $model->ReportId;
                            $ReportLink->URL = $link['URL'];
                            $ReportLink->ColumnNo = $link['ColumnNo'];
                            $ReportLink->save();
                        }
                    }
                    
                    if (!$ReportId) {
                        $this->session->set_flashdata('message', 'New Report Imported : '. $model->ReportName);
                        $this->session->set_flashdata('type', 'success');

                        $this->easol_logs->Log( [
                            'Description'=>'Flex Report (import)',
                            'Data'=>["ModelId"=>$model->ReportId]
                        ]);

                        
                    }
                    else {
                        $this->session->set_flashdata('message', 'Report Updated From Export File : '. $model->ReportName);
                        $this->session->set_flashdata('type', 'success');

                        $this->easol_logs->Log( [
                            'Description'=>'Flex Report (update - import)',
                            'Data'=>["ModelId"=>$model->ReportId]
                        ]);

                        
                    }
                    
                    return redirect("reports/edit/".$model->ReportId);
                   

                }
                else {
                    $this->session->set_flashdata('message', 'The export file has invalid report data.');
                    $this->session->set_flashdata('type', 'error');

                    $error = true;
                }
            }
        }

        if ($error) {
            if ($ReportId = $this->input->post('ReportId')) redirect(site_url("reports/edit/".$ReportId));
            else redirect("reports/create");
        }                   

    }

    public function _import_category($report) {
        $this->db->where('ReportCategoryName', $report['ReportCategoryName']);
        $query = $this->db->get('EASOL.ReportCategory');

        $category = $query->row();

        if (empty($category)) {
            $this->load->model('entities/easol/Easol_ReportCategory');

            $model = new Easol_ReportCategory();
            $model->populateForm(['ReportCategoryName'=>$report['ReportCategoryName']]);
            if ($model->save()) {
                return $model->ReportCategoryId;
            }
            else return null;
        }

        return $category->ReportCategoryId;
    }

    public function createCategory($ReportId=null){
        $this->load->model('entities/easol/Easol_ReportCategory');

        $model = new Easol_ReportCategory();
        if($this->input->post('ReportCategory') && $model->populateForm($this->input->post('ReportCategory'))){


            if($model->save()){
                $this->session->set_flashdata('message', 'Category : '.$model->ReportCategoryName.' Successfully added');
                $this->session->set_flashdata('type', 'success');

                if ($ReportId = $this->input->post('ReportId')) redirect("reports/edit/".$ReportId);
                return  redirect(site_url("reports/create"));

            }
        }


        return $this->render("createcategory",['model' => $model, 'ReportId'=>$ReportId]);
    }
}
