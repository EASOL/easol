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



        if(Easol_AuthorizationRoles::hasAccess(['System Administrator', 'Data Administrator'])) {


            $query = "SELECT StaffSectionAssociation.StaffUSI, Staff.FirstName, Staff.LastSurname, TermType.CodeValue as Term,
[Section].SchoolYear, Course.CourseTitle, [Section].LocalCourseCode,
[Section].UniqueSectionCode, [Section].ClassPeriodName, count(*) as StudentCount FROM edfi.[Section]
LEFT JOIN edfi.StudentSectionAssociation ON
StudentSectionAssociation.SchoolId = Section.SchoolId AND StudentSectionAssociation.ClassPeriodName = Section.ClassPeriodName AND
StudentSectionAssociation.ClassroomIdentificationCode = Section.ClassroomIdentificationCode AND
StudentSectionAssociation.LocalCourseCode = Section.LocalCourseCode AND
StudentSectionAssociation.TermTypeId = Section.TermTypeId AND
StudentSectionAssociation.SchoolYear = Section.SchoolYear
LEFT JOIN edfi.StaffSectionAssociation ON
StaffSectionAssociation.SchoolId = Section.SchoolId AND StaffSectionAssociation.ClassPeriodName = Section.ClassPeriodName AND
StaffSectionAssociation.ClassroomIdentificationCode = Section.ClassroomIdentificationCode AND
StaffSectionAssociation.LocalCourseCode = Section.LocalCourseCode AND
StaffSectionAssociation.TermTypeId = Section.TermTypeId AND
StaffSectionAssociation.SchoolYear = Section.SchoolYear
LEFT JOIN edfi.Staff ON
Staff.StaffUSI = StaffSectionAssociation.StaffUSI
INNER JOIN edfi.TermType ON TermType.TermTypeId = Section.TermTypeId
INNER JOIN edfi.Course ON Course.CourseCode = Section.LocalCourseCode AND Course.EducationOrganizationId = Section.SchoolId
WHERE Section.SchoolId = '".Easol_Authentication::userdata('SchoolId')."'
                  ";


            $this->render("index", [
                'query' => $query,
                'colOrderBy' => ['StaffSectionAssociation.StaffUSI'],
                'colGroupBy' => ['StaffSectionAssociation.StaffUSI','Staff.FirstName','Staff.LastSurname','TermType.CodeValue','[Section].SchoolYear','[Section].UniqueSectionCode',
                    'Course.CourseTitle','[Section].LocalCourseCode','[Section].ClassPeriodName','[Section].ClassroomIdentificationCode','[Section].ClassPeriodName'],
                'filter' => [
                    'dataBind' => true,
                    'bindIndex' => ['Term' => ['glue'=>'and'],'Year' => ['glue'=>'and'], 'Course' => ['glue'=>'and'], 'Educator'=> ['glue'=>'and']],
                    'queryWhere' => false,
                    'fields' =>
                        [
                            'Term' =>
                                [

                                    'query' => $this->db->query("SELECT TermTypeId, CodeValue FROM edfi.TermType"),
                                    'searchColumn' => 'TermTypeId',
                                    'searchColumnType' => 'int',
                                    'textColumn' => 'CodeValue',
                                    'indexColumn' => 'TermTypeId',
                                    'queryBuilderColumn' => '[Section].TermTypeId',
                                    'label' => 'Term',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'default' => $this->input->get('filter[Term]'),
                                    'prompt' => 'All Terms'
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
                                    'queryBuilderColumn' => '[Section].SchoolYear',
                                    'default' => ($this->input->get('filter[Year]') == null) ? "" : $this->input->get('filter[Year]'),
                                    'label' => 'School Year',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'prompt' => 'All Years'

                                ],
                            'Course' =>
                                [
                                    'query' => $this->db->query("SELECT CourseCode, CourseTitle FROM edfi.Course ORDER BY CourseTitle"),
                                    'searchColumn' => 'CourseCode',
                                    'searchColumnType' => 'int',
                                    'textColumn' => 'CourseTitle',
                                    'indexColumn' => 'CourseCode',
                                    'queryBuilderColumn' => 'edfi.Course.CourseCode',
                                    'label' => 'Course',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'default' => $this->input->get('filter[Course]'),
                                    'prompt' => 'All Courses'
                                ],
                            'Educator' =>
                                [
                                    'query' => $this->db->query("SELECT
                                                edfi.Staff.StaffUSI,
                                                CONCAT (edfi.Staff.FirstName,' ',
                                                edfi.Staff.LastSurname) as FullName
                                                FROM edfi.Staff
                                                LEFT JOIN edfi.StaffSchoolAssociation
                                                ON edfi.StaffSchoolAssociation.StaffUSI=edfi.Staff.StaffUSI
                                                WHERE StaffSchoolAssociation.SchoolId = ?
                                                ORDER By FirstName, LastSurname",[Easol_Authentication::userdata('SchoolId')]),
                                    'searchColumn' => 'StaffUSI',
                                    'searchColumnType' => 'int',
                                    'textColumn' => 'FullName',
                                    'indexColumn' => 'StaffUSI',
                                    'queryBuilderColumn' => 'edfi.StaffSectionAssociation.StaffUSI',
                                    'label' => 'Educator',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'default' => $this->input->get('filter[Educator]'),
                                    'prompt' => 'All Educators'
                                ],
                            'Result'    =>
                                [
                                    'range'     =>
                                        [
                                            'type'  =>  'set',
                                            'set'   =>  [10,25,50,100,200,500]
                                        ],
                                    'default'   =>  (!$this->input->get('filter[Result]')) ? 3 : $this->input->get('filter[Result]'),
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
                        'url' => 'sections/index/@pageNo'
                    ]
            ]);
        }
        else {

        }
	}
}
