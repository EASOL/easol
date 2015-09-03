<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/2/2015
 * Time: 9:53 PM
 */

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_Staff extends Easol_baseentity {

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            'StaffUSI'              => 'StaffUSI',
            'PersonalTitlePrefix'   => 'Personal Title Prefix',
            'FirstName'             => 'First Name',
            'MiddleName'            => 'Middle Name',
            'LastSurname'           => 'Last Surname',
            'GenerationCodeSuffix'  => 'GenerationCodeSuffix',
            'MaidenName'            => 'MaidenName',
            'SexTypeId'             => 'SexTypeId',
            'BirthDate'             => 'BirthDate',
            'HispanicLatinoEthnicity' => 'HispanicLatinoEthnicity',
            'OldEthnicityTypeId'    => 'OldEthnicityTypeId',
            'HighestCompletedLevelOfEducationDescriptorId'  =>  'HighestCompletedLevelOfEducationDescriptorId',
            'YearsOfPriorProfessionalExperience'    =>  'YearsOfPriorProfessionalExperience',
            'YearsOfPriorTeachingExperience'    =>  'YearsOfPriorTeachingExperience',
            'HighlyQualifiedTeacher'    =>  'HighlyQualifiedTeacher',
            'LoginId'               =>  'LoginId',
            'CitizenshipStatusTypeId'   =>  'CitizenshipStatusTypeId',
            'StaffUniqueId'         =>  'StaffUniqueId',
            'Id'                    =>  'Id',
            'LastModifiedDate'      =>  'LastModifiedDate',
            'CreateDate'            =>  'CreateDate'


        ];
    }

    public function getAssociatedSchool(){
       return $this->findOneBySql("SELECT EducationOrganization.EducationOrganizationId,
EducationOrganization.NameOfInstitution, EducationOrganizationAddress.City
FROM edfi.EducationOrganization
INNER JOIN edfi.School
ON edfi.School.SchoolId = edfi.EducationOrganization.EducationOrganizationId
INNER JOIN edfi.EducationOrganizationAddress
ON edfi.EducationOrganizationAddress.EducationOrganizationId = edfi.EducationOrganization.EducationOrganizationId
INNER JOIN edfi.StaffSchoolAssociation
ON School.SchoolId=StaffSchoolAssociation.SchoolId
WHERE OperationalStatusTypeId = 1 and AddressTypeId = 2 AND StaffSchoolAssociation.StaffUSI=?",[$this->StaffUSI]);

    }

    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.staff";
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        // TODO: Implement getPrimaryKey() method.
    }

    public function findByEmail($email) {

        return $this->findOneBySql("SELECT edfi.Staff.StaffUSI FROM edfi.StaffElectronicMail
                JOIN edfi.Staff ON edfi.Staff.StaffUSI = edfi.StaffElectronicMail.StaffUSI
                WHERE edfi.StaffElectronicMail.ElectronicMailAddress = '$email'");
    }
}