<?php

class Usermanagement_M extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEasolUsers($user = "") {
        /*
        * Get listing of easol users with details from edfi tables for editing/deleting in easol
        * system via the UI.
        */

         $where = (!empty($user)) ? "WHERE EFS.StaffUSI = '$user' AND SEM.PrimaryEmailAddressIndicator = '1'" : "WHERE SEM.PrimaryEmailAddressIndicator = '1'";       

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
                      $where
                ";

        $users = $this->db->query($query)->result();

        foreach ($users as $key => $user) {
            $query = "SELECT 
                        EO.EducationOrganizationId, EO.NameOfInstitution
                        FROM edfi.StaffEducationOrganizationEmploymentAssociation SEO
                        INNER JOIN edfi.EducationOrganization EO
                         ON EO.EducationOrganizationId = SEO.EducationOrganizationId
                          WHERE SEO.StaffUSI = '$user->StaffUSI'
                    ";

            $users[$key]->Institutions = $this->db->query($query)->result();
        }
        return $users;
    }

    public function getEdfiUsers($user = "") {
        /*
        * Get listing of edfi users with details from edfi tables for use in easol
        * system via the UI.
        */

        $where = (!empty($user)) ? "WHERE EFS.StaffUSI = '$user' AND SEM.PrimaryEmailAddressIndicator = '1'" : "WHERE SEM.PrimaryEmailAddressIndicator = '1'";

        $query = "SELECT 
                    EFS.StaffUSI,
                    EFS.FirstName,
                    EFS.MiddleName,
                    EFS.LastSurname,
                    SEM.ElectronicMailAddress
                    FROM edfi.Staff EFS
                    INNER JOIN edfi.StaffElectronicMail SEM 
                     ON ESA.StaffUSI = SEM.StaffUSI
                      $where
                ";

        $users = $this->db->query($query)->result();

        foreach ($users as $key => $user) {
            $query = "SELECT 
                        EO.EducationOrganizationId, EO.NameOfInstitution
                        FROM edfi.StaffEducationOrganizationEmploymentAssociation SEO
                        INNER JOIN edfi.EducationOrganization EO
                         ON EO.EducationOrganizationId = SEO.EducationOrganizationId
                          WHERE SEO.StaffUSI = '$user->StaffUSI'
                    ";

            $users[$key]->Institutions = $this->db->query($query)->result();
        }
        return $users;
    }

    public function getUserFormData($user = "") 
    {
        $userData   = array();

        if (!empty($user))
        {
            // Get the Easol user if they are in the Easol db.
            $userData = $this->getEasolUsers($user);
            if (empty($userData))
                // Get the EDFI user. 
                $userData = $this->getEdfiUsers($user);
        }

        if (empty($user) or empty($userData))
        {
            $query  = "SELECT EducationOrganizationId, NameOfInstitution FROM edfi.EducationOrganization";
            $userData['schools'] = $this->db->query($query)->result();

            $query  = "SELECT StaffUSI, FirstName, LastSurname FROM edfi.Staff";
            $userData['staff'] = $this->db->query($query)->result();        

            foreach ($userData['staff'] as $key => $user) {
                $query = "SELECT
                            EO.EducationOrganizationId, 
                            EO.NameOfInstitution
                            FROM edfi.StaffEducationOrganizationEmploymentAssociation SEO
                            INNER JOIN edfi.EducationOrganization EO
                             ON EO.EducationOrganizationId = SEO.EducationOrganizationId
                              WHERE SEO.StaffUSI = '$user->StaffUSI'
                        ";

                $userData['staff'][$key]->Institutions = $this->db->query($query)->result();
            }
        }
 
        // We get the full list of roles in all cases because they are options for new and existing users.
        // Only existing users use their role id with the roles array to default to their current role.
        $query  = "SELECT * FROM easol.RoleType";
        $userData['roles'] = $this->db->query($query)->result();

        if (isset($userData[0]->RoleTypeName)) {
            foreach($userData['roles'] as $role) {
                if ($userData[0]->RoleTypeName == $role->RoleTypeName) {
                    $userData[0]->Role = $role;
                    break;
                }
            }
        }

        return $userData;
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