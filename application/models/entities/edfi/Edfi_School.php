<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/2/2015
 * Time: 9:53 PM
 */

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


    /**
     * return table name
     * @return string
     */
    public function getTableName()
    {
        return "edfi.School";
    }

}