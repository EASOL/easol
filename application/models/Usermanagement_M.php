<?php

class Usermanagement_M extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEasolUsers() {
        /*
        * Get listing of easol users with details from edfi tables for editing/deleting in easol
        * system via the UI.
        */

        $query = "SELECT 
                    ESA.StaffUSI,
                    ESA.GoogleAuth,
                    ERT.RoleTypeName,
                    EFS.FirstName,
                    EFS.MiddleName,
                    EFS.LastSurname,
                    SEM.ElectronicMailAddress
                    FROM easol.StaffAuthentication ESA
                    INNER JOIN easol.RoleType ERT 
                     ON ESA.RoleId = ERT.RoleTypeId 
                    INNER JOIN edfi.Staff EFS 
                     ON ESA.StaffUSI = EFS.StaffUSI
                    INNER JOIN edfi.StaffElectronicMail SEM 
                     ON ESA.StaffUSI = SEM.StaffUSI
                      WHERE SEM.PrimaryEmailAddressIndicator = 1
                ";

        $users = $this->db->query($query)->result();

        foreach ($users as $key => $user) {
            $query = "SELECT 
                        EO.NameOfInstitution
                        FROM edfi.StaffEducationOrganizationEmploymentAssociation SEO
                        INNER JOIN edfi.EducationOrganization EO
                         ON EO.EducationOrganizationId = SEO.EducationOrganizationId
                          WHERE SEO.StaffUSI = '$user->StaffUSI'
                    ";

            $users[$key]->Institutions = $this->db->query($query)->result();
        }
        return $users;
    }

    public function getUserFormData($user = "") {
        $data   = array();

        $query  = "SELECT EducationOrganizationId, NameOfInstitution FROM edfi.EducationOrganization";
        $data['schools'] = $this->db->query($query)->result();

        $query  = "SELECT StaffUSI, FirstName, LastSurname FROM edfi.Staff";
        $data['staff'] = $this->db->query($query)->result();        

        foreach ($data['staff'] as $key => $user) {
            $query = "SELECT
                        EO.EducationOrganizationId, 
                        EO.NameOfInstitution
                        FROM edfi.StaffEducationOrganizationEmploymentAssociation SEO
                        INNER JOIN edfi.EducationOrganization EO
                         ON EO.EducationOrganizationId = SEO.EducationOrganizationId
                          WHERE SEO.StaffUSI = '$user->StaffUSI'
                    ";

            $data['staff'][$key]->Institutions = $this->db->query($query)->result();
        }

        $query  = "SELECT * FROM easol.RoleType";
        $data['roles'] = $this->db->query($query)->result();
        return $data;
    }

    public function addEditEasolUser($user) {

        $query = "";
        $result = $this->db->query($query);
    }

    public function deleteEasolUsers($user) {

        if (is_array($user))
        {
            foreach ($user as $u)
                $this->deleteEasolUsers($u);

            return;
        }

        $query = "DELETE FROM easol.StaffAuthentication WHERE StaffUSI = '$user'";
        $result = $this->db->query($query);
    }
}