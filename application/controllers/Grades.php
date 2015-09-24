<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends Easol_Controller {


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
        $currentYear= Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');

            $query = "SELECT Grade.LocalCourseCode, Course.CourseTitle, Section.UniqueSectionCode, Grade.ClassPeriodName, Staff.FirstName, Staff.LastSurname, TermType.CodeValue as Term, Grade.SchoolYear,
sum(case when Grade.NumericGradeEarned >= 90 THEN 1 ELSE 0 END) as Numeric_A,
sum(case when Grade.NumericGradeEarned >= 80 AND Grade.NumericGradeEarned < 90 THEN 1 ELSE 0 END) as Numeric_B,
sum(case when Grade.NumericGradeEarned >= 70 AND Grade.NumericGradeEarned < 80 THEN 1 ELSE 0 END) as Numeric_C,
sum(case when Grade.NumericGradeEarned >= 60 AND Grade.NumericGradeEarned < 70 THEN 1 ELSE 0 END) as Numeric_D,
sum(case when Grade.NumericGradeEarned < 60 THEN 1 ELSE 0 END) as Numeric_F,
sum(case when LEFT(Grade.LetterGradeEarned, 1) = 'A' THEN 1 ELSE 0 END) as Letter_A,
sum(case when LEFT(Grade.LetterGradeEarned, 1) = 'B' THEN 1 ELSE 0 END) as Letter_B,
sum(case when LEFT(Grade.LetterGradeEarned, 1) = 'C' THEN 1 ELSE 0 END) as Letter_C,
sum(case when LEFT(Grade.LetterGradeEarned, 1) = 'D' THEN 1 ELSE 0 END) as Letter_D,
sum(case when LEFT(Grade.LetterGradeEarned, 1) = 'F' THEN 1 ELSE 0 END) as Letter_F,
count(*) as StudentCount
FROM edfi.Grade
INNER JOIN edfi.GradingPeriod ON GradingPeriod.EducationOrganizationId = Grade.SchoolId AND GradingPeriod.BeginDate = Grade.BeginDate AND GradingPeriod.GradingPeriodDescriptorId = Grade.GradingPeriodDescriptorId
INNER JOIN edfi.StudentSectionAssociation ON StudentSectionAssociation.StudentUSI = Grade.StudentUSI AND StudentSectionAssociation.SchoolId = Grade.SchoolId AND StudentSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.SchoolYear = Grade.SchoolYear AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StudentSectionAssociation.ClassPeriodName = Grade.ClassPeriodName
INNER JOIN edfi.Section ON Section.LocalCourseCode = StudentSectionAssociation.LocalCourseCode AND Section.SchoolYear = StudentSectionAssociation.SchoolYear AND Section.TermTypeId = StudentSectionAssociation.TermTypeId AND Section.SchoolId = StudentSectionAssociation.SchoolId AND Section.ClassPeriodName = StudentSectionAssociation.ClassPeriodName AND Section.ClassroomIdentificationCode = StudentSectionAssociation.ClassroomIdentificationCode
INNER JOIN edfi.StaffSectionAssociation ON StaffSectionAssociation.SchoolId = Grade.SchoolId AND StaffSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.SchoolYear = Grade.SchoolYear AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StaffSectionAssociation.ClassPeriodName = Grade.ClassPeriodName
INNER JOIN edfi.Staff ON Staff.StaffUSI = StaffSectionAssociation.StaffUSI
INNER JOIN edfi.Course ON edfi.Course.EducationOrganizationId = edfi.Grade.SchoolId AND edfi.Course.CourseCode = edfi.Grade.LocalCourseCode
INNER JOIN edfi.TermType ON edfi.TermType.TermTypeId = edfi.Grade.TermTypeId
WHERE edfi.Grade.SchoolId = '".Easol_Authentication::userdata('SchoolId')."'
                  ";


            $this->render("index", [
                'query' => $query,
                'colOrderBy' => ['Grade.LocalCourseCode','Grade.SchoolYear','Term'],
                'colGroupBy' => ['Grade.LocalCourseCode','Course.CourseTitle','[Section].UniqueSectionCode','Grade.ClassPeriodName','TermType.CodeValue','Grade.SchoolYear',
                    'Staff.FirstName','Staff.LastSurname'],
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
                                    'queryBuilderColumn' => 'TermType.TermTypeId',
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
                                            'start' => $currentYear, //2000,
                                            'end' => date('Y'),
                                            'increament' => 1,
                                        ],
                                    'searchColumn' => 'SchoolYear',
                                    'searchColumnType' => 'int',
                                    'queryBuilderColumn' => 'Grade.SchoolYear',
                                    'default' => ($this->input->get('filter[Year]') == null) ? $currentYear : $this->input->get('filter[Year]'),
                                    'label' => 'School Year',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'prompt' => 'All Year'

                                ],
                            'Course' =>
                                [
                                    'query' => $this->db->query("SELECT CourseCode, CourseTitle FROM edfi.Course ORDER BY CourseTitle"),
                                    'searchColumn' => 'CourseCode',
                                    'searchColumnType' => 'int',
                                    'textColumn' => 'CourseTitle',
                                    'indexColumn' => 'CourseCode',
                                    'queryBuilderColumn' => 'Course.CourseCode',
                                    'label' => 'Course',
                                    'type' => 'dropdown',
                                    'bindDatabase' => true,
                                    'default' => $this->input->get('filter[Course]'),
                                    'prompt' => 'All Courses'
                                ],
                           /* 'GradeLevel' =>
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
                                    'default'   => (!$this->input->get('filter[GradeLevel]')) ? "" : $this->input->get('filter[GradeLevel]'),

                                ], */
                            'Educator' =>
                                [
                                    'query' => $this->db->query("SELECT
                                                edfi.Staff.StaffUSI,
                                                CONCAT (edfi.Staff.FirstName,' ',
                                                edfi.Staff.LastSurname) as FullName
                                                FROM edfi.Staff
                                                LEFT JOIN edfi.StaffSchoolAssociation
                                                ON edfi.StaffSchoolAssociation.StaffUSI=edfi.Staff.StaffUSI
                                                ORDER By FirstName, LastSurname"),
                                    'searchColumn' => 'StaffUSI',
                                    'searchColumnType' => 'int',
                                    'textColumn' => 'FullName',
                                    'indexColumn' => 'StaffUSI',
                                    'queryBuilderColumn' => 'edfi.Staff.StaffUSI',
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
                        'url' => 'grades/index/@pageNo'
                    ]
            ]);
    }
}
