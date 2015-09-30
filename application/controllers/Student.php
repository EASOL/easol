<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }


    /**
     * index action
     * @param int $id
     */
    public function index($id=1)
    {
    	$currentYear = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
    	$currentYear_default=Easol_SchoolConfiguration::setDefault('Year', $currentYear);

        $query= "SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.Description, StudentCohortAssociation.CohortIdentifier from edfi.StudentSchoolAssociation
INNER JOIN edfi.Student ON
     StudentSchoolAssociation.StudentUSI = Student.StudentUSI
INNER JOIN edfi.GradeLevelDescriptor ON
     StudentSchoolAssociation.EntryGradeLevelDescriptorId = GradeLevelDescriptor.GradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON
     GradeLevelDescriptor.GradeLevelTypeId = GradeLevelType.GradeLevelTypeId
LEFT JOIN edfi.StudentCohortAssociation ON
      StudentCohortAssociation.EducationOrganizationId = StudentSchoolAssociation.SchoolId AND StudentCohortAssociation.StudentUSI = StudentSchoolAssociation.StudentUSI
WHERE
     StudentSchoolAssociation.SchoolId = '".Easol_Authentication::userdata('SchoolId')."'

                  ";



        $this->render("index",[
            'query' => $query,
            'colOrderBy' => ['GradeLevelType.Description','Student.FirstName','Student.LastSurname','Student.StudentUSI','StudentCohortAssociation.CohortIdentifier'],
            'filter' =>[
                'dataBind' => true,
                'bindIndex' => ['GradeLevel' => ['glue'=>'and'],'Year' => ['glue'=>'and'],'Cohort' => ['glue'=>'and'] ],
                'bindSort' => ['Sort'],
                'queryWhere' => false,
                'fields' =>
                    [

                        'Year' =>
                            [
                                'range' =>
                                    [
                                        'type' => 'dynamic',
                                        'start' => $currentYear, //2000,
                                        'end' => date('Y'),
                                        'increament' => 1,
                                    ],
                                'searchColumn' => 'SchoolYear',
                                'searchColumnType' => 'int',
                                'queryBuilderColumn'=>  'StudentSchoolAssociation.SchoolYear',
                                'default' => ($this->input->get('filter[Year]') == null) ? $currentYear_default : $this->input->get('filter[Year]'),
                                'label' => 'Year',
                                'type' => 'dropdown',
                                'bindDatabase' => true,
                                'prompt' => 'All Years'

                            ],
                        'GradeLevel' =>
                            [
                                'query'     =>  $this->db->query("SELECT * FROM edfi.GradeLevelType"),
                                'searchColumn'    =>  'GradeLevelTypeId',
                                'textColumn'=>  'Description',
                                'indexColumn'=>  'Description',
                                'queryBuilderColumn'=>  'GradeLevelType.Description',
                                'label'     =>  'Grade Level',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => true,
                                'prompt'    => 'All Grade Levels',
                                'default'   => ($this->input->get('filter[GradeLevel]')===false) ? "" : $this->input->get('filter[GradeLevel]'),

                            ],
                          'Cohort' =>
                              [
                                  'query'     =>  $this->db->query("SELECT DISTINCT edfi.StudentCohortAssociation.CohortIdentifier FROM edfi.StudentCohortAssociation"),
                                  'searchColumn'    =>  'CohortTypeId',
                                  'textColumn'=>  'CohortIdentifier',
                                  'indexColumn'=>  'CohortIdentifier',
                                  'queryBuilderColumn'=>  'StudentCohortAssociation.CohortIdentifier',
                                  'label'     =>  'Cohort',
                                  'type'      =>  'dropdown',
                                  'bindDatabase'  => false,
                                  'prompt'    => 'All Cohorts',
                                  'default'   => $this->input->get('filter[Cohort]'),

                              ],
                          'Result'    =>
                            [
                                'range'     =>
                                    [
                                        'type'  =>  'set',
                                        'set'   =>  [10,25,50,100,200,500]
                                    ],
                                'default'   =>   ($this->input->get('filter[Result]')===false) ? 3 : $this->input->get('filter[Result]'),
                                'label'     =>  'Results',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => false,
                                'fieldType' => 'pageSize'
                            ],
                        'Sort'    =>
                            [
                                'label'     =>  'Sort Column',
                                'type'      =>  'dataSort',
                                'bindDatabase'  => true,
                                'fieldType' => 'dataSort',
                                'display' => 'false',
                                'columns'   =>
                                    [
                                        /*'SchoolId' => 'School ID',
                                        'StudentUSI' => 'Student USI',
                                        'FirstName' => 'First Name',
                                        'LastSurname' => 'Last Name',
                                        'Description' => 'Description', */
                                        'FirstName' => 'Name',
                                        'GradeLevelType.Description' => 'Grade Level',
                                        'StudentCohortAssociation.CohortIdentifier' => 'Cohort',
                                    ],
                                'defaultColumn'    =>  $this->input->get('filter[Sort][column]'),
                                'sortTypes' =>
                                    [
                                        'ASC' => 'Ascending',
                                        'DESC' => 'Descending'
                                    ],
                                'defaultSortType'   =>  (!$this->input->get('filter[Sort][type]')) ? "ASC" : $this->input->get('filter[Sort][type]'),
                                'sortTypeLabel' =>  'Sort Type'

                            ],


                    ]

            ],
            'pagination'  =>
                [
                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $id,
                    'url'   =>  'student/index/@pageNo'
                ]
        ]);
    }


    /**
     * index action
     */

    public function index1($id=1)
	{



        $query= "select StudentSchoolAssociation.SchoolId, Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.Description,GradeLevelType.GradeLevelTypeId, StudentSchoolAssociation.EntryDate from edfi.StudentSchoolAssociation
inner join edfi.Student on
     StudentSchoolAssociation.StudentUSI = Student.StudentUSI
inner join edfi.GradeLevelDescriptor on
     StudentSchoolAssociation.EntryGradeLevelDescriptorId = GradeLevelDescriptor.GradeLevelDescriptorId
inner join edfi.GradeLevelType on
     GradeLevelDescriptor.GradeLevelTypeId = GradeLevelType.GradeLevelTypeId
                  ";


		$this->render("index",[
            'query' => $query,
            'filter' =>[
                'dataBind' => true,
                'bindIndex' => ['NameOfInstitution','GradeLevel'],
                'bindSort' => ['Sort'],
                'fields' =>
                    [
                        'NameOfInstitution' =>
                            [
                                'query'     =>  $this->db->query("SELECT * FROM edfi.EducationOrganization"),
                                'searchColumn'    =>  'SchoolId',
                                'searchColumnType'  => 'int',
                                'textColumn'=>  'NameOfInstitution',
                                'indexColumn'=>  'EducationOrganizationId',
                                'label'     =>  'School',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => true,
                                'default'   => $this->input->get('filter[NameOfInstitution]'),
                                'prompt'    => 'All Schools'
                            ],
                        'GradeLevel' =>
                            [
                                'query'     =>  $this->db->query("SELECT * FROM edfi.GradeLevelType"),
                                'searchColumn'    =>  'GradeLevelTypeId',
                                'textColumn'=>  'Description',
                                'indexColumn'=>  'GradeLevelTypeId',
                                'label'     =>  'Grade Level',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => true,
                                'prompt'    => 'All Grade Levels',
                                'default'   => $this->input->get('filter[GradeLevel]'),

                            ],
                      /*  'Cohort' =>
                            [
                                'query'     =>  $this->db->query("SELECT * FROM edfi.CohortType"),
                                'searchColumn'    =>  'CohortTypeId',
                                'textColumn'=>  'ShortDescription',
                                'indexColumn'=>  'CohortTypeId',
                                'label'     =>  'Grade Level',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => false,
                                'prompt'    => 'All Grade Levels',
                                'default'   => $this->input->get('filter[Cohort]'),

                            ],
*/
                        'Result'    =>
                            [
                                'range'     =>
                                    [
                                        'type'  =>  'set',
                                        'set'   =>  [10,25,50,100,200,500]
                                    ],
                                'default'   =>   (!$this->input->get('filter[Result]')) ? 3 : $this->input->get('filter[Result]'),
                                'label'     =>  'Results',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => false,
                                'fieldType' => 'pageSize'
                            ],
                        'Sort'    =>
                            [
                                'label'     =>  'Sort Column',
                                'type'      =>  'dataSort',
                                'bindDatabase'  => false,
                                'fieldType' => 'dataSort',
                                'columns'   =>
                                    [
                                        'SchoolId' => 'School ID',
                                        'StudentUSI' => 'Student USI',
                                        'FirstName' => 'First Name',
                                        'LastSurname' => 'Last Name',
                                        'Description' => 'Description',
                                        'GradeLevelTypeId' => 'Grade Level',
                                        'EntryDate' => 'Entry Date'
                                    ],
                                'defaultColumn'    =>  $this->input->get('filter[Sort][column]'),
                                'sortTypes' =>
                                    [
                                        'ASC' => 'Ascending',
                                        'DESC' => 'Descending'
                                    ],
                                'defaultSortType'   =>  'ASC',
                                'sortTypeLabel' =>  'Sort Type'

                            ]

                    ]

            ],
            'pagination'  =>
            [
                'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                'currentPage' => $id,
                'url'   =>  'student/index/@pageNo'
            ]
        ]);
	}

    /**
     * Student Profile Page
     * @param null $id
     */
    public function profile($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));



        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("profile",
                        [
                            'student'   => $student
                        ],
                    true
                    ),
                'student'   => $student,
                'tab'   =>  'overview'
            ]
            );
    }
    /**
     * Student Contact Page
     * @param null $id
     */
    public function contacts($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));



        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("contacts",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'contacts'
            ]
        );
    }

    /**
     * Student Section Page
     * @param null $id
     */
    public function sections($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));



        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("sections",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'sections'
            ]
        );
    }

    /**
     * Student Grade Page
     * @param null $id
     */
    public function grades($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("grades",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'grades'
            ]
        );
    }

    /**
     * Student Attendance Page
     * @param null $id
     */
    public function attendance($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("attendance",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'attendance'
            ]
        );
    }

    /**
     * Student Assessments Page
     * @param null $id
     */
    public function assessments($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("assessments",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'assessments'
            ]
        );
    }

    /**
     * Student Cohorts Page
     * @param null $id
     */
    public function cohorts($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("cohorts",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'cohorts'
            ]
        );
    }
}
