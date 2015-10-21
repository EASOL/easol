<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_Cohort extends Easol_baseentity {

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
            'EducationOrganizationId'       => 'EducationOrganizationId',
            'CohortIdentifier'              => 'CohortIdentifier',
            'CohortDescription'             => 'CohortDescription',
            'CohortTypeId'                  => 'CohortTypeId',
            'CohortScopeTypeId'             => 'CohortScopeTypeId',
            'AcademicSubjectDescriptorId'   => 'AcademicSubjectDescriptorId',

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
        return "edfi.Cohort";
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        return 'Id';
    }
}