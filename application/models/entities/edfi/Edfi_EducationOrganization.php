<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_EducationOrganization extends Easol_baseentity {

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
            'StateOrganizationId'              => 'StateOrganizationId',
            'NameOfInstitution'             => 'NameOfInstitution',
            'ShortNameOfInstitution'                  => 'ShortNameOfInstitution',
            'WebSite'             => 'WebSite',
            'OperationalStatusTypeId'   => 'OperationalStatusTypeId',
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
        return "edfi.EducationOrganization";
    }

    /**
     * Return primary key of the table
     * @return null | int
     */
    public function getPrimaryKey()
    {
        return 'EducationOrganizationId';
    }
}