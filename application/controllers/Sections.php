<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }


public function index($id=1)
    {
        $data = array();

        $data['filters']                = $_GET;

        $data['currentYear']            = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        $data['currentYear_default']    = Easol_SchoolConfiguration::setDefault('Year', $data['currentYear']);
        $data['currentTerm']            = Easol_SchoolConfiguration::getValue('CURRENT_TERMID');
        $data['currentTerm_default']    = Easol_SchoolConfiguration::setDefault('Term', $data['currentTerm']);
        $data['userCanFilter']          = Easol_SchoolConfiguration::userCanFilter();

        $sql = "SELECT Grade.LocalCourseCode, Course.CourseTitle, Section.UniqueSectionCode, Grade.ClassPeriodName, 
        Staff.FirstName, Staff.LastSurname, TermType.CodeValue as Term, Grade.SchoolYear, 
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
        count(*) as StudentCount FROM edfi.Grade 
        INNER JOIN edfi.GradingPeriod ON GradingPeriod.EducationOrganizationId = Grade.SchoolId AND GradingPeriod.BeginDate = Grade.BeginDate AND GradingPeriod.GradingPeriodDescriptorId = Grade.GradingPeriodDescriptorId 
        INNER JOIN edfi.StudentSectionAssociation ON StudentSectionAssociation.StudentUSI = Grade.StudentUSI AND StudentSectionAssociation.SchoolId = Grade.SchoolId AND StudentSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.SchoolYear = Grade.SchoolYear AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StudentSectionAssociation.ClassPeriodName = Grade.ClassPeriodName 
        INNER JOIN edfi.Section ON Section.LocalCourseCode = StudentSectionAssociation.LocalCourseCode AND Section.SchoolYear = StudentSectionAssociation.SchoolYear AND Section.TermTypeId = StudentSectionAssociation.TermTypeId AND Section.SchoolId = StudentSectionAssociation.SchoolId AND Section.ClassPeriodName = StudentSectionAssociation.ClassPeriodName AND Section.ClassroomIdentificationCode = StudentSectionAssociation.ClassroomIdentificationCode INNER JOIN edfi.StaffSectionAssociation ON StaffSectionAssociation.SchoolId = Grade.SchoolId AND StaffSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.SchoolYear = Grade.SchoolYear AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StaffSectionAssociation.ClassPeriodName = Grade.ClassPeriodName
        INNER JOIN edfi.Staff ON Staff.StaffUSI = StaffSectionAssociation.StaffUSI
        INNER JOIN edfi.Course ON edfi.Course.EducationOrganizationId = edfi.Grade.SchoolId AND edfi.Course.CourseCode = edfi.Grade.LocalCourseCode
        INNER JOIN edfi.TermType ON edfi.TermType.TermTypeId = edfi.Grade.TermTypeId 
        WHERE edfi.Grade.SchoolId = '255901044' and TermType.TermTypeId = '2' 
        GROUP BY Grade.LocalCourseCode,Course.CourseTitle,[Section].UniqueSectionCode,Grade.ClassPeriodName,TermType.CodeValue,Grade.SchoolYear,Staff.FirstName,Staff.LastSurname
        ORDER BY Grade.LocalCourseCode , Grade.SchoolYear
        ";

        $data['results']        = $this->db->query($sql)->result();
        foreach ($data['results'] as $k => $v)
        {
            list($junk,$gradelevel) = explode('-', $v->LocalCourseCode);
            $data['results'][$k]->Gradelevel = $gradelevel;

            list($pCode,$pName) = explode(' - ', $v->ClassPeriodName);
            $data['results'][$k]->Period = $pCode;

            $data['results'][$k]->Educator = $v->FirstName . ' ' . $v->LastSurname;            
        }

        $sql                    = "SELECT TermTypeId, CodeValue FROM edfi.TermType";
        $data['terms']          = $this->db->query($sql)->result();

        $data['years']          = range($data['currentYear'], date('Y'));

        $sql                    = "SELECT CourseCode, CourseTitle FROM edfi.Course ORDER BY CourseTitle";
        $data['courses']        = $this->db->query($sql)->result();

        $sql                    = "SELECT * FROM edfi.GradeLevelType";
        $data['gradelevels']    = $this->db->query($sql)->result();

        $sql                    = "SELECT
                                    edfi.Staff.StaffUSI,
                                    CONCAT (edfi.Staff.FirstName,' ',
                                    edfi.Staff.LastSurname) as FullName
                                    FROM edfi.Staff
                                    LEFT JOIN edfi.StaffSchoolAssociation
                                    ON edfi.StaffSchoolAssociation.StaffUSI=edfi.Staff.StaffUSI
                                    ORDER By FirstName, LastSurname
                                    ";

        $data['educators']      = $this->db->query($sql)->result();

        $this->render("index",[
            'data'  => $data,
        ]);
    }
}
