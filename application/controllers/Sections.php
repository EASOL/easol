<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sections extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }


public function index()
    {
        $data = array();

        $data['filters']                = $_GET;
       
        $data['currentYear']            = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        $data['currentYear_default']    = (isset($data['filters']['year'])) ? $data['filters']['year'] : Easol_SchoolConfiguration::setDefault('Year', $data['currentYear']);
        $data['currentTerm']            = Easol_SchoolConfiguration::getValue('CURRENT_TERMID');
        $data['currentTerm_default']    = (isset($data['filters']['term'])) ? $data['filters']['term'] : Easol_SchoolConfiguration::setDefault('Term', $data['currentTerm']);        
        $data['userCanFilter']          = Easol_SchoolConfiguration::canFilterByEducator();

        // define required filters
        $where = array();
        $where['edfi.Grade.SchoolId'] = Easol_Authentication::userdata('SchoolId');

        // define optional filters
        $lookFor = array(
            'educator'      => 'edfi.StaffSectionAssociation.StaffUSI',
        );
        
        // If it's educator who is logged in, we force change Where param
         if(!$data['userCanFilter']) $where[$lookFor['educator']] = Easol_Authentication::userdata('StaffUSI');

        $this->db->select("Grade.LocalCourseCode, Course.CourseTitle, Section.UniqueSectionCode, Section.id, Grade.ClassPeriodName, 
        Staff.FirstName, Staff.LastSurname, TermType.CodeValue, Grade.SchoolYear, 
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
        count(*) as StudentCount");
        $this->db->from('edfi.Grade'); 
        $this->db->join('edfi.GradingPeriod', 'GradingPeriod.EducationOrganizationId = Grade.SchoolId AND GradingPeriod.BeginDate = Grade.BeginDate AND GradingPeriod.GradingPeriodDescriptorId = Grade.GradingPeriodDescriptorId', 'inner'); 
        $this->db->join('edfi.StudentSectionAssociation', 'StudentSectionAssociation.StudentUSI = Grade.StudentUSI AND StudentSectionAssociation.SchoolId = Grade.SchoolId AND StudentSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.SchoolYear = Grade.SchoolYear AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StudentSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner'); 
        $this->db->join('edfi.Section', 'Section.LocalCourseCode = StudentSectionAssociation.LocalCourseCode AND Section.SchoolYear = StudentSectionAssociation.SchoolYear AND Section.TermTypeId = StudentSectionAssociation.TermTypeId AND Section.SchoolId = StudentSectionAssociation.SchoolId AND Section.ClassPeriodName = StudentSectionAssociation.ClassPeriodName AND Section.ClassroomIdentificationCode = StudentSectionAssociation.ClassroomIdentificationCode', 'inner');
        $this->db->join('edfi.StaffSectionAssociation', 'StaffSectionAssociation.SchoolId = Grade.SchoolId AND StaffSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.SchoolYear = Grade.SchoolYear AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StaffSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner');
        $this->db->join('edfi.Staff', 'Staff.StaffUSI = StaffSectionAssociation.StaffUSI', 'inner');
        $this->db->join('edfi.Course', 'edfi.Course.EducationOrganizationId = edfi.Grade.SchoolId AND edfi.Course.CourseCode = edfi.Grade.LocalCourseCode', 'inner');
        $this->db->join('edfi.TermType', 'edfi.TermType.TermTypeId = edfi.Grade.TermTypeId', 'inner'); 
        $this->db->group_by('Grade.LocalCourseCode,Course.CourseTitle, Section.UniqueSectionCode, Section.id,Grade.ClassPeriodName,TermType.CodeValue,Grade.SchoolYear,Staff.FirstName,Staff.LastSurname');
        $this->db->order_by('Grade.LocalCourseCode , Grade.SchoolYear');

        $data['results']    = $this->db->where($where)->get()->result();
        // exit(print_r($this->db->last_query(), true));
        foreach ($data['results'] as $k => $v)
        {
            list($pCode,$pName) = explode(' - ', $v->ClassPeriodName);
            $data['results'][$k]->Period = $pCode;

            $data['results'][$k]->Educator = $v->FirstName . ' ' . $v->LastSurname;            
        }

        $sql                    = "SELECT TermTypeId, CodeValue FROM edfi.TermType";
        $data['terms']          = $this->db->query($sql)->result();

        $data['years']          = range($data['currentYear'], date('Y'));

        $sql                    = "SELECT CourseCode, CourseTitle FROM edfi.Course ORDER BY CourseTitle";
        $data['courses']        = $this->db->query($sql)->result();

       /* $sql                    = "SELECT * FROM edfi.GradeLevelType";
        $data['gradelevels']    = $this->db->query($sql)->result();*/

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

    public function details()
    {
        $id = $this->uri->segment(3, 0);
        $data = array();
        $data['section_id'] = $id;

        $this->db->select('Student.StudentUSI, Student.FirstName, Student.MiddleName, Student.LastSurname, Grade.LocalCourseCode, Course.CourseTitle, Section.id,Section.UniqueSectionCode, Grade.ClassPeriodName, 
        Staff.FirstName AS "teacher_fname", Staff.LastSurname AS "teacher_lname", TermType.CodeValue, Grade.SchoolYear, Grade.NumericGradeEarned');
        $this->db->from('edfi.Grade'); 
        $this->db->join('edfi.GradingPeriod', 'GradingPeriod.EducationOrganizationId = Grade.SchoolId AND GradingPeriod.BeginDate = Grade.BeginDate AND GradingPeriod.GradingPeriodDescriptorId = Grade.GradingPeriodDescriptorId', 'inner'); 
        $this->db->join('edfi.StudentSectionAssociation', 'StudentSectionAssociation.StudentUSI = Grade.StudentUSI AND StudentSectionAssociation.SchoolId = Grade.SchoolId AND StudentSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.SchoolYear = Grade.SchoolYear AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StudentSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner'); 
        $this->db->join('edfi.Student', 'Student.StudentUSI = StudentSectionAssociation.StudentUSI'); 
        $this->db->join('edfi.Section', 'Section.LocalCourseCode = StudentSectionAssociation.LocalCourseCode AND Section.SchoolYear = StudentSectionAssociation.SchoolYear AND Section.TermTypeId = StudentSectionAssociation.TermTypeId AND Section.SchoolId = StudentSectionAssociation.SchoolId AND Section.ClassPeriodName = StudentSectionAssociation.ClassPeriodName AND Section.ClassroomIdentificationCode = StudentSectionAssociation.ClassroomIdentificationCode', 'inner');
        $this->db->join('edfi.StaffSectionAssociation', 'StaffSectionAssociation.SchoolId = Grade.SchoolId AND StaffSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.SchoolYear = Grade.SchoolYear AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StaffSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner');
        $this->db->join('edfi.Staff', 'Staff.StaffUSI = StaffSectionAssociation.StaffUSI', 'inner');
        $this->db->join('edfi.Course', 'edfi.Course.EducationOrganizationId = edfi.Grade.SchoolId AND edfi.Course.CourseCode = edfi.Grade.LocalCourseCode', 'inner');
        $this->db->join('edfi.TermType', 'edfi.TermType.TermTypeId = edfi.Grade.TermTypeId', 'inner'); 
        $this->db->order_by('Grade.LocalCourseCode , Grade.SchoolYear');
        $this->db->where('Section.id', $id);

        $data['results'] = $this->db->get()->result();

        foreach ($data['results'] as $k => $v)
        {
            list($pCode,$pName) = explode(' - ', $v->ClassPeriodName);
            $data['results'][$k]->Period = $pCode;
            $data['results'][$k]->Educator = $v->teacher_fname . ' ' . $v->teacher_lname;            
        } 

        $this->render("details",[
            'data'  => $data,
        ]);

    }  

}
