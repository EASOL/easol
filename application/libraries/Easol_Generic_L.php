<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Easol_Generic_L {

  public function __construct()
  {
    $this->ci =& get_instance();
  }

   // todo:
   // this function should be used when adding/editing easol users to store their email as a hash
   // for use in api requests vs using cron to periodically encrypt user emails.
    public function encrypt_email ($email = "") 
    {
        $a             = $email . 'http://easol-dev.azurewebsites.net';
        $b             = hash('sha256', $a);
        $c             = '$2a$10$'.substr(base64_encode($b),0,22);        
        return crypt($email, $c);
    }    

}