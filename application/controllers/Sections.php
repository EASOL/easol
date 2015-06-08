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
    public function index($id=null)
	{




        $query= "SELECT edfi.Section.SchoolId, edfi.Section.SchoolYear, edfi.Section.LocalCourseCode, edfi.Section.UniqueSectionCode, count(*) as StudentCount
                 FROM edfi.Section
                 LEFT JOIN edfi.StudentSectionAssociation
                 ON edfi.StudentSectionAssociation.SchoolId = edfi.Section.SchoolId AND edfi.StudentSectionAssociation.ClassPeriodName = edfi.Section.ClassPeriodName AND
                 edfi.StudentSectionAssociation.ClassroomIdentificationCode = edfi.Section.ClassroomIdentificationCode AND
                 edfi.StudentSectionAssociation.LocalCourseCode = edfi.Section.LocalCourseCode AND
                 edfi.StudentSectionAssociation.TermTypeId = edfi.Section.TermTypeId AND
                 edfi.StudentSectionAssociation.SchoolYear = edfi.Section.SchoolYear /*@filter*/
                 GROUP BY edfi.Section.SchoolId, edfi.Section.SchoolYear, edfi.Section.UniqueSectionCode, edfi.Section.LocalCourseCode, edfi.Section.ClassPeriodName, edfi.Section.ClassroomIdentificationCode
                 ORDER BY edfi.Section.SchoolId
                  ";

        $totalCount=$this->db->query(
            "SELECT  count(*) as tot FROM
            (SELECT edfi.Section.SchoolId, edfi.Section.SchoolYear, edfi.Section.LocalCourseCode, edfi.Section.UniqueSectionCode, count(*) as StudentCount
                 FROM edfi.Section
                 LEFT JOIN edfi.StudentSectionAssociation
                 ON edfi.StudentSectionAssociation.SchoolId = edfi.Section.SchoolId AND edfi.StudentSectionAssociation.ClassPeriodName = edfi.Section.ClassPeriodName AND
    edfi.StudentSectionAssociation.ClassroomIdentificationCode = edfi.Section.ClassroomIdentificationCode AND
    edfi.StudentSectionAssociation.LocalCourseCode = edfi.Section.LocalCourseCode AND
    edfi.StudentSectionAssociation.TermTypeId = edfi.Section.TermTypeId AND
    edfi.StudentSectionAssociation.SchoolYear = edfi.Section.SchoolYear
                 GROUP BY edfi.Section.SchoolId, edfi.Section.SchoolYear, edfi.Section.UniqueSectionCode, edfi.Section.LocalCourseCode, edfi.Section.ClassPeriodName, edfi.Section.ClassroomIdentificationCode) a"
        )->row();

        // die(print_r($totalCount));


        $this->render("index",[
            'query' => $query,
            'filter' =>[
                'fields' =>
                    [
                        'NameOfInstitution' =>
                            [
                                'entity'    =>  'entities/edfi/Edfi_School',
                                'query'     =>  $this->db->query("SELECT * FROM edfi.EducationOrganization"),
                                'searchColumn'    =>  'edfi.Section.SchoolId',
                                'searchColumnType'  => 'int',
                                'textColumn'=>  'NameOfInstitution',
                                'indexColumn'=>  'EducationOrganizationId',
                                'label'     =>  'Name of Institution',
                                'type'      =>  'dropdown',
                                'access'    =>  ['System Administrator','Data Administrator'],
                                'default'   => ''
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
                                'searchColumn'    =>  'edfi.Section.SchoolYear',
                                'searchColumnType'  => 'int',
                                'default'   =>  date('Y'),
                                'label'     =>  'Year',
                                'type'      =>  'dropdown'

                            ]

                    ]

            ],
            'pagination'  =>
                [
                    'totalElements' => $totalCount->tot,
                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $id,
                    'url'   =>  'sections/index/@pageNo'
                ]
        ]);


	}
}
