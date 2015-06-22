<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">EASOL Login</h1>
        <br/><br/>
    </div>
</div>
<?php
if(isset($message)){
    echo '<div class="alert alert-danger">'.$message.'</div>';
}
?>
<form method="post">
    <div class="row">

        <div class="col-md-2">
            Username:
        </div>
        <div class="col-md-10">
            <input type="text" name="login[username]" value="<?= $this->input->post('login[username]') ?>"/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            Password:
        </div>
        <div class="col-md-10">
            <input type="password" name="login[password]"/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
            <br/>
            <input type="submit" value="Login"/>
        </div>
    </div>
</form>
<br/><br/><br/><br/>