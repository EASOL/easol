<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';

/**
 * example of basic @param usage
 * @param int $ReportId
 * @param $ReportName string
 */
class Easol_Report extends Easol_BaseEntity {

    private $category = null;
    private $school = null;
    private $displayType = null;
    private $accessTypes = null;

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return  "EASOL.Report";
    }



    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            "ReportId"    =>  "Report Id",
            "ReportName"  =>  "Report Name",
            "ReportCategoryId"  =>  "Report Category",
            "CommandText"  =>  "Command Text",
            "LabelX"  =>  "X Axis Label",
            "LabelY"  =>  "Y Axis Label",
            "ReportDisplayId"  =>  "Display Type",
            "CreatedBy"  =>  "Created By",
            "CreatedOn"  =>  "CreatedOn",
            "UpdatedBy"  =>  "UpdatedBy",
            "UpdatedOn"  =>  "UpdatedOn",
            "SchoolId"  =>  "SchoolId",
        ];
    }

    public function beforeSave(){
        $this->SchoolId = Easol_Authentication::userdata("SchoolId");
        parent::beforeSave();
    }

    /**
     * @return array
     */
    public function validationRules(){
        return [
            'ReportName' => ['string','Required'],
            'ReportCategoryId' => ['int','Required'],
            'CommandText' => ['string','Required','Is Safe Query'],
            'LabelX' => ['string','Required'],
            'LabelY' => ['string','Required'],
            'ReportDisplayId' => ['int','Required'],
        ];
    }

    /**
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        return "ReportId";
    }


    public function getCategory(){
        if($this->category==null) {
            $this->load->model('entities/easol/Easol_ReportCategory');
            $category = new Easol_ReportCategory();
            $this->category = $category->findOne(['ReportCategoryId' => $this->ReportCategoryId]);
        }
        return $this->category;
    }

    public function getSchool(){

        if($this->school==null) {
            $this->load->model('entities/edfi/Edfi_EducationOrganization');
            $school = new Edfi_EducationOrganization();
            $this->school = $school->hydrate($school->findOne($this->SchoolId));
        }
        return $this->school;
    }

    public function getDisplayType(){

        if($this->displayType==null) {
            $this->load->model('entities/easol/Easol_ReportDisplay');
            $displayType = new Easol_ReportDisplay();
            $this->displayType = $displayType->hydrate($displayType->findOne($this->ReportDisplayId));
        }
        return $this->displayType;
    }

    public function getFilters(){
        $query = $this->db->query("SELECT ReportFilterId ,ReportId , DisplayName ,FieldName ,FilterType ,FilterOptions ,DefaultValue 
                                FROM EASOL.ReportFilter WHERE ReportId=?
                                ORDER BY ReportFilterId ASC", 
                                [
                                    $this->ReportId
                                ]);
        return $query->result();

    }
    
    /**
     * @return null|object
     */
    //public $dt=0;
    public function getAccessTypes(){

        if($this->accessTypes==null && !property_exists($this,"flagAccessTypes")) {
            $this->flagAccessTypes = true;
            //echo '#'.(++$this->dt).'sspd';
            $this->accessTypes = [];
            $this->load->model('entities/easol/Easol_ReportAccess');
            $accessType = new Easol_ReportAccess();

            $this->accessTypes = $accessType->findAllBySql("SELECT EASOL.RoleType.* FROM EASOL.ReportAccess, EASOL.RoleType WHERE EASOL.RoleType.RoleTypeId=EASOL.ReportAccess.RoleTypeId AND EASOL.ReportAccess.ReportId=? ORDER BY RoleTypeName ASC",[$this->ReportId]);


        }

        return $this->accessTypes;

    }

    public function getReportData(){

        $query = $this->getReportQuery();

        if($this->ReportDisplayId==2 || $this->ReportDisplayId==4)
            return $this->findAllBySql($query);
        if($this->ReportDisplayId==3)
            return $this->findOneBySql($query);

    }

    public function getReportQuery($args=[]) {
        
        $query = $this->CommandText;
        $filters = $this->getFilters();
        $get = $this->input->get('filter');

        $this->load->library('Easol_SQLParser');
        $parser = New Easol_SQLParser();
        $query = $parser->Parse($query);

        if (!empty($filters)) {

            if (!isset($query['WHERE'])) $query['WHERE'] = [];

            foreach($filters as $key => $filter){ 

                $fieldName = str_replace(".", "-", $filter->FieldName);

                if (isset($get[$fieldName]) or $filter->DefaultValue) {
                     $value = (isset($get[$fieldName])) ? $get[$fieldName] : system_variable($filter->DefaultValue);

                    if (!$value) continue;

                    if (!empty($query['WHERE'])) {
                        $query['WHERE'][] = [
                            'expr_type' => 'operator',
                            'base_expr' => 'AND',
                            'sub_tree' => ''
                        ];
                    }


                    if ($filter->FilterType == "System Variable") $value = system_variable($filter->DefaultValue);
                    $query['WHERE'][] = [
                        'expr_type' => 'colref',
                        'base_expr' => "$filter->FieldName",
                        'no_quotes' => "$filter->FieldName",
                    ];

                    $operator = "=";
                    if ($filter->FilterType == 'Free Text') {
                        $operator = 'LIKE';
                        $value = "%{$value}%";
                    }

                    $query['WHERE'][] = [
                        'expr_type' => 'operator',
                        'base_expr' => $operator,
                        'sub_tree' => ''
                    ];

                    $query['WHERE'][] = [
                        'expr_type' => 'const',
                        'base_expr' => "'{$value}'",
                        'sub_tree' => ''
                    ];
                }
             
            }
        }

        foreach ($args as $field=>$value) {
            if ($value === false) unset($query[$field]);
        }

        if (empty($query['WHERE'])) unset($query['WHERE']);

        $query = str_replace('Version()','Version', $parser->Create($query));
        return $query;
    }

    public function getViewName(){
        switch($this->ReportDisplayId){

            case 1:
                return "display-table";
                break;
            case 2:
                return "display-bar-chart";
                break;
            case 3:
                return "display-pie-chart";
                break;
            case 4:
                return "display-stacked-bar-chart";
                break;
            default:
                throw new \Exception("Invalid Report Display type..");

        }
    }
}