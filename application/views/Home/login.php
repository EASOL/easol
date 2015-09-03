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
                        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>
                           &nbsp;<!--<input type="image" src="<?= site_url("/assets/img/google_button.png") ?>" onSignIn value="googLogin" id="googLogin" name="googLogin" class="pull-righ g-signin2" data-onsuccess="onSignIn" /> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
    
    if (auth2.isSignedIn.get()) {
    	    alert('Now logged in via Google');
    }
    
    
    
    
    
      function onSignIn(googleUser) {alert(' is now logged in!');
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log("Name: " + profile.getName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
        alert(profile.getName() + ' is now logged in!');
      };
      onSignIn(googleUser);
    </script>