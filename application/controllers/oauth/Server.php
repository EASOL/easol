<?php

class Server extends CI_Controller 
{

	function __construct ()
	{
		parent::__construct();

		// error reporting (this is a demo, after all!)
		ini_set('display_errors',1);error_reporting(E_ALL);

		// Autoloading (composer is preferred, but for this example let's just do this)
		require_once(APPPATH.'third_party/oauth2-server-php/src/OAuth2/Autoloader.php');
		OAuth2\Autoloader::register();

	}

	function index ()
	{
		// $dsn is the Data Source Name for your database, for exmaple "mysql:dbname=my_oauth2_db;host=localhost"
		$storage = new OAuth2\Storage\Pdo(array('dsn' => 'sqlsrv:Server=oqc2uoyejf.database.windows.net,1433;Database=easol_dev', 'username' => 'easol_dev_dba@oqc2uoyejf', 'password' => '%Z!A8iVnH6e$OKMk'));

		// Pass a storage object or array of storage objects to the OAuth2 server class
		$server = new OAuth2\Server($storage);

		// Add the "Client Credentials" grant type (it is the simplest of the grant types)
		$server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

		// Add the "Authorization Code" grant type (this is where the oauth magic happens)
		$server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

	}

}