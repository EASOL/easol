<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Easol_Controller {


    protected function accessRules(){
        return [
            "index"     =>  ['System Administrator','Data Administrator'],
        ];
    }


    /**
     * index action
     * @param int $id
     */
    public function index($id=1)
    {
        $currentYear = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        $currentYear_default = Easol_SchoolConfiguration::setDefault('Year', $currentYear);

        $query= "SELECT Student.StudentUSI, Student.FirstName, Student.LastSurname, GradeLevelType.Description as Grade, StudentCohortAssociation.CohortIdentifier,
StudentSchoolAssociation.SchoolYear
from edfi
.StudentSchoolAssociation
INNER JOIN edfi.Student ON
     StudentSchoolAssociation.StudentUSI = Student.StudentUSI
INNER JOIN edfi.GradeLevelDescriptor ON
     StudentSchoolAssociation.EntryGradeLevelDescriptorId = GradeLevelDescriptor.GradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON
     GradeLevelDescriptor.GradeLevelTypeId = GradeLevelType.GradeLevelTypeId
LEFT JOIN edfi.StudentCohortAssociation ON
      StudentCohortAssociation.EducationOrganizationId = StudentSchoolAssociation.SchoolId AND StudentCohortAssociation.StudentUSI = StudentSchoolAssociation.StudentUSI
WHERE
     StudentSchoolAssociation.SchoolId = '".Easol_Authentication::userdata('SchoolId')."'

                  ";

        $query = $this->db->query($query);
        $data['student_listing'] = $query->result();

        $query = "SELECT * FROM edfi.GradeLevelType where GradeLevelTypeId in (SELECT distinct GradeLevelType.GradeLevelTypeId from edfi.StudentSchoolAssociation
INNER JOIN edfi.Student ON
     StudentSchoolAssociation.StudentUSI = Student.StudentUSI
INNER JOIN edfi.GradeLevelDescriptor ON
     StudentSchoolAssociation.EntryGradeLevelDescriptorId = GradeLevelDescriptor.GradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON
     GradeLevelDescriptor.GradeLevelTypeId = GradeLevelType.GradeLevelTypeId
LEFT JOIN edfi.StudentCohortAssociation ON
      StudentCohortAssociation.EducationOrganizationId = StudentSchoolAssociation.SchoolId AND StudentCohortAssociation.StudentUSI = StudentSchoolAssociation.StudentUSI
 WHERE StudentSchoolAssociation.SchoolId = '" . Easol_Authentication::userdata('SchoolId') . "' and GradeLevelType.GradeLevelTypeId between -1 and 12 ) ";
        $query = $this->db->query($query);
        $data['grade_listing'] = [''=>'All Grades'];
        foreach ($query->result() as $row) {
            $data['grade_listing'][$row->GradeLevelTypeId] = $row->Description;
        }


         $query = "SELECT DISTINCT edfi.StudentCohortAssociation.CohortIdentifier FROM edfi.StudentCohortAssociation";
         $query = $this->db->query($query);

         $data['cohort_listing'] = [''=>'All Cohorts'];
         foreach ($query->result() as $row) {
              $data['cohort_listing'][$row->CohortIdentifier] = $row->CohortIdentifier;
         }

         $data['year_listing'] = [''=>'All Years'];
         while ($currentYear <= date('Y')) {
              $data['year_listing'][$currentYear] = $currentYear;
              $currentYear++;
         }


        $this->render("index", $data);
    }


    /**
     * Student Profile Page
     * @param null $id
     */
    public function profile($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));



        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("profile",
                        [
                            'student'   => $student
                        ],
                    true
                    ),
                'student'   => $student,
                'tab'   =>  'overview'
            ]
            );
    }
    /**
     * Student Contact Page
     * @param null $id
     */
    public function contacts($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));



        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("contacts",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'contacts'
            ]
        );
    }

    /**
     * Student Section Page
     * @param null $id
     */
    public function sections($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));



        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("sections",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'sections'
            ]
        );
    }

    /**
     * Student Grade Page
     * @param null $id
     */
    public function grades($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("grades",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'grades'
            ]
        );
    }

    /**
     * Student Attendance Page
     * @param null $id
     */
    public function attendance($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("attendance",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'attendance'
            ]
        );
    }

    /**
     * Student Assessments Page
     * @param null $id
     */
    public function assessments($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("assessments",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'assessments'
            ]
        );
    }

    /**
     * Student Cohorts Page
     * @param null $id
     */
    public function cohorts($id=null){
        if($id==null) throw new UnexpectedValueException('Student USI not set!!');

        $this->load->model('entities/edfi/Edfi_Student','Edfi_Student');



        $student = $this->Edfi_Student->hydrate($this->Edfi_Student->findOne(['StudentUSI' => $id]));





        $this->render("profile_layout",
            [
                'tabContent'   =>  $this->renderPartial("cohorts",
                    [
                        'student'   => $student
                    ],
                    true
                ),
                'student'   => $student,
                'tab'   =>  'cohorts'
            ]
        );
    }
}
