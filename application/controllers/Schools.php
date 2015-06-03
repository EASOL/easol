<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schools extends Easol_Controller {




    /**
     * index action
     */
    public function index()
	{
        $query= $this->db->query(
            "SELECT EducationOrganization.EducationOrganizationId,
                  EducationOrganization.NameOfInstitution, EducationOrganizationAddress.City
                  FROM edfi.EducationOrganization
                  INNER JOIN edfi.School
                  ON edfi.School.SchoolId = edfi.EducationOrganization.EducationOrganizationId
                  INNER JOIN edfi.EducationOrganizationAddress
                  ON edfi.EducationOrganizationAddress.EducationOrganizationId = edfi.EducationOrganization.EducationOrganizationId
                  WHERE OperationalStatusTypeId = 1 and AddressTypeId = 2"
        );

		$this->render("index");
	}
}
