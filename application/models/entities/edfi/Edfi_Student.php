<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_Student extends Easol_baseentity {

    private $sex;
    private $race;
    private $limitedEnglishProficiency;

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            'StudentUSI'              => 'StudentUSI',
            'PersonalTitlePrefix'   => 'Personal Title Prefix',
            'FirstName'             => 'First Name',
            'MiddleName'            => 'Middle Name',
            'LastSurname'           => 'Last Name',
            'GenerationCodeSuffix'  => 'GenerationCodeSuffix',
            'MaidenName'            => 'MaidenName',
            'SexTypeId'             => 'Sex',
            'BirthDate'             => 'Birthdate',
            'CityOfBirth'             => 'City Of Birth',
            'BirthStateAbbreviationTypeId'             => 'BirthStateAbbreviationTypeId',
            'BirthCountryCodeTypeId'             => 'BirthCountryCodeTypeId',
            'DateEnteredUS'             => 'DateEnteredUS',
            'MultipleBirthStatus'             => 'MultipleBirthStatus',
            'ProfileThumbnail'             => 'ProfileThumbnail',
            'HispanicLatinoEthnicity' => 'Hispanic/Latino',
            'OldEthnicityTypeId'    => 'OldEthnicityTypeId',
            'EconomicDisadvantaged' => 'Economic Disadvantaged',
            'SchoolFoodServicesEligibilityDescriptorId' => 'SchoolFoodServicesEligibilityDescriptorId',
            'LimitedEnglishProficiencyDescriptorId' => 'Limited English Descriptor',
            'DisplacementStatus' => 'DisplacementStatus',
            'LoginId' => 'LoginId',
            'InternationalProvinceOfBirth' => 'InternationalProvinceOfBirth',
            'CitizenshipStatusTypeId'   =>  'CitizenshipStatusTypeId',
            'StudentUniqueId'         =>  'Student ID',
            'Id'                    =>  'Id',
            'LastModifiedDate'      =>  'LastModifiedDate',
            'CreateDate'            =>  'CreateDate'


        ];
    }

    /**
     * @return Edfi_SexType
     */
    public function getSex(){
        if(!isset($this->sex)){
            $this->load->model('entities/edfi/Edfi_SexType','Edfi_SexType');
            $this->sex = $this->Edfi_SexType->hydrate($this->Edfi_SexType->findOne(['SexTypeId' =>$this->SexTypeId]));
        }
            return $this->sex;
    }

    /**
     * @return Edfi_RaceType
     */
    public function getRace(){
        if(!isset($this->race)){
            $this->load->model('entities/edfi/Edfi_RaceType','Edfi_RaceType');
            $this->race = $this->Edfi_RaceType->hydrate($this->Edfi_RaceType->findOneBySql("select RaceType.* from edfi.StudentRace inner join
edfi.RaceType on RaceType.RaceTypeId=StudentRace.RaceTypeId where StudentRace.StudentUSI = ?
",[$this->StudentUSI]));
        }


        return $this->race;
    }

    /**
     * @return Edfi_LimitedEnglishProficiencyType
     */
    public function getLimitedEnglishProficiency(){
      if(!isset($this->limitedEnglishProficiency)){
            $this->load->model('entities/edfi/Edfi_LimitedEnglishProficiencyType','Edfi_LimitedEnglishProficiencyType');
            $this->limitedEnglishProficiency = $this->Edfi_LimitedEnglishProficiencyType->hydrate($this->Edfi_LimitedEnglishProficiencyType->findOneBySql(
            "select LimitedEnglishProficiencyType.* from edfi.LimitedEnglishProficiencyType inner join
edfi.LimitedEnglishProficiencyDescriptor on LimitedEnglishProficiencyType.LimitedEnglishProficiencyTypeId=LimitedEnglishProficiencyDescriptor.LimitedEnglishProficiencyTypeId where LimitedEnglishProficiencyDescriptor.LimitedEnglishProficiencyDescriptorId = ?",
            [
                $this->LimitedEnglishProficiencyDescriptorId
            ]
            ));
        }


        return $this->limitedEnglishProficiency;
    }


    public function getAddresses(){
        return $this->db->query("select AddressType.Description  as Type, StreetNumberName, ApartmentRoomSuiteNumber, City, StateAbbreviationType.Description as State, PostalCode from edfi.StudentAddress
inner join edfi.AddressType on AddressType.addresstypeid = StudentAddress.AddressTypeId
inner join edfi.StateAbbreviationType on StateAbbreviationType.StateAbbreviationTypeId = StudentAddress.StateAbbreviationTypeId
where StudentUSI = ?",
            [
                $this->StudentUSI
            ]);
    }

    public function getParents(){
        return $this->db->query("select Parent.PersonalTitlePrefix, Parent.FirstName, Parent.LastSurname, RelationType.Description as Role, StudentParentAssociation.PrimaryContactStatus, StudentParentAssociation.LivesWith, StudentParentAssociation.EmergencyContactStatus from edfi.StudentParentAssociation
inner join edfi.RelationType on RelationType.RelationTypeId = StudentParentAssociation.RelationTypeId
inner join edfi.Parent on Parent.ParentUSI = StudentParentAssociation.ParentUSI
where StudentUSI = ?",
            [
                $this->StudentUSI
            ]);
    }

    public function getTelephones(){
        return $this->db->query("select StudentTelephone.TelephoneNumber, TelephoneNumberType.Description as telephonetype  from edfi.StudentTelephone
left join edfi.TelephoneNumberType on StudentTelephone.telephonenumbertypeid = TelephoneNumberType.TelephoneNumberTypeId
where StudentTelephone.StudentUSI =  ?",
            [
                $this->StudentUSI
            ]);
    }

    public function getEmailAddresses(){
        return $this->db->query("select ElectronicMailType.Description as emailType, StudentElectronicMail.ElectronicMailAddress from edfi.StudentElectronicMail
inner join edfi.ElectronicMailType on ElectronicMailType.ElectronicMailTypeId = StudentElectronicMail.ElectronicMailTypeId
where StudentElectronicMail.StudentUSI = ?",
            [
                $this->StudentUSI
            ]);
    }

    public function getSections(){
        return $this->db->query("select StudentSectionAssociation.ClassPeriodName, StudentSectionAssociation.ClassroomIdentificationCode,
 StudentSectionAssociation.LocalCourseCode, [Section].UniqueSectionCode, TermType.Description,
StudentSectionAssociation.SchoolYear, Staff.FirstName, Staff.LastSurname
from edfi.StudentSectionAssociation
inner join edfi.[Section] on
     StudentSectionAssociation.SchoolId = [Section].SchoolId and
     StudentSectionAssociation.SchoolYear = [Section].SchoolYear and
     StudentSectionAssociation.LocalCourseCode = [Section].LocalCourseCode and
     StudentSectionAssociation.ClassroomIdentificationCode = [Section].ClassroomIdentificationCode and
     StudentSectionAssociation.TermTypeId = [Section].TermTypeId AND
		 StudentSectionAssociation.ClassPeriodName = [Section].ClassPeriodName
inner join edfi.TermType ON
     StudentSectionAssociation.TermTypeId = TermType.TermTypeId
left join edfi.StaffSectionAssociation on
     StaffSectionAssociation.SchoolId = [Section].SchoolId and
     StaffSectionAssociation.SchoolYear = [Section].SchoolYear and
     StaffSectionAssociation.LocalCourseCode = [Section].LocalCourseCode and
     StaffSectionAssociation.ClassroomIdentificationCode = [Section].ClassroomIdentificationCode and
     StaffSectionAssociation.TermTypeId = [Section].TermTypeId AND
     StaffSectionAssociation.ClassPeriodName = [Section].ClassPeriodName
left join edfi.Staff ON
     Staff.StaffUSI = StaffSectionAssociation.StaffUSI
where StudentUSI = ?",
            [
                $this->StudentUSI
            ]);
    }


    public function getGrades(){

        return $this->db->query("SELECT Grade.LocalCourseCode, Course.CourseTitle, Grade.ClassPeriodName, TermType.CodeValue as Term, Grade.SchoolYear, Grade.LetterGradeEarned, Grade.NumericGradeEarned
FROM edfi.Grade
INNER JOIN edfi.GradingPeriod ON GradingPeriod.EducationOrganizationId = Grade.SchoolId AND GradingPeriod.BeginDate = Grade.BeginDate AND GradingPeriod.GradingPeriodDescriptorId = Grade.GradingPeriodDescriptorId
INNER JOIN edfi.StudentSectionAssociation ON StudentSectionAssociation.StudentUSI = Grade.StudentUSI AND StudentSectionAssociation.SchoolId = Grade.SchoolId AND StudentSectionAssociation.LocalCourseCode = Grade.LocalCourseCode AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.SchoolYear = Grade.SchoolYear AND StudentSectionAssociation.TermTypeId = Grade.TermTypeId AND StudentSectionAssociation.ClassroomIdentificationCode = Grade.ClassroomIdentificationCode AND StudentSectionAssociation.ClassPeriodName = Grade.ClassPeriodName
INNER JOIN edfi.Section ON Section.LocalCourseCode = StudentSectionAssociation.LocalCourseCode AND Section.SchoolYear = StudentSectionAssociation.SchoolYear AND Section.TermTypeId = StudentSectionAssociation.TermTypeId AND Section.SchoolId = StudentSectionAssociation.SchoolId AND Section.ClassPeriodName = StudentSectionAssociation.ClassPeriodName AND Section.ClassroomIdentificationCode = StudentSectionAssociation.ClassroomIdentificationCode
INNER JOIN edfi.Course ON edfi.Course.EducationOrganizationId = edfi.Grade.SchoolId AND edfi.Course.CourseCode = edfi.Grade.LocalCourseCode
INNER JOIN edfi.TermType ON edfi.TermType.TermTypeId = edfi.Grade.TermTypeId
WHERE StudentSectionAssociation.StudentUSI=?
ORDER BY Grade.BeginDate DESC",
            [
                $this->StudentUSI
            ]);

    }

    /**
     * @return mixed
     */
    public function getAttendance(){
        $query = "SELECT Section.ClassPeriodName, Section.LocalCourseCode, Section.UniqueSectionCode, CodeValue, COUNT(*) as Days
FROM edfi.StudentSectionAttendanceEvent
INNER JOIN edfi.[Section] ON
    [Section].ClassPeriodName = StudentSectionAttendanceEvent.ClassPeriodName AND
    [Section].ClassroomIdentificationCode = StudentSectionAttendanceEvent.ClassroomIdentificationCode AND
    [Section].LocalCourseCode = StudentSectionAttendanceEvent.LocalCourseCode AND
    [Section].TermTypeId = StudentSectionAttendanceEvent.TermTypeId AND
  [Section].SchoolYear = StudentSectionAttendanceEvent.SchoolYear AND
  [Section].SchoolId = StudentSectionAttendanceEvent.SchoolId
INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSectionAttendanceEvent.AttendanceEventCategoryDescriptorId
INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
WHERE StudentUSI = [StudentUSI]
AND (CodeValue = 'Excused Absence' OR CodeValue='Unexcused Absence') AND StudentSectionAttendanceEvent.TermTypeId = [TermTypeId] AND StudentSectionAttendanceEvent.SchoolYear = [SchoolYear]
GROUP BY Section.ClassPeriodName, Section.LocalCourseCode, Section.UniqueSectionCode, AttendanceEventCategoryType.CodeValue
UNION
SELECT Section.ClassPeriodName, Section.LocalCourseCode, Section.UniqueSectionCode, CodeValue, COUNT(*) as Tardy
FROM edfi.StudentSectionAttendanceEvent
INNER JOIN edfi.[Section] ON
    [Section].ClassPeriodName = StudentSectionAttendanceEvent.ClassPeriodName AND
    [Section].ClassroomIdentificationCode = StudentSectionAttendanceEvent.ClassroomIdentificationCode AND
    [Section].LocalCourseCode = StudentSectionAttendanceEvent.LocalCourseCode AND
    [Section].TermTypeId = StudentSectionAttendanceEvent.TermTypeId AND
  [Section].SchoolYear = StudentSectionAttendanceEvent.SchoolYear AND
  [Section].SchoolId = StudentSectionAttendanceEvent.SchoolId
INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSectionAttendanceEvent.AttendanceEventCategoryDescriptorId
INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
WHERE StudentUSI = [StudentUSI]
AND (CodeValue = 'Tardy') AND StudentSectionAttendanceEvent.TermTypeId = [TermTypeId] AND StudentSectionAttendanceEvent.SchoolYear = [SchoolYear]
GROUP BY Section.ClassPeriodName, Section.LocalCourseCode, Section.UniqueSectionCode, AttendanceEventCategoryType.CodeValue
UNION
SELECT Section.ClassPeriodName, Section.LocalCourseCode, Section.UniqueSectionCode, CodeValue, COUNT(*) as Present
FROM edfi.StudentSectionAttendanceEvent
INNER JOIN edfi.[Section] ON
    [Section].ClassPeriodName = StudentSectionAttendanceEvent.ClassPeriodName AND
    [Section].ClassroomIdentificationCode = StudentSectionAttendanceEvent.ClassroomIdentificationCode AND
    [Section].LocalCourseCode = StudentSectionAttendanceEvent.LocalCourseCode AND
    [Section].TermTypeId = StudentSectionAttendanceEvent.TermTypeId AND
  [Section].SchoolYear = StudentSectionAttendanceEvent.SchoolYear AND
  [Section].SchoolId = StudentSectionAttendanceEvent.SchoolId
INNER JOIN edfi.AttendanceEventCategoryDescriptor ON AttendanceEventCategoryDescriptor.AttendanceEventCategoryDescriptorId = StudentSectionAttendanceEvent.AttendanceEventCategoryDescriptorId
INNER JOIN edfi.AttendanceEventCategoryType ON AttendanceEventCategoryType.AttendanceEventCategoryTypeId = AttendanceEventCategoryDescriptor.AttendanceEventCategoryTypeId
WHERE StudentUSI = [StudentUSI]
AND (CodeValue = 'In Attendance') AND StudentSectionAttendanceEvent.TermTypeId = [TermTypeId] AND StudentSectionAttendanceEvent.SchoolYear = [SchoolYear]
GROUP BY Section.ClassPeriodName, Section.LocalCourseCode, Section.UniqueSectionCode, AttendanceEventCategoryType.CodeValue";

        $termId = Easol_SchoolConfiguration::getValue('CURRENT_TERMID');
        $schoolYear = Easol_SchoolConfiguration::getValue('CURRENT_SCHOOLYEAR');
        if($termId && $schoolYear) {
            $query = str_replace(['[StudentUSI]', '[TermTypeId]', '[SchoolYear]'], [$this->StudentUSI, $termId, $schoolYear], $query);

            return $this->db->query($query,
                [
                    $this->StudentUSI
                ])->result();
        }

        return [];

    }

    public function getAssessments(){

        return $this->db->query("SELECT StudentAssessment.AssessmentTitle,
StudentAssessment.Version, StudentAssessment.AdministrationDate, StudentAssessmentScoreResult.Result, AcademicSubjectType.CodeValue
as AcademicSubject, GradeLevelType.CodeValue as GradeLevel FROM edfi.StudentAssessment
INNER JOIN edfi.StudentAssessmentScoreResult ON edfi.StudentAssessmentScoreResult.StudentUSI = edfi.StudentAssessment.StudentUSI
AND edfi.StudentAssessmentScoreResult.AssessmentTitle = edfi.StudentAssessment.AssessmentTitle
AND edfi.StudentAssessmentScoreResult.AdministrationDate = edfi.StudentAssessment.AdministrationDate
AND edfi.StudentAssessmentScoreResult.AssessedGradeLevelDescriptorId = edfi.StudentAssessment.AssessedGradeLevelDescriptorId
INNER JOIN edfi.AcademicSubjectDescriptor
ON edfi.AcademicSubjectDescriptor.AcademicSubjectDescriptorId = edfi.StudentAssessment.AcademicSubjectDescriptorId
INNER JOIN edfi.AcademicSubjectType
ON edfi.AcademicSubjectType.AcademicSubjectTypeId = edfi.AcademicSubjectDescriptor.AcademicSubjectTypeId
INNER JOIN edfi.GradeLevelDescriptor
ON edfi.GradeLevelDescriptor.GradeLevelDescriptorId = edfi.StudentAssessment.AssessedGradeLevelDescriptorId
INNER JOIN edfi.GradeLevelType ON edfi.GradeLevelType.GradeLevelTypeId = edfi.GradeLevelDescriptor.GradeLevelTypeId
WHERE edfi.StudentAssessmentScoreResult.StudentUSI = ?
ORDER BY AdministrationDate DESC",
            [
                $this->StudentUSI
            ]);

    }

    public function getCohorts(){

        return $this->db->query("SELECT edfi.Cohort.Id, edfi.Cohort.CohortIdentifier FROM edfi.StudentCohortAssociation
INNER JOIN edfi.Cohort ON edfi.StudentCohortAssociation.CohortIdentifier = edfi.Cohort.CohortIdentifier AND edfi.StudentCohortAssociation.EducationOrganizationId = edfi.Cohort.EducationOrganizationId
WHERE StudentUSI = ?",
            [
                $this->StudentUSI
            ]);

    }


    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.student";
    }

    /**
     * Return primary key of the table
     * @return null | string
     */
    public function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }
}