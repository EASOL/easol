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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>