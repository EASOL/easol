<?php

require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_School extends Easol_baseentity {

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            'SchoolId'              => 'SchoolId',
            'LocalEducationAgencyId'   => 'LocalEducationAgencyId',
            'SchoolTypeId'             => 'SchoolTypeId',
            'CharterStatusTypeId'            => 'CharterStatusTypeId',
            'TitleIPartASchoolDesignationTypeId'           => 'TitleIPartASchoolDesignationTypeId',
            'MagnetSpecialProgramEmphasisSchoolTypeId'  => 'MagnetSpecialProgramEmphasisSchoolTypeId',
            'AdministrativeFundingControlDescriptorId'            => 'AdministrativeFundingControlDescriptorId',
            'InternetAccessTypeId'             => 'InternetAccessTypeId',
        ];
    }



    public function getAllSchools(){
         return $this->db->query("SELECT EducationOrganization.EducationOrganizationId,
                  EducationOrganization.NameOfInstitution, EducationOrganizationAddress.City
                  FROM edfi.EducationOrganization
                  INNER JOIN edfi.School
                  ON edfi.School.SchoolId = edfi.EducationOrganization.EducationOrganizationId
                  INNER JOIN edfi.EducationOrganizationAddress
                  ON edfi.EducationOrganizationAddress.EducationOrganizationId = edfi.EducationOrganization.EducationOrganizationId
                  WHERE OperationalStatusTypeId = 1 and AddressTypeId = 2
                  ")->result();
    }




    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.School";
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