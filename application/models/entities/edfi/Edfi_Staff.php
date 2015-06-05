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


    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.staff";
    }

}