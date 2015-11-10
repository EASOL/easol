<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  "@",
        ];
    }

    public function __construct () {
        parent::__construct();
        $api              = $this->config->item('analytics_api');
        $this->api_url    = $api['url'];
        $this->api_key    = $api['key'];
        $this->api_pass   = $api['pass'];  
    }


    public function index() {   

        $data = array();
        $data['filters']                = $_GET;

        $data['currentYear']            = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        $data['currentYear_default']    = (isset($data['filters']['year']) and !empty($data['filters']['year'])) ? $data['filters']['year'] : Easol_SchoolConfiguration::setDefault('Year', $data['currentYear']);
        $data['currentTerm']            = Easol_SchoolConfiguration::getValue('CURRENT_TERMID');
        $data['currentTerm_default']    = (isset($data['filters']['term']) and !empty($data['filters']['term'])) ? $data['filters']['term'] : Easol_SchoolConfiguration::setDefault('Term', $data['currentTerm']);        
        $data['userCanFilter']          = Easol_SchoolConfiguration::canFilterByEducator();
       
        // define required filters
        $where = array(
                        'edfi.Grade.SchoolId'   => Easol_Authentication::userdata('SchoolId'),
                        'TermType.TermTypeId'   => $data['currentTerm_default'],
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
        // If it's educator who is logged in, we force change Where param
        if(!$data['userCanFilter']) $where[$lookFor['educator']] = Easol_Authentication::userdata('StaffUSI');

        $this->db->select("top 2 Grade.LocalCourseCode, Section.UniqueSectionCode, Section.id, Grade.ClassPeriodName, Staff.FirstName, Staff.LastSurname, TermType.CodeValue");
        $this->db->from('edfi.Grade'); 
        $this->db->join('edfi.School', 'School.SchoolId = Grade.SchoolId', 'inner'); 
        $this->db->join('edfi.GradingPeriod', 'GradingPeriod.EducationOrganizationId = Grade.SchoolId AND GradingPeriod.BeginDate = Grade.BeginDate AND GradingPeriod.GradingPeriodDescriptorId = Grade.GradingPeriodDescriptorId', 'inner'); 
        $this->db->join('edfi.StudentSectionAssociation', 'StudentSectionAssociation.StudentUSI = Grade.StudentUSI AND StudentSectionAssociation.SchoolId = Grade.SchoolId AND StudentSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.SchoolYear = Grade.SchoolYear AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StudentSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner'); 
        $this->db->join('edfi.Section', 'Section.LocalCourseCode = StudentSectionAssociation.LocalCourseCode AND Section.SchoolYear = StudentSectionAssociation.SchoolYear AND Section.TermTypeId = StudentSectionAssociation.TermTypeId AND Section.SchoolId = StudentSectionAssociation.SchoolId AND Section.ClassPeriodName = StudentSectionAssociation.ClassPeriodName AND Section.ClassroomIdentificationCode = StudentSectionAssociation.ClassroomIdentificationCode', 'inner');
        $this->db->join('edfi.StaffSectionAssociation', 'StaffSectionAssociation.SchoolId = Grade.SchoolId AND StaffSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.SchoolYear = Grade.SchoolYear AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StaffSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner');
        $this->db->join('edfi.Staff', 'Staff.StaffUSI = StaffSectionAssociation.StaffUSI', 'inner');
        $this->db->join('edfi.Course', 'edfi.Course.EducationOrganizationId = edfi.Grade.SchoolId AND edfi.Course.CourseCode = edfi.Grade.LocalCourseCode', 'inner');
        $this->db->join('edfi.TermType', 'edfi.TermType.TermTypeId = edfi.Grade.TermTypeId', 'inner');
        $this->db->order_by('Grade.LocalCourseCode');

        $data['results']    = $this->db->distinct()->where($where)->get()->result();
        $meeting_times = array();
        $sections = array();
        foreach ($data['results'] as $k => $v)
        {
            $data['results'][$v->id] = $v;

            list($pCode,$pName) = explode(' - ', $v->ClassPeriodName);
            $data['results'][$v->id]->Period = $pCode;

            $data['results'][$v->id]->Educator = $v->FirstName . ' ' . $v->LastSurname;            
            unset($data['results'][$k]);

            $sections[] = $v->id;

            // get the section datetime intervals
            $urldates = ''; 
            $SchoolId           = Easol_Authentication::userdata('SchoolId');
            $ClassPeriodName    = $v->ClassPeriodName;
            $this->db->select("BellSchedule.date, BellScheduleMeetingTime.starttime, BellScheduleMeetingTime.endtime");
            $this->db->from("edfi.BellSchedule"); 
            $this->db->join('edfi.BellScheduleMeetingTime', 'BellScheduleMeetingTime.date = BellSchedule.date'); 
            $this->db->where("BellSchedule.SchoolId = '$SchoolId' AND BellScheduleMeetingTime.ClassPeriodName = '$ClassPeriodName'");
            $intervals = $this->db->get()->result();
            foreach ($intervals as $key => $value) {
                $urldates .= '&date_begin[]=' . $value->date . 'T' . $value->starttime . '&date_end[]=' . $value->date . 'T' . $value->endtime;
            }  
            $meeting_times[$v->id] = $urldates;            

        }

        if (!empty($sections)) {
            $this->db->select("EmailLookup.HashedEmail, Section.UniqueSectionCode, Section.id"); 
            $this->db->from("edfi.Section");
            $this->db->join("edfi.StudentSectionAssociation", "StudentSectionAssociation.SchoolId = Section.SchoolId AND 
                StudentSectionAssociation.ClassPeriodName = Section.ClassPeriodName AND 
                StudentSectionAssociation.ClassroomIdentificationCode = Section.ClassroomIdentificationCode AND 
                StudentSectionAssociation.LocalCourseCode = Section.LocalCourseCode AND 
                StudentSectionAssociation.SchoolYear = Section.SchoolYear");
            $this->db->join("edfi.StudentElectronicMail", "StudentElectronicMail.StudentUSI = StudentSectionAssociation.StudentUSI");
            $this->db->join('easol.EmailLookup','EmailLookup.email = StudentElectronicMail.ElectronicMailAddress');            
            $this->db->where("StudentElectronicMail.PrimaryEmailAddressIndicator", "1");
            $this->db->where_in("Section.id", $sections);

            // sort the, hashed, student emails by section.
            $students = $this->db->distinct()->get()->result();
            foreach ($students as $key => $value) {
                $data['results'][$value->id]->students[] = $value->HashedEmail;
            }

            foreach ($data['results'] as $section => $obj) {

                // define the number of student records for the section.
                $data['results'][$section]->StudentCount = count($obj->students);
               
                // get the sites api data for the section's students
                $api_students       = '';
                foreach ($obj->students as $key => $HashedEmail) {
                    $api_students .= $HashedEmail . ',';
                }
                
                $query      = http_build_query(array('org_api_key' => $this->api_key, 'org_secret_key' => $this->api_pass, 'type' => 'detail', 'usernames' => $api_students));
                $site       = $this->api_url.'sites?'.$query.$meeting_times[$section];
                $response   = json_decode(file_get_contents($site, true));
                
                $times = array();
                foreach ($response->results as $student) {

                    foreach ($student->site_visits as $key => $site) {
                        $times[] = $site->total_time;
                    }
                }
                
                $data['results'][$section]->Average = (!empty($times)) ? gmdate('H:i:s', (array_sum($times) / $data['results'][$section]->StudentCount)) : 0; 
                
            }
        }
       
        $sql                    = "SELECT TermTypeId, CodeValue FROM edfi.TermType";
        $data['terms']          = $this->db->query($sql)->result();

        $data['years']          = range($data['currentYear'], date('Y'));

        $sql                    = "SELECT CourseCode, CourseTitle FROM edfi.Course ORDER BY CourseTitle";
        $data['courses']        = $this->db->query($sql)->result();

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
        $data       = array();

        // define required filters
        $where = array(
                        'Section.id'   => $section,
        );

        // This Separate SQL call is to get details about the Section
        $this->db->select("Grade.LocalCourseCode, SEC.UniqueSectionCode, SEC.id, Grade.ClassPeriodName, Staff.FirstName, Staff.LastSurname, TermType.CodeValue");
        $this->db->from('edfi.Grade'); 
        $this->db->join('edfi.Section as SEC', 'edfi.Grade.SchoolId = SEC.SchoolId AND 
                                       edfi.Grade.SchoolYear = SEC.SchoolYear AND 
                                       edfi.Grade.ClassPeriodName = SEC.ClassPeriodName AND
                                       edfi.Grade.ClassroomIdentificationCode = SEC.ClassroomIdentificationCode AND
                                       edfi.Grade.LocalCourseCode = SEC.LocalCourseCode AND
                                       edfi.Grade.TermTypeId = SEC.TermTypeId', 'inner');
        $this->db->join('edfi.StaffSectionAssociation', 'StaffSectionAssociation.SchoolId = Grade.SchoolId AND StaffSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.SchoolYear = Grade.SchoolYear AND StaffSectionAssociation.TermTypeId = Grade.TermTypeId AND StaffSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StaffSectionAssociation.ClassPeriodName = Grade.ClassPeriodName', 'inner');
        $this->db->join('edfi.Staff', 'Staff.StaffUSI = StaffSectionAssociation.StaffUSI', 'inner');
        $this->db->join('edfi.TermType', 'edfi.TermType.TermTypeId = edfi.Grade.TermTypeId', 'inner');
        $this->db->where('SEC.id',$section);
        $data['section']    = $this->db->get()->row();
        $data['section']->Educator = $data['section']->FirstName . ' ' . $data['section']->LastSurname;      
        list($pCode,$pName) = explode(' - ', $data['section']->ClassPeriodName);
        $data['section']->Period = $pCode;      


        // Getting list of students
        $this->db->select("Student.FirstName, Student.MiddleName, Student.LastSurname, EmailLookup.HashedEmail, Section.UniqueSectionCode"); 
        $this->db->from("edfi.Section");
        $this->db->join("edfi.StudentSectionAssociation", "StudentSectionAssociation.SchoolId = Section.SchoolId AND 
            StudentSectionAssociation.ClassPeriodName = Section.ClassPeriodName AND 
            StudentSectionAssociation.ClassroomIdentificationCode = Section.ClassroomIdentificationCode AND 
            StudentSectionAssociation.LocalCourseCode = Section.LocalCourseCode AND 
            StudentSectionAssociation.SchoolYear = Section.SchoolYear");
        $this->db->join("edfi.Student", "Student.StudentUSI = StudentSectionAssociation.StudentUSI");
        $this->db->join("edfi.StudentElectronicMail", "StudentElectronicMail.StudentUSI = Student.StudentUSI");
        $this->db->join('easol.EmailLookup','EmailLookup.email = StudentElectronicMail.ElectronicMailAddress');
        $this->db->where("StudentElectronicMail.PrimaryEmailAddressIndicator", "1");
        $this->db->where("Section.id", $section);

        // sort the, hashed, student emails by section.
        $data['students'] = $this->db->distinct()->get()->result();

        $api_students = '';
        foreach ($data['students'] as $key => $value) {

            $data['students'][$value->HashedEmail] = array('name'  => $value->FirstName .' '.$value->MiddleName.' ' . $value->LastSurname,
                                                                                            'page_count_total' => 0, // default these view values because the api simply doesnt return the user if there is no user data.
                                                                                            'page_time_total'  => 0 // default these view values because the api simply doesnt return the user if there is no user data.
                                                                                            );
            unset($data['students'][$key]);
            $api_students .= $value->HashedEmail . ',';
        }
   

        // get the page api data for each student
        $query      = http_build_query(array('org_api_key' => $this->api_key, 'org_secret_key' => $this->api_pass, 'date_begin[]' => '2015-01-01', 'date_end[]' => '2015-12-31', 'type' => 'detail', 'usernames' => $api_students));
        $site       = $this->api_url.'pages?'.$query;
        $response   = json_decode(file_get_contents($site, true));        

        foreach ($response->results as $student) {

            $page_time_total    = 0;
            $page_count_total   = 0;
            foreach ($student->page_visits as $key => $page) {
                $page_time_total += $page->total_time;
                $page_count_total++;
            }

            $data['students'][$student->username]['page_count_total']     = $page_count_total;
            $data['students'][$student->username]['page_time_total']      = gmdate('H:i', $page_time_total);
        }

        // get the video data for each student
        $query      = http_build_query(array('org_api_key' => $this->api_key, 'org_secret_key' => $this->api_pass, 'date_begin[]' => '2015-01-01', 'date_end[]' => '2015-12-31', 'usernames' => $api_students));
        $site       = $this->api_url.'video-views?'.$query;
        $response   = json_decode(file_get_contents($site, true));        

        foreach ($response->results as $student) {

            $video_time_total    = 0;
            $video_count_total   = 0;
            foreach ($student->video_visits as $key => $video) {
                $video_time_total += $video->total_time;
                $video_count_total++;
            }

            $data['students'][$student->username]['video_count_total']     = $video_count_total;
            $data['students'][$student->username]['video_time_total']      = gmdate('H:i', $video_time_total);
        }


        $this->render("students",[
            'data'  => $data,
        ]);
    }

    // todo:
    // this function should be used when adding/editing easol users to store their email as a hash
    // for use in api requests.
    private function _encrypt_email ($email = "") {
        $a             = $email . 'http://easol-dev.azurewebsites.net';
        $b             = hash('sha256', $a);
        $c             = '$2a$10$'.substr(base64_encode($b),0,22);        
        return crypt($email, $c);
    }    
   
    private function creating_hashes () {
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
