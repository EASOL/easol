<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Easol_Controller {

    /**
     * default constructor
     */
    public function __construct(){
        parent::__construct();
        $this->Easol_AuthorizationRoles->blockByRole('redirect',4);
    }

    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }

    /**
     * index action
     */
    public function index($id=1){
        $currentTerm= Easol_SchoolConfiguration::getValue('CURRENT_TERMID');
        $currentYear= Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        if(!$currentTerm || !$currentYear){
            return new \Exception("Current Term & Error not Found");
        }

        $query = "(SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.CodeValue as GradeLevel,GradeLevelType.GradeLevelTypeId, AttendanceEventCategoryType.CodeValue, COUNT(*) as Days, StudentSchoolAttendanceEvent.SchoolYear
FROM edfi.StudentSchoolAttendanceEvent
INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSchoolAttendanceEvent.AttendanceEventCategoryDescriptorId
INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
INNER JOIN edfi.Student ON Student.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI
INNER JOIN edfi.StudentSchoolAssociation ON StudentSchoolAssociation.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI AND StudentSchoolAssociation.SchoolId = StudentSchoolAttendanceEvent.SchoolId AND
   StudentSchoolAssociation.SchoolYear = StudentSchoolAttendanceEvent.SchoolYear
INNER JOIN edfi.GradeLevelDescriptor ON GradeLevelDescriptor.GradeLevelDescriptorId = StudentSchoolAssociation.EntryGradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON GradeLevelType.GradeLevelTypeId = GradeLevelDescriptor.GradeLevelTypeId
WHERE (AttendanceEventCategoryType.CodeValue = 'Excused Absence') AND StudentSchoolAttendanceEvent.TermTypeId = ".$currentTerm."  AND StudentSchoolAttendanceEvent.SchoolId = ".Easol_Authentication::userdata('SchoolId')."
GROUP BY Student.StudentUSI, Student.FirstName, Student.LastSurname, AttendanceEventCategoryType.CodeValue, GradeLevelType.CodeValue, StudentSchoolAttendanceEvent.SchoolYear,GradeLevelType.GradeLevelTypeId)
UNION
(SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.CodeValue as GradeLevel,GradeLevelType.GradeLevelTypeId, AttendanceEventCategoryType.CodeValue, COUNT(*) as Days, StudentSchoolAttendanceEvent.SchoolYear
FROM edfi.StudentSchoolAttendanceEvent
INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSchoolAttendanceEvent.AttendanceEventCategoryDescriptorId
INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
INNER JOIN edfi.Student ON Student.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI
INNER JOIN edfi.StudentSchoolAssociation ON StudentSchoolAssociation.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI AND StudentSchoolAssociation.SchoolId = StudentSchoolAttendanceEvent.SchoolId AND
   StudentSchoolAssociation.SchoolYear = StudentSchoolAttendanceEvent.SchoolYear
INNER JOIN edfi.GradeLevelDescriptor ON GradeLevelDescriptor.GradeLevelDescriptorId = StudentSchoolAssociation.EntryGradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON GradeLevelType.GradeLevelTypeId = GradeLevelDescriptor.GradeLevelTypeId
WHERE (AttendanceEventCategoryType.CodeValue='Unexcused Absence') AND StudentSchoolAttendanceEvent.TermTypeId = ".$currentTerm."  AND StudentSchoolAttendanceEvent.SchoolId = ".Easol_Authentication::userdata('SchoolId')."
GROUP BY Student.StudentUSI, Student.FirstName, Student.LastSurname, AttendanceEventCategoryType.CodeValue, GradeLevelType.CodeValue, StudentSchoolAttendanceEvent.SchoolYear,GradeLevelType.GradeLevelTypeId)
UNION
(SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.CodeValue as GradeLevel,GradeLevelType.GradeLevelTypeId, AttendanceEventCategoryType.CodeValue, COUNT(*) as Days, StudentSchoolAttendanceEvent.SchoolYear
FROM edfi.StudentSchoolAttendanceEvent
INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSchoolAttendanceEvent.AttendanceEventCategoryDescriptorId
INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
INNER JOIN edfi.Student ON Student.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI
INNER JOIN edfi.StudentSchoolAssociation ON StudentSchoolAssociation.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI AND StudentSchoolAssociation.SchoolId = StudentSchoolAttendanceEvent.SchoolId AND
   StudentSchoolAssociation.SchoolYear = StudentSchoolAttendanceEvent.SchoolYear
INNER JOIN edfi.GradeLevelDescriptor ON GradeLevelDescriptor.GradeLevelDescriptorId = StudentSchoolAssociation.EntryGradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON GradeLevelType.GradeLevelTypeId = GradeLevelDescriptor.GradeLevelTypeId
WHERE (AttendanceEventCategoryType.CodeValue = 'In Attendance') AND StudentSchoolAttendanceEvent.TermTypeId = ".$currentTerm."  AND StudentSchoolAttendanceEvent.SchoolId = ".Easol_Authentication::userdata('SchoolId')."
GROUP BY Student.StudentUSI, Student.FirstName, Student.LastSurname, AttendanceEventCategoryType.CodeValue, GradeLevelType.CodeValue, StudentSchoolAttendanceEvent.SchoolYear,GradeLevelType.GradeLevelTypeId)";



        $this->render("index", [
            'query' => $query,
            'colOrderBy' => ['StudentUSI'],
            'filter' => [
                'dataBind' => false,
                'fields' =>
                    [
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
                                'default'   => ($this->input->get('filter[GradeLevel]')===false) ? "" : $this->input->get('filter[GradeLevel]'),

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
                                'default' => ($this->input->get('filter[Year]') == null) ? "" : $this->input->get('filter[Year]'),
                                'label' => 'School Year',
                                'type' => 'dropdown',
                                'bindDatabase' => true,
                                'prompt' => 'All Years'

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
                    'url' => 'cohorts/index/@pageNo'
                ]
        ]);
    }
}
