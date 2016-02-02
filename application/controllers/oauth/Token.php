<?php

class Token extends CI_Controller 
{

	function __construct ()
	{
		parent::__construct();

		// Autoloading
		require_once(APPPATH.'third_party/oauth2-server-php/src/OAuth2/Autoloader.php');
		OAuth2\Autoloader::register();

		// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
		$storage = new OAuth2\Storage\Pdo(array('dsn' => 'sqlsrv:Server=oqc2uoyejf.database.windows.net,1433;Database=easol_dev', 'username' => 'easol_dev_dba@oqc2uoyejf', 'password' => '%Z!A8iVnH6e$OKMk'));

		// Pass a storage object or array of storage objects to the OAuth2 server class
		$this->server = new OAuth2\Server($storage);

		// Add the "Client Credentials" grant type (it is the simplest of the grant types)
		$this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));		

		// Add the "Authorization Code" grant type (this is where the oauth magic happens)
		// $this->server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));		

	}

	function index ()
	{
		$email 		= $this->input->post('email', NULL);
		$password 	= $this->input->post('password', NULL);

		// client collects login credentials and posts them here along with the client details.
		// we attempt to validate the user and:
		// error   : simply redirect the browser back to the sender url with an error message in the post for display.
		// success : send the access code to a designated url at the client where it is processed to create the session on the client.  

		if ($email and $password) {

			// Verify the user's username and password
	        //if($this->_login(array('email' => $email, 'password' => $password))) {
				// Handle a request for an OAuth2.0 Access Token and send the response to the client
				$this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
	        //}
	        //else {
				// redirect();
	        //}

		} else {
			// redirect();
		}

		// verification: if the client wants to verify that the code is not an arbitrary code as a forgery then they can simply
		// test the code for verification at the resource server Resource.php
		// This can also be used to check if the code has expired in case the client cares.
	}

    private function _login ($data = array())
    {
        $this->load->model('Usermanagement_M');
        $user = $this->Usermanagement_M->getEasolUsers($data['email'], "SEM.ElectronicMailAddress");
        if(is_array($user) and !empty($user)) {
            $this->load->model('entities/easol/Easol_StaffAuthentication');
            $authentication = $this->Easol_StaffAuthentication->findOne(['StaffUSI' => $user[0]->StaffUSI]);
            if($authentication && $authentication->Password == sha1($data['password'])) {
                return true;
            }
         }
         return false;
    }

}