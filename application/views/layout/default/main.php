<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $title ?></title>

    <?php assets_lib('chardinjs'); ?>
    <?php assets_lib('datatables'); ?>    
    <?php assets_lib('nvd3'); ?>
    <?php assets_widget('charts'); ?>
    <?php assets_widget('tables'); ?>

    <?php $this->carabiner->css('lib/bootstrap-3.3.6/dist/css/bootstrap.css'); ?>    
    <?php $this->carabiner->css('//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css'); ?>
    
   
    <?php foreach ($GLOBALS['css'] as $file): ?>
        <?php $this->carabiner->css("$file"); ?>
    <?php endforeach; ?>

    <?php $this->carabiner->css('css/custom-styles2.css?v=2'); ?>


    <?php foreach ($GLOBALS['widget'] as $widget): ?>
        <?php if (!file_exists(FCPATH."/assets/widgets/$widget/{$widget}.css")) continue; ?>
        <?php $this->carabiner->css("widgets/$widget/{$widget}.css"); ?>
    <?php endforeach; ?>

    <?php if (file_exists(FCPATH."/assets/css/views/{$this->router->fetch_class()}.css")): ?>
        <?php $this->carabiner->css('css/views/'.$this->router->fetch_class().'.css'); ?>
    <?php endif; ?>

    <?php $this->carabiner->css('css/custom-styles2.css?v=2'); ?> 
    <?php $this->carabiner->display('css'); ?>  
    
    <script type="text/javascript">
        var Easol_SiteUrl = "<?= site_url('/') ?>"
    </script>


    <?php if (system_google_auth_enabled()): ?>
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id" content="<?php echo system_google_auth_app_id() ?>.apps.googleusercontent.com">
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    <?php endif; ?>

   
</head>
<body>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="logo-header">
                <a class="navbar-brand" href="<?= site_url("/") ?>">
                    <img class="center-block" src="<?= site_url("assets/img/easollogo.png") ?>"/>
                </a>
            </div>
            <div class="collapse navbar-collapse sidebar-collapse menu-collapse">
                <?php if(Easol_Auth::isLoggedIn() && Easol_Auth::userdata('SchoolId')!=false) : ?>
                    <ul class="nav" id="main-menu">
                        <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])):  ?>
                            <li class="visible-xs-block">
                                <form class="navbar-form" action="<?= site_url("schools/choose") ?>" method="post">
                                    <select name="school" class="form-control" onchange="this.form.submit()">
                                        <?php  foreach($this->Edfi_School->getAllSchools() as $school):  ?>
                                            <option value="<?= $school->EducationOrganizationId ?>" <?= (Easol_Auth::userdata("SchoolId")==$school->EducationOrganizationId) ? "selected" : "" ?>><?= $school->NameOfInstitution ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
                            </li>
                        <?php  elseif(Easol_Auth::userdata('SchoolName')): ?>
                            <li class="visible-xs-block"><p class="navbar-text"><?= Easol_Auth::userdata('SchoolName') ?></p></li>
                        <?php endif; ?>

                        <?php foreach (menu_items() as $slug=>$item): ?>

                            <?php
                            if (!empty($item['submenu'])) {
                                $skip = true;
                                foreach ($item['submenu'] as $submenu_slug => $submenu_item) {
                                    if (empty($submenu_item['auth'])) $submenu_item['auth'] = $item['auth'];

                                    if (!empty($submenu_item['auth']) && Easol_AuthorizationRoles::hasAccess($submenu_item['auth'], $submenu_slug)) {
                                        $skip = false;
                                    }
                                }
                            }

                            if ($skip) continue;
                            ?>



                            <?php if ($item['type'] == 'group'): ?>

                                <div <?php echo (isset($item['attr'])) ? $item['attr'] : '' ?>>
                                    <?php foreach ($item['items'] as $sub_slug=>$group_item): ?>
								        <?php $this->load->view('layout/default/_menu_item', ['item'=>$group_item, 'slug'=>$sub_slug]); ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <?php $this->load->view('layout/default/_menu_item', ['item' => $item, 'slug' => $slug]); ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <li <?= ($this->router->class=="admin") ? 'class="active-menu visible-xs-block"' : 'class="visible-xs-block"' ?>>
                            <a href="<?= site_url("/admin") ?>"><i class="fa fa-cog"></i> Administration</a>
                        </li>

                        <?php if(Easol_Auth::isLoggedIn()): ?>
                            <li class="visible-xs-block">
                                <a href="<?= site_url("/home/logout") ?>" onClick="signOut();"><i class="fa fa-user"></i> Logout</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
    </div>

    <!--/. NAV TOP  -->
    <div id="navbar-wrapper">
        <nav class="navbar navbar-default navbar-top" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <?php if(Easol_Auth::isLoggedIn() && Easol_Auth::userdata('SchoolId')!=false) { ?>
                <ul class="nav navbar-nav navbar-top-links navbar-right hidden-xs">
                    <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) {  ?>
                        <li><form class="navbar-form" action="<?= site_url("schools/choose") ?>" method="post">
                                <select name="school" class="form-control" onChange="this.form.submit()">
                                    <?php  foreach($this->Edfi_School->getAllSchools() as $school){  ?>
                                        <option value="<?= $school->EducationOrganizationId ?>" <?= (Easol_Auth::userdata("SchoolId")==$school->EducationOrganizationId) ? "selected" : "" ?>><?= $school->NameOfInstitution ?></option>
                                    <?php } ?>
                                </select>
                            </form></li>
                    <?php } elseif(Easol_Auth::userdata('SchoolName')){ ?>
                        <li><p class="navbar-text"><?= Easol_Auth::userdata('SchoolName') ?></p></li>
                    <?php } ?>

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <?php if($this->session->userdata('logged_in')== true)
                            { ?>
                                <li>
                                    <a href="<?= site_url("/home/logout") ?>" onClick="signOut();">Logout</a>
                                </li>
                            <?php } ?>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
            <?php } ?>
        </nav>
    </div>



    <div id="page-wrapper">
        <div id="page-inner">
            <!-- Show flashdata messages for general confirmation/error messages -->
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?php echo $error ?></div>
            <?php }else if (!empty($success)) { ?>
                <div class="alert alert-success"><?php echo $success ?></div>
            <?php } ?>
            <?= $content ?>
            <div class="row">
                <div class="col-md-8 col-sm-8 txt-annotation">
                    This computer system is the property of the the Center of Education Innovation. It is for authorized
                    use only.
                    Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
                </div>

            </div>
        </div>
    </div>

    <footer></footer>
