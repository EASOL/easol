<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/2/2015
 * Time: 9:53 PM
 */

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
        // TODO: Implement getPrimaryKey() method.
    }
}