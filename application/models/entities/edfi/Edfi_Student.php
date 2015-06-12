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


    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.student";
    }

}