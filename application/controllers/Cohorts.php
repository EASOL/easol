<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cohorts extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }
    /**
     * index action
     */
    public function index($id=1)
	{

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

    public function students($cohortIdentifier=0){
       echo $cohortIdentifier;

        return $this->render("students");
    }
}
