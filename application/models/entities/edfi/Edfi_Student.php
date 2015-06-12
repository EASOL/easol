<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/2/2015
 * Time: 9:53 PM
 */

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


    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.student";
    }

}