</div>
<!-- /. WRAPPER  -->

<div id="loading-img" style="background: url(<?= site_url("assets/img/loading2.gif") ?>) no-repeat; position: fixed; bottom: 5px;right:5px; height: 11px;width: 43px;display: none">&nbsp;</div>
<?php if (system_google_auth_enabled()): ?>
    <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" style="display:none"></div>
<?php endif; ?>


<?php $this->carabiner->js('//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.js'); ?>
<?php $this->carabiner->js('lib/bootstrap-3.3.6/dist/js/bootstrap.js'); ?>
<?php $this->carabiner->js('lib/js.cookie-2.0.4.js'); ?>
<?php $this->carabiner->js('lib/jquery.metisMenu.js'); ?>

<?php $this->carabiner->js('js/custom.js') ?>
<?php $this->carabiner->js('/js/layout.js') ?>

<?php foreach ($GLOBALS['js'] as $file): ?>
    <?php if (!file_exists(FCPATH."/assets/$file")) continue; ?>
    <?php $this->carabiner->js("$file"); ?>
<?php endforeach; ?>

<?php foreach ($GLOBALS['widget'] as $widget): ?>
    <?php if (!file_exists(FCPATH."/assets/widgets/$widget/{$widget}.js")) continue; ?>
    <?php $this->carabiner->js("widgets/$widget/{$widget}.js"); ?>
<?php endforeach; ?>

<?php if (file_exists(FCPATH."/assets/js/views/{$this->router->fetch_class()}.js")): ?>
    <?php $this->carabiner->js("js/views/{$this->router->fetch_class()}.js"); ?>
<?php endif; ?>

<?php if (file_exists(FCPATH."/assets/js/views/{$this->router->fetch_class()}/{$this->router->fetch_method()}.js")): ?>
    <?php $this->carabiner->js("js/views/{$this->router->fetch_class()}/{$this->router->fetch_method()}.js"); ?>
<?php endif; ?>

<?php $this->carabiner->display('js'); ?>


</body>
</html>
