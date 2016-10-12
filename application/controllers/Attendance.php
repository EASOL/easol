<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Easol_Controller {

    /**
     * default constructor
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function accessRules()
    {
        return [
            "index"     =>  ['System Administrator','Data Administrator','School Administrator'],
        ];
    }

    /**
     * index action
     */
    public function index()
    {
       
        $data = array();
        $data['currentYear']            = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
       
        $query = "(SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.CodeValue +'' as GradeLevel,
        GradeLevelType.GradeLevelTypeId, AttendanceEventCategoryType.CodeValue, COUNT(*) as Days,
        StudentSchoolAttendanceEvent.SchoolYear, StudentSchoolAttendanceEvent.TermTypeId, TermType.CodeValue as Term 
        FROM edfi.StudentSchoolAttendanceEvent 
        INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSchoolAttendanceEvent.AttendanceEventCategoryDescriptorId
        INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
        INNER JOIN edfi.Student ON Student.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI
        INNER JOIN edfi.StudentSchoolAssociation ON StudentSchoolAssociation.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI AND StudentSchoolAssociation.SchoolId = StudentSchoolAttendanceEvent.SchoolId AND StudentSchoolAssociation.SchoolYear = StudentSchoolAttendanceEvent.SchoolYear
        INNER JOIN edfi.GradeLevelDescriptor ON GradeLevelDescriptor.GradeLevelDescriptorId = StudentSchoolAssociation.EntryGradeLevelDescriptorId
        INNER JOIN edfi.GradeLevelType ON GradeLevelType.GradeLevelTypeId = GradeLevelDescriptor.GradeLevelTypeId 
        INNER JOIN edfi.TermType ON edfi.TermType.TermTypeId = StudentSchoolAttendanceEvent.TermTypeId
        WHERE (AttendanceEventCategoryType.CodeValue IN ('In Attendance', 'Excused Absence', 'Unexcused Absence')) AND StudentSchoolAttendanceEvent.SchoolId = ".Easol_Auth::userdata('SchoolId')." 
        GROUP BY Student.StudentUSI, Student.FirstName, Student.LastSurname, AttendanceEventCategoryType.CodeValue, GradeLevelType.CodeValue, StudentSchoolAttendanceEvent.SchoolYear,GradeLevelType.GradeLevelTypeId, StudentSchoolAttendanceEvent.TermTypeId, TermType.CodeValue)
        ORDER BY StudentUSI";

        $data['results'] = $this->db->query($query)->result();
        $data['years'] = [];
        $data['terms'] = [];

        foreach ($data['results'] as $k => $v) {
            $data['results'][$v->StudentUSI][$v->SchoolYear]['StudentUSI'] = $v->StudentUSI;            
            $data['results'][$v->StudentUSI][$v->SchoolYear]['Name'] = $v->FirstName . ' ' . $v->LastSurname;
            $data['results'][$v->StudentUSI][$v->SchoolYear]['GradeLevel'] = $v->GradeLevel;                        
            $data['results'][$v->StudentUSI][$v->SchoolYear][$v->CodeValue] = $v->Days;

            if (!isset($data['results'][$v->StudentUSI][$v->SchoolYear]['Term'][$v->Term])) $data['results'][$v->StudentUSI][$v->SchoolYear]['Term'][$v->Term] = $v->Term;

            unset($data['results'][$k]);
        }

        $data['school_id'] = Easol_Auth::userdata('SchoolId');

        $this->render("index", [
            'data' => $data,
            ]
        );
    }
}
