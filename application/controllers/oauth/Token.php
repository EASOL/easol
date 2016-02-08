<?php

class Token extends CI_Controller 
{

	function __construct ()
	{
		parent::__construct();

		// Autoloading
		require_once(APPPATH.'third_party/oauth2-server-php/src/OAuth2/Autoloader.php');
		OAuth2\Autoloader::register();

		$config = array(
            'client_table' 			=> 'EASOL.oauth_clients',
            'access_token_table' 	=> 'EASOL.oauth_access_tokens',
            'refresh_token_table' 	=> 'EASOL.oauth_refresh_tokens',
            'code_table' 			=> 'EASOL.oauth_authorization_codes',
            'user_table' 			=> 'EASOL.oauth_users',
            'jwt_table'  			=> 'EASOL.oauth_jwt',
            'jti_table'  			=> 'EASOL.oauth_jti',
            'scope_table'  			=> 'EASOL.oauth_scopes',
            'public_key_table'  	=> 'EASOL.oauth_public_keys',
        );

		// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
		$storage = new OAuth2\Storage\Pdo(array('dsn' => 'sqlsrv:Server='.EASOL_DB_SERVER.',1433;Database='.EASOL_DB_NAME, 'username' => EASOL_DB_USER, 'password' => EASOL_DB_PASS), $config);

		// Pass a storage object or array of storage objects to the OAuth2 server class
		$this->server = new OAuth2\Server($storage);

		// Add the "Client Credentials" grant type (it is the simplest of the grant types)
		$this->server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));	
	}

	function index ()
	{
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');

		// client collects login credentials and posts them here along with the client details.

		if (!empty($email) and !empty($password)) {

			// Verify the user's username and password
	        if($this->_login(array('email' => $email, 'password' => $password))) {
				// Handle a request for an OAuth2.0 Access Token and send the response to the client
				return $this->server->handleTokenRequest(OAuth2\Request::createFromGlobals())->send();
	        }
	    }

		exit(json_encode(array( 'error' 				=> 'login invalid',
								'error_description'		=> 'The email and/or password is invalid.'
						))
		);

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

    function verify ()
    {
    	// Handle a request to a resource and authenticate the access token
		if (!$this->server->verifyResourceRequest(OAuth2\Request::createFromGlobals())) {
    		return $this->server->getResponse()->send();
		}

		echo json_encode(array('success' => true, 'message' => 'verified'));
    }

}