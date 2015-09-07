<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">EASOL Login</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                if(isset($message)){
                    echo '<div class="alert alert-danger">'.$message.'</div>';
                }
                ?>
                <div class="alert alert-danger" id="google_ajax_error"></div>
                <form method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3">Username:</label>
                        <div class="col-md-4 col-sm-8">
                            <input type="text" id="login" class="form-control" name="login[username]" value="<?= $this->input->post('login[username]') ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-1 col-sm-3">Password:</label>
                        <div class="col-md-4 col-sm-8">
                            <input class="form-control" type="password" name="login[password]"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5 col-sm-11">
                            <button class="btn btn-primary pull-right" type="submit">Login</button>
                        </div>
                        <div class='altSIbox'>
                        <div class="g-signin2 pull-right" data-onsuccess="onSignIn" data-theme="dark"></div>
                           &nbsp;<!--<input type="image" src="<?= site_url("/assets/img/google_button.png") ?>" onSignIn value="googLogin" id="googLogin" name="googLogin" class="pull-righ g-signin2" data-onsuccess="onSignIn" /> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script text="text/javascript">
      function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        //console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        //console.log("Name: " + profile.getName());
        //console.log("Image URL: " + profile.getImageUrl());
        //console.log("Email: " + profile.getEmail());
        // The ID token you need to pass to your backend:
        console.log("ID Token: " + id_token);
        
        var id_token = googleUser.getAuthResponse().id_token;
        var uemail = profile.getEmail();
        var name = profile.getName();
        
              	var localbe = 'http://localhost/easol/';
      	        var devbe = 'http://easol-dev.azurewebsites.net/';
      	        var livebe = '';
      	        var gloginPosturl = devbe;
      	      
      	        var xhr = new XMLHttpRequest();
		xhr.open('POST', gloginPosturl);
		xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xhr.onload = function() {
		   console.log('Signed in as: ' + xhr.responseText);
		   if(xhr.responseText=="gloginValid") { /* alert(profile.getName() + ' is now logged in!');  alert(xhr.responseText);*/ window.location='/student'; } else {
		   document.getElementById('google_ajax_error').innerHTML=xhr.responseText;
		   document.getElementById('google_ajax_error').style.display='block';
		  }
		};
		xhr.send('idtoken=' + id_token + '&uemail=' + uemail);
      };
    </script>