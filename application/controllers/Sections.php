<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends Easol_Controller {

    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }

    /**
     * index action
     * @param null $id
     */
    public function index($id=1)
	{





            $query = "SELECT edfi.Section.SchoolId, edfi.Section.SchoolYear, edfi.Section.LocalCourseCode, edfi.Section.UniqueSectionCode, count(*) as StudentCount
                 FROM edfi.Section
                 LEFT JOIN edfi.StudentSectionAssociation
                 ON edfi.StudentSectionAssociation.SchoolId = edfi.Section.SchoolId AND edfi.StudentSectionAssociation.ClassPeriodName = edfi.Section.ClassPeriodName AND
                 edfi.StudentSectionAssociation.ClassroomIdentificationCode = edfi.Section.ClassroomIdentificationCode AND
                 edfi.StudentSectionAssociation.LocalCourseCode = edfi.Section.LocalCourseCode AND
                 edfi.StudentSectionAssociation.TermTypeId = edfi.Section.TermTypeId AND
                 edfi.StudentSectionAssociation.SchoolYear = edfi.Section.SchoolYear /*@filter*/
                 GROUP BY edfi.Section.SchoolId, edfi.Section.SchoolYear, edfi.Section.UniqueSectionCode, edfi.Section.LocalCourseCode, edfi.Section.ClassPeriodName, edfi.Section.ClassroomIdentificationCode

                  ";


            $this->render("index", [
                'query' => $query,
                'filter' => [
                    'fields' =>
                        [
                            'NameOfInstitution' =>
                                [
                                    'entity' => 'entities/edfi/Edfi_School',
                                    'query' => $this->db->query("SELECT * FROM edfi.EducationOrganization"),
                                    'searchColumn' => 'SchoolId',
                                    'searchColumnType' => 'int',
                                    'textColumn' => 'NameOfInstitution',
                                    'indexColumn' => 'EducationOrganizationId',
                                    'label' => 'Name of Institution',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'access' => ['System Administrator', 'Data Administrator'],
                                    'default' => $this->input->get('filter[NameOfInstitution]'),
                                    'prompt' => 'All Schools'
                                ],
                            'Year' =>
                                [
                                    'range' =>
                                        [
                                            'type' => 'dynamic',
                                            'start' => 2000,
                                            'end' => date('Y'),
                                            'increament' => 1,
                                        ],
                                    'searchColumn' => 'SchoolYear',
                                    'searchColumnType' => 'int',
                                    'default' => ($this->input->get('filter[Year]') == null) ? date('Y') : $this->input->get('filter[Year]'),
                                    'label' => 'Year',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'prompt' => 'All Year'

                                ]

                        ]

                ],
                'pagination' =>
                    [
                        'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                        'currentPage' => $id,
                        'url' => 'sections/index/@pageNo'
                    ]
            ]);

	}
}
