<?php

class Schoolmanagement_M extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function getSchools($school = "") {

        $where = (!empty($school)) ? "WHERE SC.SchoolId = '$school'" : '';       

        $query = "SELECT SC.SchoolId, EO.WebSite, EO.NameOfInstitution FROM edfi.EducationOrganization EO
                    INNER JOIN edfi.School SC
                    ON
                    EO.EducationOrganizationId = SC.SchoolId
                    $where
                ";              

        $schools = $this->db->query($query)->result();
        return $schools;
    }

    public function getSchoolDetails($school = "") {

        $results = array();
        $results['school'] = $this->getSchools($school);

        $query = "SELECT * FROM easol.SchoolConfiguration WHERE EducationOrganizationId = '$school' ";
        $results['details'] = $this->db->query($query)->result();
        
        return $results;
    }

    public function setSchoolDetails($school = '', $post = array()) {

        $delete = (isset($post['delete'])) ? $post['delete'] : array();
        unset($post['delete']);

        foreach ($delete as $k => $v)
        {
            $sql = "DELETE FROM easol.SchoolConfiguration WHERE [Key]='$v' AND EducationOrganizationId='$school'";
            $result = $this->db->query($sql);
            if ($result and isset($post[$v]))
                unset($post[$v]);
        }        

        foreach ($post as $k => $v)
        {
            $sql = "UPDATE easol.SchoolConfiguration SET Value='$v' WHERE [Key]='$k' AND EducationOrganizationId='$school'";
            $result = $this->db->query($sql);
        }
        return $result;
    }

   public function addSchoolDetails($school = '', $post = array()) {

        $key    = (isset($post['key'])) ? $post['key'] : '';
        $value  = (isset($post['value'])) ? $post['value'] : '';

            $sql = "INSERT INTO easol.SchoolConfiguration (EducationOrganizationId,[Key],[Value]) VALUES('$school','$key','$value')";
            $result = $this->db->query($sql);

        return $result;
    }

    public function getTermTypes() {

        $query = "SELECT * FROM edfi.TermType";
        $results = $this->db->query($query)->result();
        return $results;
    }        
}