<?php


require_once APPPATH.'/core/Easol_BaseEntity.php';
class Edfi_StaffElectronicMail extends Easol_baseentity {

    /**
     * labels for the database fields
     * @return array
     */
    public function labels()
    {
        return [
            'StaffUSI'              => 'StaffUSI',
            'ElectronicMailTypeId'  => 'Electronic Mail Type Id',
            'ElectronicMailAddress' => 'Electronic Mail Address',
            'PrimaryEmailAddressIndicator'            => 'Primary Email Address Indicator',
            'CreateDate'           => 'Create Date'

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
        return "edfi.staffElectronicMail";
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