<?php
/**

 */

class External_Auth extends CI_Model {

    //protected static $loggedIn = false;
    //private static $userInfo=[];


    public function __construct(){
    	    /*
        self::$userInfo=$this->session->userdata();
        if($this->session->userdata('logged_in')== true)
        {
            self::$userInfo['__ci_last_regenerate']=time();
            $this->session->set_userdata(self::$userInfo);
            self::$loggedIn=true;
        }
        */

        parent::__construct();

    }

    /**
     * return true if the google sign in token is valid
     * @return bool
     */
    public static function validate_google_token(){
    	    $token = $_REQUEST['idtoken'];
    	    $verifyurl="https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=$token";
    	    //"eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1OGVkZTMwYzQzZTVhOGEyMDQ3ZGNhZGQwMWViNWY2YmMzYjI3MmIifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXRfaGFzaCI6InRXY0Z4ajJmLTZ6NUJ3V0wtVWgwZnciLCJhdWQiOiIxMDQ2NTUwNzAyMDUwLW9yOTF2NjVqbTcybW1kdjh0amVzZWhtM3FicTNkNG9sLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwic3ViIjoiMTE0Mjc3NDE1ODIyNDExMjQwNjI3IiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF6cCI6IjEwNDY1NTA3MDIwNTAtb3I5MXY2NWptNzJtbWR2OHRqZXNlaG0zcWJxM2Q0b2wuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJlbWFpbCI6InByb0B3ZWJkZXZzdGFyLmNvbSIsImlhdCI6MTQ0MTczNjA4MiwiZXhwIjoxNDQxNzM5NjgyLCJuYW1lIjoiTXIuIEJha3NoIiwiZ2l2ZW5fbmFtZSI6Ik1yLiIsImZhbWlseV9uYW1lIjoiQmFrc2giLCJsb2NhbGUiOiJlbiJ9.s_8hciY5pB6b6uNmituHYFahQ29z2iVy43rRVjiTdVmTyAoK9MOL0vvbfRRwL1UlePC0USehBjD66QRxIVb13jqjGPeTehANtFJb5GOB4wG-x2MTN4eG5VoEsjHLHQ2D8m6baszlfElyhQCEmuL6GSL5-Knn3DmyeOI0ZZuYNHs8vZpNzh8-r8OX2Xghji-qidvMf21n8Q3Vc5n2SzfeRKH7jJsVckD3V5wMZpUnrt3l0RMem3jWnHQOwnBtEPLetG48tajMyTJRTeJdY-zb_q-eu0SdoGpzBbsR9raDv_n8bD80W7-rcNeKmC7-pIW-pfsTnrhHPm-iuFjeJgl_bg"
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => $verifyurl,
		    CURLOPT_USERAGENT => 'Easol Dev Test'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);
		$resp_array = json_decode($resp);
		echo $resp;
		//var_dump($resp_array);
		//echo json_decode($resp);
		$go='no';
		// if($resp_array['']=="") {$go='yes';} else {$go='no';}
		if($resp_array['iss']=="accounts.google.com") {$go='yes';} else {$go='no';}
		if($resp_array['aud']=="1046550702050-or91v65jm72mmdv8tjesehm3qbq3d4ol.apps.googleusercontent.com") { $go='yes';  } else {$go='no';}
		//if($resp_array['']=="") {$go='yes';} else {$go='no';}
		
		/* {
		 "iss": "accounts.google.com",
		 "at_hash": "tWcFxj2f-6z5BwWL-Uh0fw",
		 "aud": "1046550702050-or91v65jm72mmdv8tjesehm3qbq3d4ol.apps.googleusercontent.com",
		 "sub": "114277415822411240627",
		 "email_verified": "true",
		 "azp": "1046550702050-or91v65jm72mmdv8tjesehm3qbq3d4ol.apps.googleusercontent.com",
		 "email": "pro@webdevstar.com",
		 "iat": "1441736082",
		 "exp": "1441739682",
		 "name": "Mr. Baksh",
		 "given_name": "Mr.",
		 "family_name": "Baksh",
		 "locale": "en",
		 "alg": "RS256",
		 "kid": "158ede30c43e5a8a2047dcadd01eb5f6bc3b272b"
		} */
    }

    /**
     * Userdata
     * @param string $field
     * @return mixed
     */
    public static function userdata($field=""){


        if($field=="")
            return self::$userInfo;
        if(array_key_exists($field,self::$userInfo)){
            return self::$userInfo[$field];
        }

        return false;
    }



}