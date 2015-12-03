<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends Easol_Controller {

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
    public function index(){
       
        $data = array();
        $data['currentYear']            = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
       
        $query = "(SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.CodeValue +'' as GradeLevel,
        GradeLevelType.GradeLevelTypeId, AttendanceEventCategoryType.CodeValue, COUNT(*) as Days,
        StudentSchoolAttendanceEvent.SchoolYear 
        FROM edfi.StudentSchoolAttendanceEvent 
        INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSchoolAttendanceEvent.AttendanceEventCategoryDescriptorId
        INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
        INNER JOIN edfi.Student ON Student.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI
        INNER JOIN edfi.StudentSchoolAssociation ON StudentSchoolAssociation.StudentUSI = StudentSchoolAttendanceEvent.StudentUSI AND StudentSchoolAssociation.SchoolId = StudentSchoolAttendanceEvent.SchoolId AND StudentSchoolAssociation.SchoolYear = StudentSchoolAttendanceEvent.SchoolYear
        INNER JOIN edfi.GradeLevelDescriptor ON GradeLevelDescriptor.GradeLevelDescriptorId = StudentSchoolAssociation.EntryGradeLevelDescriptorId
        INNER JOIN edfi.GradeLevelType ON GradeLevelType.GradeLevelTypeId = GradeLevelDescriptor.GradeLevelTypeId 
        WHERE (AttendanceEventCategoryType.CodeValue IN ('In Attendance', 'Excused Absence', 'Unexcused Absence')) AND StudentSchoolAttendanceEvent.SchoolId = ".Easol_Authentication::userdata('SchoolId')." 
        GROUP BY Student.StudentUSI, Student.FirstName, Student.LastSurname, AttendanceEventCategoryType.CodeValue, GradeLevelType.CodeValue, StudentSchoolAttendanceEvent.SchoolYear,GradeLevelType.GradeLevelTypeId)
        ORDER BY StudentUSI";

        $data['results'] = $this->db->query($query)->result();

        foreach ($data['results'] as $k => $v) {
            $data['results'][$v->StudentUSI][$v->SchoolYear]['StudentUSI'] = $v->StudentUSI;            
            $data['results'][$v->StudentUSI][$v->SchoolYear]['Name'] = $v->FirstName . ' ' . $v->LastSurname;
            $data['results'][$v->StudentUSI][$v->SchoolYear]['GradeLevel'] = $v->GradeLevel;                        
            $data['results'][$v->StudentUSI][$v->SchoolYear][$v->CodeValue] = $v->Days;
            unset($data['results'][$k]);
        }

        $sql                    = "SELECT CodeValue FROM edfi.GradeLevelType";
        $data['gradelevels']     = $this->db->query($sql)->result();

        $data['years']          = range($data['currentYear'], date('Y'));        

        $this->render("index", [
            'data' => $data,
            ]
        );
    }
}
