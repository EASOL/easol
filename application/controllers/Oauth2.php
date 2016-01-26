<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* .net app redirects login to this controller. 
* user enters easol creds and is validated against the easol db.
* we redirect the browser to a .net server endpoint with the auth code as a get param. 
* the .net server endpoint retrieves the get param and passes it back to us , via scripted post, for exchange for an access code, which we return as json.
* the .net server adds the access code to the .net session for the browser that called the server side post script (eg. the redirect url) 
*/

class Oauth2 extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
        $this->load->helper(array('url', 'form'));

        // Initiate the request handler which deals with $_GET, $_POST, etc
        $request = new League\OAuth2\Server\Util\Request();

        // Initiate a new database connection
        // $db = new League\OAuth2\Server\Storage\PDO\Db('mysql://root:123456@localhost/oauth');
        $db = new League\OAuth2\Server\Storage\PDO\Db('dblib:host=easol,1433;dbname=easol_dev',"easol_dev@ngbivv3p2g","8#rrErBJia26cb@easol");

        exit(var_dump($db));

        // Create the auth server, the three parameters passed are references
        //  to the storage models
        $this->authserver = new League\OAuth2\Server\Authorization(
            new League\OAuth2\Server\Storage\PDO\Client($db),
            new League\OAuth2\Server\Storage\PDO\Session($db),
            new League\OAuth2\Server\Storage\PDO\Scope($db)
        );

        // Enable the authorization code grant type
        $this->authserver->addGrantType(new League\OAuth2\Server\Grant\AuthCode($this->authserver));
    }

    public function index()
    {
        try {

            // Tell the auth server to check the required parameters are in the query string
            $params = $this->authserver->getGrantType('authorization_code')->checkAuthoriseParams();

            // these vars are defined on the server since the server side code (web app) is the "client" and not the browser.
            $this->session->set_userdata('client_id', $params['client_id']);
            $this->session->set_userdata('client_details', $params['client_details']);
            $this->session->set_userdata('redirect_uri', $params['redirect_uri']);
            $this->session->set_userdata('response_type', $params['response_type']);
            $this->session->set_userdata('scopes', $params['scopes']);

            // Redirect the user to the sign-in route
            redirect('/oauth2/signin');

        } catch (Oauth2\Exception\ClientException $e) {
            echo $e->getMessage();
            // Throw an error here which says what the problem is with the
            //  auth params

        } catch (Exception $e) {
            echo $e->getMessage();
            // Throw an error here which has caught a non-library specific error

        }
    }

    public function signin()
    {
        // Retrieve the auth params from the user's session
        $params['client_id'] = $this->session->userdata('client_id');
        $params['client_details'] = $this->session->userdata('client_details');
        $params['redirect_uri'] = $this->session->userdata('redirect_uri');
        $params['response_type'] = $this->session->userdata('response_type');
        $params['scopes'] = $this->session->userdata('scopes');

        // Check that the auth params are all present
        foreach ($params as $key=>$value) {
            if ($value == null) {
                // Throw an error because an auth param is missing - don't
                //  continue any further
                // echo "stop";
                // exit;
            }
        }

        // Process the sign-in form submission
        if ($this->input->post('signin')) {
            try {

                // Get username
                $email = $this->input->post('email');
                if ($email == null || trim($email) == '') {
                    throw new Exception('please enter your email.');
                }

                // Get password
                $password = $this->input->post('password');
                if ($password == null || trim($password) == '') {
                    throw new Exception('please enter your password.');
                }

                // Verify the user's username and password
                //if($oauth_user = $this->_login(array('email' => $email, 'password' => $password))) {
                  //  $this->session->set_userdata('oauth_user', $oauth_user);
                //}
                //else {
                    $this->session->set_userdata('oauth_user', $email);   // remove this after testing.
                //}

            } catch (Exception $e) {
                $params['error_message'] = $e->getMessage();
            }
        }

        // Get the user's ID from their session
        $params['oauth_user'] = $this->session->userdata('oauth_user');

        // User is signed in
        if ($params['oauth_user']) {
            // Redirect the user to /oauth/authorize route
            redirect('/oauth2/authorize');
        }

        // User is not signed in, show the sign-in form
        else {
            echo form_open('/oauth2/signin');
            echo form_label('Email', 'email');
            echo form_input('email', '');
            echo form_label('Password', 'password');
            echo form_password('password', '');
            echo form_submit('signin', 'Sign In!');
            echo form_close();
        }
    }

    public function authorize()
    {
        // init auto_approve for default value
        $params['client_details']['auto_approve'] = 0;

        // Retrieve the auth params from the user's session
        $params['client_id'] = $this->session->userdata('client_id');
        $params['client_details'] = $this->session->userdata('client_details');
        $params['redirect_uri'] = $this->session->userdata('redirect_uri');
        $params['response_type'] = $this->session->userdata('response_type');
        $params['scopes'] = $this->session->userdata('scopes');

        // Check that the auth params are all present
        foreach ($params as $key=>$value) {
            if ($value === null) {
                // Throw an error because an auth param is missing - don't
                //  continue any further
                // echo "stop";
                // exit;
            }
        }

        // Get the user ID
        $params['oauth_user'] = $this->session->userdata('oauth_user');

        // User is not signed in so redirect them to the sign-in route (/oauth/signin)
        if (!$params['oauth_user']) {
            redirect('/oauth2/signin');
        }

        // init autoApprove if in database, value is 0
        $params['client_details']['auto_approve'] = isset($params['client_details']['auto_approve']) ? $params['client_details']['auto_approve'] : 0;

        // Check if the client should be automatically approved
        $autoApprove = ($params['client_details']['auto_approve'] == '1') ? true : false;

        // Process the authorise request if the user's has clicked 'approve' or the client
        if ($this->input->post('approve') == 'yes' || $autoApprove === true) {

            $params['user_id'] = $params['oauth_user'];

            // Generate an authorization code
            $code = $this->authserver->getGrantType('authorization_code')->newAuthoriseRequest('user',   $params['user_id'], $params);

            // Redirect the user back to the client with an authorization code
            $redirect_uri = League\OAuth2\Server\Util\RedirectUri::make(
                $params['redirect_uri'],
                array(
                    'code'  =>  $code,
                    'state' =>  isset($params['state']) ? $params['state'] : ''
                )
            );
            redirect($redirect_uri);
        }

        // If the user has denied the client so redirect them back without an authorization code
        if($this->input->get('deny') != null) {
            $redirect_uri = League\OAuth2\Server\Util\RedirectUri::make(
                $params['redirect_uri'],
                array(
                    'error' =>  'access_denied',
                    'error_message' =>  $this->authserver->getExceptionMessage('access_denied'),
                    'state' =>  isset($params['state']) ? $params['state'] : ''
                )
            );
            redirect($redirect_uri);
        }

        // The client shouldn't automatically be approved and the user hasn't yet
        //  approved it so show them a form
        echo form_open('/oauth2/authorize');
        echo form_submit('approve', 'yes');
        echo form_close();
    }

    public function exchange ()
    {
       /*
        * This is the function that receives the auth code and exchanges that for an access token.
        * Since we will be called from a server side script which will not have a session, we get
        * the client verification info from the client as post data vs session data.
        */

        $_POST['grant_type']    =  'authorization_code';
        $_POST['client_id']     =  $this->input->post('client_id');
        $_POST['client_secret'] =  $this->input->post('client_secret');                                            
        $_POST['redirect_uri']  =  $this->input->post('redirect_uri');
        $_POST['code']          =  $this->input->post('code');
        $_POST['state']         =  $this->input->post('state');    

        $this->access_token();

    }

    private function _login ($data = array())
    {
        $this->load->model('Usermanagement_M');
        $user = $this->Usermanagement_M->getEasolUsers($data['email'], "SEM.ElectronicMailAddress");
        if(is_array($user) and !empty($user)) {
            $this->load->model('entities/easol/Easol_StaffAuthentication');
            $authentication = $this->Easol_StaffAuthentication->findOne(['StaffUSI' => $user[0]->StaffUSI]);
            if($authentication && $authentication->Password == sha1($data['password'])) {
                return $data['email'];
            }
         }
         return false;
    }

    public function access_token()
    {
        try {

            // Tell the auth server to issue an access token
            $response = $this->authserver->issueAccessToken();

        } catch (League\OAuth2\Server\Exception\ClientException $e) {

            // Throw an exception because there was a problem with the client's request
            $response = array(
                'error' =>  $this->authserver->getExceptionType($e->getCode()),
                'error_description' => $e->getMessage()
            );

            // Set the correct header
            header($this->authserver->getExceptionHttpHeaders($this->authserver->getExceptionType($e->getCode())));

        } catch (Exception $e) {

            // Throw an error when a non-library specific exception has been thrown
            $response = array(
                'error' =>  'undefined_error',
                'error_description' => $e->getMessage()
            );
        }

        /*
        * The browser should be watching for this response and when it gets it, process the code however it requires 
        * (most likely send it to the .net server as get/post data so it can be added to the .net session for establishing
        * that the user is logged into the .net app until the .net session expires or the user logs out manually)
        * and redirect back to the appropriate .net app page.
        */

        header('Content-type: application/json');
        echo json_encode($response);
    }
}
