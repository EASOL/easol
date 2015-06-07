<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schools extends Easol_Controller {




    /**
     * index action
     */
    public function index($id=1)
	{

        $this->authorize(['System Administrator','Data Administrator']);
        /*
        $schoolQuery= $this->db->query(
            "SELECT EducationOrganization.EducationOrganizationId,
                  EducationOrganization.NameOfInstitution, EducationOrganizationAddress.City
                  FROM edfi.EducationOrganization
                  INNER JOIN edfi.School
                  ON edfi.School.SchoolId = edfi.EducationOrganization.EducationOrganizationId
                  INNER JOIN edfi.EducationOrganizationAddress
                  ON edfi.EducationOrganizationAddress.EducationOrganizationId = edfi.EducationOrganization.EducationOrganizationId
                  WHERE OperationalStatusTypeId = 1 and AddressTypeId = 2"
        );
        */

        $query= "SELECT EducationOrganization.EducationOrganizationId,
                  EducationOrganization.NameOfInstitution, EducationOrganizationAddress.City
                  FROM edfi.EducationOrganization
                  INNER JOIN edfi.School
                  ON edfi.School.SchoolId = edfi.EducationOrganization.EducationOrganizationId
                  INNER JOIN edfi.EducationOrganizationAddress
                  ON edfi.EducationOrganizationAddress.EducationOrganizationId = edfi.EducationOrganization.EducationOrganizationId
                  WHERE OperationalStatusTypeId = 1 and AddressTypeId = 2
                  ";

        $totalCount=$this->db->query(
            "SELECT COUNT (*) as tot
                  FROM edfi.EducationOrganization
                  INNER JOIN edfi.School
                  ON edfi.School.SchoolId = edfi.EducationOrganization.EducationOrganizationId
                  INNER JOIN edfi.EducationOrganizationAddress
                  ON edfi.EducationOrganizationAddress.EducationOrganizationId = edfi.EducationOrganization.EducationOrganizationId
                  WHERE OperationalStatusTypeId = 1 and AddressTypeId = 2"
        )->row();

       // die(print_r($totalCount));


		$this->render("index",[
            'query' => $query,
            'pagination'  =>
            [
                'totalElements' => $totalCount->tot,
                'pageSize' => 2,
                'currentPage' => $id,
                'url'   =>  'schools/index/@pageNo'
            ]
        ]);
	}
}
