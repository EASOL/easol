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
     */
    public function index($id=1)
	{



        $query= "select StudentSchoolAssociation.SchoolId, Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.Description, StudentSchoolAssociation.EntryDate from edfi.StudentSchoolAssociation
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
                'fields' =>
                    [
                        'NameOfInstitution' =>
                            [
                                'entity'    =>  'entities/edfi/Edfi_School',
                                'query'     =>  $this->db->query("SELECT * FROM edfi.EducationOrganization"),
                                'searchColumn'    =>  'SchoolId',
                                'searchColumnType'  => 'int',
                                'textColumn'=>  'NameOfInstitution',
                                'indexColumn'=>  'EducationOrganizationId',
                                'label'     =>  'School',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => true,
                                'access'    =>  ['System Administrator','Data Administrator'],
                                'default'   => $this->input->get('filter[NameOfInstitution]')
                            ],
                        'Year'  =>
                            [
                                'range'     =>
                                    [
                                        'type'  =>  'dynamic',
                                        'start' =>  2000,
                                        'end'   =>  date('Y'),
                                        'increament'    =>  1,
                                    ],
                                'searchColumn'    =>  'SchoolYear',
                                'searchColumnType'  => 'int',
                                'default'   =>  ($this->input->get('filter[Year]')==null) ? date('Y') : $this->input->get('filter[Year]'),
                                'label'     =>  'Year',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => true,

                            ],
                        'Result'    =>
                            [
                                'range'     =>
                                    [
                                        'type'  =>  'set',
                                        'set'   =>  [10,25,50,100,200,500]
                                    ],
                                'default'   =>  50,
                                'label'     =>  'Results',
                                'type'      =>  'dropdown',
                                'bindDatabase'  => false,
                                'fieldType' => 'pageSize'
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

    public function overview($id=null){


        $this->render("overview");
    }
}
