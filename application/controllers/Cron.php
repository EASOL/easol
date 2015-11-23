<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct () 
    {
        parent::__construct(); 

        if (!$this->input->is_cli_request()) {
            exit('Unathorized Request.');
        }
    }

    public function create_hashes () 
    {            
        set_time_limit(900); // kill after 15 minutes 
        $this->load->library('Easol_Generic_L');

        $students = $this->db->query("SELECT ElectronicMailAddress FROM edfi.StudentElectronicMail")->result();
        foreach ($students as $student)
        {
            $email  = $student->ElectronicMailAddress;
            $hash   = $this->easol_generic_l->encrypt_email($email);

            $exists = $this->db->select("COUNT(*)")
            ->from('easol.EmailLookup')
            ->where('email', $email)
            ->where('HashedEmail', $hash) 
            ->count_all_results();

            if ($exists === 0)
                $this->db->insert('easol.EmailLookup', array('email' => $email, 'HashedEmail' => $hash));
        }
    }        

}
