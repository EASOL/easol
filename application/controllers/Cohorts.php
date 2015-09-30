<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cohorts extends Easol_Controller {

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
    public function index($id=1){
        
        $query = "SELECT StudentCohortAssociation.CohortIdentifier, Cohort.CohortDescription, COUNT(*) as StudentCount FROM edfi.StudentCohortAssociation
INNER JOIN edfi.Cohort ON
     Cohort.CohortIdentifier = StudentCohortAssociation.CohortIdentifier AND Cohort.EducationOrganizationId = StudentCohortAssociation.EducationOrganizationId
WHERE StudentCohortAssociation.EducationOrganizationId = '".Easol_Authentication::userdata('SchoolId')."'
                  ";


        $this->render("index", [
            'query' => $query,
            'colOrderBy' => ['Cohort.CohortDescription'],
            'colGroupBy' => ['StudentCohortAssociation.CohortIdentifier','Cohort.CohortDescription'],
            'filter' => [
                'dataBind' => true,
                'bindIndex' => [],
                'queryWhere' => false,
                'fields' =>
                    [



                        'Result'    =>
                            [
                                'range'     =>
                                    [
                                        'type'  =>  'set',
                                        'set'   =>  [10,25,50,100,200,500]
                                    ],
                                'default'   =>  (!$this->input->get('filter[Result]')) ? 2 : $this->input->get('filter[Result]'),
                                'label'     =>  'Results',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => false,
                                'fieldType' => 'pageSize'
                            ],

                    ]

            ],
            'pagination' =>
                [
                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $id,
                    'url' => 'cohorts/index/@pageNo'
                ]
        ]);
	}

    /**
     * @param int $cohortIdentifier
     * @return null|string
     */
    public function students($cohortIdentifier=0,$id=1){


        $this->load->model("entities/edfi/Edfi_Cohort",'Edfi_Cohort');
        $cohort = $this->Edfi_Cohort->findOneBySql("select Cohort.CohortIdentifier, Cohort.CohortDescription from edfi.Cohort
WHERE Cohort.CohortIdentifier = ? and Cohort.EducationOrganizationId = ? ",[$cohortIdentifier,Easol_Authentication::userdata('SchoolId')]);

        $query="SELECT Student.FirstName, Student.LastSurname,Student.StudentUSI FROM edfi.StudentCohortAssociation
INNER JOIN edfi.Student ON Student.StudentUSI = StudentCohortAssociation.StudentUSI
WHERE StudentCohortAssociation.EducationOrganizationId = ".Easol_Authentication::userdata('SchoolId')." and StudentCohortAssociation.CohortIdentifier = '".$cohort->CohortIdentifier."'

 ";

        //die($query);

        return $this->render("students",['cohort'=>$cohort,
            'query' => $query,
            'colOrderBy' => ['Student.FirstName','Student.LastSurname'],
            'pagination' =>
                [
                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $id,
                    'url' => 'cohorts/students/'.$cohort->CohortIdentifier.'/@pageNo'
                ]


        ]);
    }
}
