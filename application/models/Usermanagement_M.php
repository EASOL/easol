<?php

class Usermanagement_M extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getEasolUsers($user = "", $key = "EFS.StaffUSI") {
        /*
        * Get listing of easol users with details from edfi tables for editing/deleting in easol
        * system via the UI.
        */

        $where = (!empty($user)) ? "WHERE $key = '$user' AND SEM.PrimaryEmailAddressIndicator = '1'" : "WHERE SEM.PrimaryEmailAddressIndicator = '1'";       

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
        $order = "ORDER BY EFS.LastSurname ASC";

        $query = "SELECT 
                    EFS.StaffUSI,
                    EFS.FirstName,
                    EFS.MiddleName,
                    EFS.LastSurname,
                    SEM.ElectronicMailAddress
                    FROM edfi.Staff EFS
                    INNER JOIN edfi.StaffElectronicMail SEM 
                     ON EFS.StaffUSI = SEM.StaffUSI
                      $where
                      $order
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
            $query = "SELECT 
                        EducationOrganizationId, NameOfInstitution FROM edfi.EducationOrganization EO
                        INNER JOIN edfi.School SC
                        ON EO.EducationOrganizationId = SC.SchoolId
                    ";

            $userData['schools'] = $this->db->query($query)->result();

            $userData['staff'] = $this->getEdfiUsers();
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

    public function addEditEasolUser($post) {
        // unset and post data that does not get sent to the db.
        unset($post['school']);
       

        $post['LastModifiedDate'] = date('Y-m-d G:i:s');

        // If GoogleAuth was unchecked lets setup the missing GoogleAuth value.
        if (!isset($post['GoogleAuth']))
            $post['GoogleAuth'] = '0';

        // store any password values regardless of the GoogleAuth value.
        if (!empty($post['Password'])) {
            // Encrypt the password here using the same method as the auth library.
            $post['Password'] = sha1($post['Password']);
        }
        else {
            // If they use password authentication and didnt enter a password then leave their db password unchanged.
            unset($post['Password']);
        }
        if(@$post['newuser'] and !isset($post['Password'])){
            $post['Password'] = "";
        }
        unset($post['newuser']);
        // exit(var_dump($post));

        // See whether we are running an insert or an update
        $user = $this->db->where('StaffUSI', $post['StaffUSI'])->get('easol.StaffAuthentication')->result();
        if(empty($user)) {
            $post['CreateDate'] = date('Y-m-d G:i:s');
            $result = $this->db->insert('easol.StaffAuthentication', $post);
        }else {
            $result = $this->db->where('StaffUSI', $post['StaffUSI'])->update('easol.StaffAuthentication', $post);
        }

        // If there was no error then re-fetch the saved user values from the db to show as defaults when
        // we reload the form with the success message.
        if ($result)
            return $this->getUserFormData($post['StaffUSI']);

        // else return the boolen fail to the controller for error reporting.
        return $result;
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