$(function() {
    $( "#filter-result" ).change(function() {
        $("#filter-form-result").val($( "#filter-result" ).val());
        $( "#dataGridFormFilter").submit();
    });


});

 /* ADDED BY ANWAR BAKSH ON 09/2015 */
 /* GOOGLE SIGN IN: https://developers.google.com/identity/sign-in/ */
      function onSignIn(googleUser) { 
		// Useful data for your client-side scripts:
		var profile = googleUser.getBasicProfile();
		//console.log("ID: " + profile.getId()); // Don't send this directly to your server!
		//console.log("Name: " + profile.getName());
		//console.log("Image URL: " + profile.getImageUrl());
		//console.log("Email: " + profile.getEmail());
		// The ID token you need to pass to your backend:
		
		var id_token = googleUser.getAuthResponse().id_token;
		var uemail = profile.getEmail();
		var name = profile.getName();
		console.log('Attempting Google Sign In');
		console.log("Google Token Recieved: " + id_token);
	
		var localbe = 'http://localhost/easol/';
		var devbe = 'http://easol-dev.azurewebsites.net/';
		var livebe = '';
		var gloginPosturl = devbe;
	      
		var xhr = new XMLHttpRequest();
		xhr.open('POST', gloginPosturl);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		   if(xhr.responseText=="gloginValid") {
		   	   /* GOOD SIGN IN */
			   console.log('Signed in as: ' + profile.getName() );
			   /* alert(profile.getName() + ' is now logged in!');  alert(xhr.responseText);*/ 
			   window.location='student'; 
		   } else {
			   /* FAILED SIGN IN */
			   console.log('Signed In Error: ' + xhr.responseText);
			   document.getElementById('google_ajax_error').innerHTML=xhr.responseText;
			   document.getElementById('google_ajax_error').style.display='block';
		  }
		};
		xhr.send('idtoken=' + id_token + '&uemail=' + uemail);
      }
 //  END SIGN IN
 /* GOOGLE LOGIN - WELL WE NEED TO LOGOUT */
 /* Login button must be on same page as logout button - but hidden  - for this to work */
      function signOut() { console.log('Attempting Google Logout');
	    var auth2 = gapi.auth2.getAuthInstance();
	    auth2.signOut().then(function () {
	      console.log('User signed out.');
	    });         
        console.log('End Google Logout');
      }