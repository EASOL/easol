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