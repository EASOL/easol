<?php
/**

 */

class External_Auth extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    /**
     * return true if the google sign in token is valid
     * @return bool
     */
    public static function validate_google_token($useremail, $gidtoken, $environment){
    	    //$token = "eyJhbGciOiJSUzI1NiIsImtpZCI6IjE1OGVkZTMwYzQzZTVhOGEyMDQ3ZGNhZGQwMWViNWY2YmMzYjI3MmIifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiYXRfaGFzaCI6InRXY0Z4ajJmLTZ6NUJ3V0wtVWgwZnciLCJhdWQiOiIxMDQ2NTUwNzAyMDUwLW9yOTF2NjVqbTcybW1kdjh0amVzZWhtM3FicTNkNG9sLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwic3ViIjoiMTE0Mjc3NDE1ODIyNDExMjQwNjI3IiwiZW1haWxfdmVyaWZpZWQiOnRydWUsImF6cCI6IjEwNDY1NTA3MDIwNTAtb3I5MXY2NWptNzJtbWR2OHRqZXNlaG0zcWJxM2Q0b2wuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJlbWFpbCI6InByb0B3ZWJkZXZzdGFyLmNvbSIsImlhdCI6MTQ0MTczNjA4MiwiZXhwIjoxNDQxNzM5NjgyLCJuYW1lIjoiTXIuIEJha3NoIiwiZ2l2ZW5fbmFtZSI6Ik1yLiIsImZhbWlseV9uYW1lIjoiQmFrc2giLCJsb2NhbGUiOiJlbiJ9.s_8hciY5pB6b6uNmituHYFahQ29z2iVy43rRVjiTdVmTyAoK9MOL0vvbfRRwL1UlePC0USehBjD66QRxIVb13jqjGPeTehANtFJb5GOB4wG-x2MTN4eG5VoEsjHLHQ2D8m6baszlfElyhQCEmuL6GSL5-Knn3DmyeOI0ZZuYNHs8vZpNzh8-r8OX2Xghji-qidvMf21n8Q3Vc5n2SzfeRKH7jJsVckD3V5wMZpUnrt3l0RMem3jWnHQOwnBtEPLetG48tajMyTJRTeJdY-zb_q-eu0SdoGpzBbsR9raDv_n8bD80W7-rcNeKmC7-pIW-pfsTnrhHPm-iuFjeJgl_bg";
    	    $token = $gidtoken;
    	    $verifyurl="https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=$token";
    	    
    	    // is cURL installed yet?
	    if (!function_exists('curl_init')){die('Sorry cURL is not installed!');}

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $verifyurl);
	    curl_setopt($ch, CURLOPT_REFERER, $environment); //"http://localhost"
	    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); //"Mozilla/5.0 (Windows NT 6.1; rv:37.0) Gecko/20100101 Firefox/37.0"
	    // Include header in result? (0 = yes, 1 = no)
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    // Should cURL return or print out the data? (true = return, false = print)
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

	    $output = curl_exec($ch);
	    if($output === false) {
		    //echo 'Curl error: ' . curl_error($ch);
		    return "Problem logging you in: Please contact support";
	    } else {
		    // curl request good
		    // Close the cURL resource, and free system resources
		    curl_close($ch);
		    $tokarray = json_decode( $output ); //converts it to an object  - not array
		    //echo $tokarray->error_description;
		    //echo $output;
		    if( isset($tokarray->error_description) && $tokarray->error_description=="Invalid Value" ) { return "Invalid Value"; }
		    $goodg = 'yes';
		    if(isset($tokarray->iss) && $tokarray->iss=="accounts.google.com") { } else { $goodg = 'no'; }
		    if(isset($tokarray->aud) && $tokarray->aud=="1046550702050-or91v65jm72mmdv8tjesehm3qbq3d4ol.apps.googleusercontent.com") {} else { $goodg = 'no'; }
		    
		    if( isset($tokarray->email) && $tokarray->email==$useremail && $tokarray->email_verified=="true") { } else { $goodg = 'no'; }
		    
		    if($goodg == 'yes') { return 'valid'; } else { return "Invalid Value"; /* var_dump($tokarray); */ }
	    }   

    }


}