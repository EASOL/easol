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