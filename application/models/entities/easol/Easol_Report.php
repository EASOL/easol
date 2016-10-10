<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';

/**
 * example of basic @param usage
 * @param int $ReportId
 * @param $ReportName string
 */
class Easol_Report extends Easol_BaseEntity {

    private $category = NULL;
    private $school = NULL;
    private $accessTypes = NULL;
    public $filters = NULL;
    public $links = NULL;

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
            "CreatedBy"  =>  "Created By",
            "CreatedOn"  =>  "CreatedOn",
            "UpdatedBy"  =>  "UpdatedBy",
            "UpdatedOn"  =>  "UpdatedOn",
            "SchoolId"  =>  "SchoolId",
            "DisplayType"  =>  "Display Type",
            "Settings"  =>"Settings"
        ];
    }

    public function beforeSave()
    {
        $this->SchoolId = Easol_Auth::userdata("SchoolId");
        parent::beforeSave();
    }

    /**
     * @return array
     */
    public function validationRules()
    {
        return [
            'ReportName' => ['string','Required'],
            'ReportCategoryId' => ['int','Required'],
            'CommandText' => ['string','Required','Is Safe Query'],
            'DisplayType' => ['string','Required'],
            'Settings'  => ['string']
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


    public function getCategory()
    {
        if($this->category==NULL) {
            $this->load->model('entities/easol/Easol_ReportCategory');
            $category = new Easol_ReportCategory();
            $this->category = $category->findOne(['ReportCategoryId' => $this->ReportCategoryId]);
        }
        return $this->category;
    }

    public function getSchool()
    {

        if($this->school==NULL) {
            $this->load->model('entities/edfi/Edfi_EducationOrganization');
            $school = new Edfi_EducationOrganization();
            $this->school = $school->hydrate($school->findOne($this->SchoolId));
        }
        return $this->school;
    }

    

    public function getFilters()
    {

        if (!$this->filters) {
            $query = $this->db->query("SELECT ReportFilterId ,ReportId , DisplayName ,FieldName ,FilterType ,FilterOptions ,DefaultValue 
                                    FROM EASOL.ReportFilter WHERE ReportId=?
                                    ORDER BY ReportFilterId ASC", 
                                    [
                                        $this->ReportId
                                    ]);
            return $query->result();
        }

        return $this->filters;

    }
    
    public function getLinks()
    {
        if (!$this->links) {
            $query = $this->db->query("SELECT ReportLinkId ,ReportId , URL ,ColumnNo
                                    FROM EASOL.ReportLink WHERE ReportId=?
                                    ORDER BY ReportLinkId ASC", 
                                    [
                                        $this->ReportId
                                    ]);
            return $query->result();
        }

        return $this->links;

    }
    
    /**
     * @return null|object
     */
    //public $dt=0;
    public function getAccessTypes()
    {

        if($this->accessTypes==NULL && !property_exists($this, "flagAccessTypes")) {
            $this->flagAccessTypes = TRUE;
            //echo '#'.(++$this->dt).'sspd';
            $this->accessTypes = [];
            $this->load->model('entities/easol/Easol_ReportAccess');
            $accessType = new Easol_ReportAccess();

            $this->accessTypes = $accessType->findAllBySql("SELECT EASOL.RoleType.* FROM EASOL.ReportAccess, EASOL.RoleType WHERE EASOL.RoleType.RoleTypeId=EASOL.ReportAccess.RoleTypeId AND EASOL.ReportAccess.ReportId=? ORDER BY RoleTypeName ASC", [$this->ReportId]);


        }

        return $this->accessTypes;

    }

    public function getReportData()
    {

        $query = $this->getReportQuery();

        return $this->findAllBySql($query);

        if($this->DisplayType == 'bar-chart')
            return $this->findAllBySql($query);
        if($this->DisplayType == 'pie-chart')
            return $this->findAllBySql($query);

    }

    public function getReportQuery($query=NULL, $filters=NULL) 
    {
        
        if (!$query) $query = $this->CommandText;
        if ($filters === NULL) $filters = $this->getFilters();
        $get = $this->input->get('filter');

        if (!empty($filters)) {
            foreach ($filters as $key=>$filter) {

                if (is_array($filter)) $filter = json_decode(json_encode($filter), FALSE);

                if (stripos($query, '$filter.'.$filter->FieldName) !== FALSE) {

                    $fieldName = str_replace(".", "-", $filter->FieldName);

                    $value = (isset($get[$this->ReportId][$fieldName])) ? $get[$this->ReportId][$fieldName] : system_variable($filter->DefaultValue);

                    $query = str_ireplace('$filter.'.$filter->FieldName, $value, $query);
                    unset($filters[$key]);
                }

                
            }
        }

        $where[] = "1=1";
      
        if (!empty($filters)) {

            foreach($filters as $key => $filter){ 

                if (is_array($filter)) $filter = json_decode(json_encode($filter), FALSE);

                $fieldName = str_replace(".", "-", $filter->FieldName);

                if (isset($get[$this->ReportId][$fieldName]) or $filter->DefaultValue) {
                    $value = (isset($get[$this->ReportId][$fieldName])) ? $get[$this->ReportId][$fieldName] : system_variable($filter->DefaultValue);

                    if (!$value) continue;

                    if ($filter->FilterType == "System Variable") $value = system_variable($filter->DefaultValue);
                    
                    $operator = "=";
                    if ($filter->FilterType == 'Free Text') {
                        $operator = 'LIKE';
                        $value = "%{$value}%";
                    }

                    $where[] ="$filter->FieldName $operator '$value'";
                }
             
            }

            
        }

        $where = implode(" AND ", $where);
       
        $query = str_ireplace(['$filters', '$filter'], $where, $query);


        return $query;
    }

    public function getViewName()
    {
       
        switch($this->DisplayType){

            case 'table':
                return "display-table";
                break;
            case 'bar-chart':
                return "display-bar-chart";
                break;
            case 'pie-chart':
                return "display-pie-chart";
                break;
            
            default:
                throw new \Exception("Invalid Report Display type..");

        }
    }
}
