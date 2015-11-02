<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }


    public function index() {        
        $data = array();
        $data['filters']                = $_GET;

        $data['currentYear']            = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        $data['currentYear_default']    = (isset($data['filters']['year']) and !empty($data['filters']['year'])) ? $data['filters']['year'] : Easol_SchoolConfiguration::setDefault('Year', $data['currentYear']);
        $data['currentTerm']            = Easol_SchoolConfiguration::getValue('CURRENT_TERMID');
        $data['currentTerm_default']    = (isset($data['filters']['term']) and !empty($data['filters']['term'])) ? $data['filters']['term'] : Easol_SchoolConfiguration::setDefault('Term', $data['currentTerm']);        
        $data['userCanFilter']          = Easol_SchoolConfiguration::userCanFilter();

        // define required filters
        $where = array(
                        'edfi.Grade.SchoolId'   => Easol_Authentication::userdata('SchoolId'),
                        'TermType.TermTypeId'  => $data['currentTerm_default'],
                        'Section.SchoolYear'    => $data['currentYear_default']
        );

        // define optional filters
        $lookFor = array(
            'course'        => 'edfi.Course.CourseCode',
            'educator'      => 'edfi.StaffSectionAssociation.StaffUSI',
            // 'gradelevel'    => '', there is no gradelevel db scheme in place yet.
        );

        if ($filters = $this->input->get()) {
            foreach ($filters as $k => $v)
            {
                if (isset($lookFor[$k]) and !empty($lookFor[$k]) and $v !== '') {
                    $where[$lookFor[$k]] = $v;
                }
            }
        }

        $this->db->select("Grade.LocalCourseCode, Course.CourseTitle, Section.UniqueSectionCode, Grade.ClassPeriodName, 
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
        $this->db->group_by('Grade.LocalCourseCode,Course.CourseTitle,Section.UniqueSectionCode,Grade.ClassPeriodName,TermType.CodeValue,Grade.SchoolYear,Staff.FirstName,Staff.LastSurname');
        $this->db->order_by('Grade.LocalCourseCode , Grade.SchoolYear');

        $data['results']    = $this->db->where($where)->get()->result();

        $sections = array();
        foreach ($data['results'] as $k => $v)
        {
            list($pCode,$pName) = explode(' - ', $v->ClassPeriodName);
            $data['results'][$k]->Period = $pCode;

            $data['results'][$k]->Educator = $v->FirstName . ' ' . $v->LastSurname;            

            $sections[] = $v->UniqueSectionCode;
        
            //$this->load->model('entities/edfi/Edfi_Student');
            //$data['students'] = $this->Edfi_Student->getStudentsEmailsBySection($v->UniqueSectionCode);
        }


        if (!empty($sections)) {
            $this->db->select("StudentElectronicMail.ElectronicMailAddress, Section.UniqueSectionCode"); 
            $this->db->from("edfi.Section");
            $this->db->join("edfi.StudentSectionAssociation", "StudentSectionAssociation.SchoolId = Section.SchoolId AND 
                StudentSectionAssociation.ClassPeriodName = Section.ClassPeriodName AND 
                StudentSectionAssociation.ClassroomIdentificationCode = Section.ClassroomIdentificationCode AND 
                StudentSectionAssociation.LocalCourseCode = Section.LocalCourseCode AND 
                StudentSectionAssociation.SchoolYear = Section.SchoolYear");
            $this->db->join("edfi.Student", "Student.StudentUSI = StudentSectionAssociation.StudentUSI");
            $this->db->join("edfi.StudentElectronicMail", "StudentElectronicMail.StudentUSI = Student.StudentUSI");
            $this->db->where("StudentElectronicMail.PrimaryEmailAddressIndicator", "1");
            $this->db->where_in("Section.UniqueSectionCode", $sections);
        }


        // sort the, hashed, student emails by section.
        $students = $this->db->get()->result();
        foreach ($students as $key => $value) {
            $students[$value->UniqueSectionCode][] = $this->_encrypt_email($value->ElectronicMailAddress);
            unset($students[$key]);
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

    public function students() {

        $section    = $this->uri->segment(3, 0);

        $api        = "https://analytics-staging.learningtapestry.com/api/v2/";
        $api_key    = "51bb257c-c40a-4f51-bdb6-2ba697bb6167";
        $api_pass   = "35d433acef73eb67bf4db5f0b68f3baca6b0";        

        $data       = array();

        // define required filters
        $where = array(
                        'Section.UniqueSectionCode'   => $section,
        );

        $this->db->select("Course.CourseTitle");
        $this->db->from('edfi.Course'); 
        $this->db->join('edfi.Section', "Course.CourseCode = Section.LocalCourseCode AND Course.EducationOrganizationId = Section.SchoolId"); 

        $data['section']    = $this->db->where($where)->get()->row();

            $this->db->select("Student.FirstName, Student.LastSurname, StudentElectronicMail.ElectronicMailAddress, Section.UniqueSectionCode"); 
            $this->db->from("edfi.Section");
            $this->db->join("edfi.StudentSectionAssociation", "StudentSectionAssociation.SchoolId = Section.SchoolId AND 
                StudentSectionAssociation.ClassPeriodName = Section.ClassPeriodName AND 
                StudentSectionAssociation.ClassroomIdentificationCode = Section.ClassroomIdentificationCode AND 
                StudentSectionAssociation.LocalCourseCode = Section.LocalCourseCode AND 
                StudentSectionAssociation.SchoolYear = Section.SchoolYear");
            $this->db->join("edfi.Student", "Student.StudentUSI = StudentSectionAssociation.StudentUSI");
            $this->db->join("edfi.StudentElectronicMail", "StudentElectronicMail.StudentUSI = Student.StudentUSI");
            $this->db->where("StudentElectronicMail.PrimaryEmailAddressIndicator", "1");
            $this->db->where("Section.UniqueSectionCode", $section);

        // sort the, hashed, student emails by section.
        $data['students'] = $this->db->get()->result();

        // todo: change this to $api_students = ''; after the db has some useful data and remove line 182
        $api_students = '';
        foreach ($data['students'] as $key => $value) {

            $data['students'][$this->_encrypt_email($value->ElectronicMailAddress)] = array('name'  => $value->FirstName . ' ' . $value->LastSurname,
                                                                                            'page_count_total' => 0, // default these view values because the api simply doesnt return the user if there is no user data.
                                                                                            'page_time_total'  => 0 // default these view values because the api simply doesnt return the user if there is no user data.
                                                                                            );
            unset($data['students'][$key]);
            $api_students .= $this->_encrypt_email($value->ElectronicMailAddress) . ',';
        }



        // get the api data for each student
        $query      = http_build_query(array('org_api_key' => $api_key, 'org_secret_key' => $api_pass, 'date_begin' => '2015-01-01', 'date_end' => '2015-12-31', 'type' => 'detail', 'usernames' => $api_students));
        $site       = $api.'pages?'.$query;
        $response    = json_decode(file_get_contents($site, true));        

        foreach ($response->results as $student) {

            $page_time_total    = 0;
            $page_count_total   = 0;
            foreach ($student->page_visits as $key => $page) {
                $page_time_total += $page->total_time;
                $page_count_total++;
            }

            $data['students'][$student->username]['page_count_total']     = $page_count_total;
            $data['students'][$student->username]['page_time_total']      = $page_time_total;
        }

        $this->render("students",[
            'data'  => $data,
        ]);
    }

    private function _encrypt_email ($email = "") {
        $a             = $email . 'http://easol-dev.azurewebsites.net';
        $b             = hash('sha256', $a);
        $c             = '$2a$10$'.substr(base64_encode($b),0,22);        
        return crypt($email, $c);
    }    
    public function creating_hashes () {
        // WARNING: This function won't check for existing values and also 
        //a big increasement of PHP call should be done (this query runs a few minutes)
        $s = $this->db->query("SELECT * FROM edfi.StudentElectronicMail")->result();
        foreach ($s as $student){
            $email = ""; $a = ""; $b = ""; $c = ""; $result = ""; $data = array();

            $email = $student->ElectronicMailAddress;
            $a             = $email . 'http://easol-dev.azurewebsites.net';
            $b             = hash('sha256', $a);
            $c             = '$2a$10$'.substr(base64_encode($b),0,22);        
            $result =  crypt($email, $c);       
            $data = array(
             'email' => $email ,
             'HashedEmail' => $result
            );
            $this->db->insert('easol.EmailLookup', $data);
        }

    }    
}
