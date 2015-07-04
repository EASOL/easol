<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/1/2015
 * Time: 11:39 PM
 */
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $title ?></title>
    <!-- Bootstrap Styles-->
    <link href="<?= site_url('assets/css/bootstrap.css') ?>" rel="stylesheet"/>
    <!-- FontAwesome Styles-->
    <link href="<?= site_url('assets/css/font-awesome.css') ?>" rel="stylesheet"/>
    <!-- Custom Styles-->
    <link href="<?= site_url('assets/css/custom-styles.css') ?>" rel="stylesheet"/>
    <?php if($this->router->class=='reports' && $this->router->method =='view') { ?>
        <link href="<?= site_url('assets/lib/nvd3/nv.d3.min.css') ?>" rel="stylesheet"/>
        <script src="<?= site_url('assets/lib/nvd3/d3.min.js') ?>"></script>
        <script src="<?= site_url('assets/lib/nvd3/nv.d3.min.js') ?>"></script>
    <?php } ?>
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
</head>
<body>
    <div id="wrapper">
        <!--/. NAV TOP  -->

        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <a class="navbar-brand" href="<?= site_url("/") ?>"><img src="<?= site_url("/assets/img/easol_logo.png") ?>"/></a>
                <?php if(Easol_Authentication::isLoggedIn()) { ?>
                    <ul class="nav" id="main-menu" style="padding-top: 80px;">
                        <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) {  ?>
                        <li>
                            <form action="<?= site_url("schools/choose") ?>" method="post">
                                <select name="school" onchange="this.form.submit()" style="font-size: 12px">
                                    <?php  foreach($this->Edfi_School->getAllSchools() as $school){  ?>
                                        <option value="<?= $school->EducationOrganizationId ?>" <?= (Easol_Authentication::userdata("SchoolId")==$school->EducationOrganizationId) ? "selected" : "" ?>><?= $school->NameOfInstitution ?></option>
                                    <?php } ?>
                                </select>
                            </form>

                        </li>
                        <?php } elseif(Easol_Authentication::userdata('SchoolName')){ ?>
                                <li>
                                    <?= Easol_Authentication::userdata('SchoolName') ?>
                                </li>
                        <?php } ?>
                        <li <?= ($this->router->class=="dashboard") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/dashboard") ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                        </li>
                        <?php /* if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>
                            <li <?= ($this->router->class=="schools") ? 'class="active-menu"' : '' ?>>
                                <a href="<?= site_url("/schools") ?>"><i class="fa fa-edit"></i> Schools</a>
                            </li>
                        <?php } /* */ ?>
                        <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>
                            <li <?= ($this->router->class=="student") ? 'class="active-menu"' : '' ?>>
                                <a href="<?= site_url("/student") ?>"><i class="fa fa-edit"></i> Students</a>
                            </li>
                        <?php } ?>
                        <li <?= ($this->router->class=="grades") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/grades") ?>"><i class="fa fa-desktop"></i> Grades</a>
                        </li>
                        <li <?= ($this->router->class=="sections") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/sections") ?>"><i class="fa fa-bar-chart-o"></i> Sections</a>
                        </li>
                        <li <?= ($this->router->class=="attendance") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/attendance") ?>"><i class="fa fa-qrcode"></i> Attendance</a>
                        </li>

                        <li <?= ($this->router->class=="assessments") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/assessments") ?>"><i class="fa fa-table"></i> Assessments</a>
                        </li>
                        <li <?= ($this->router->class=="cohorts") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/cohorts") ?>"><i class="fa fa-table"></i> Cohorts</a>
                        </li>
                        <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>
                            <li <?= ($this->router->class=="reports") ? 'class="active-menu"' : '' ?>>
                                <a href="<?= site_url("/reports") ?>"><i class="fa fa-edit"></i> Flex Reports</a>
                            </li>
                        <?php } ?>
                        <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>
                        <li <?= ($this->router->class=="admin") ? 'class="active-menu"' : '' ?>>
                            <a href="<?= site_url("/admin") ?>"><i class="fa fa-edit"></i> Administration</a>
                        </li>
                        <?php } ?>
                        <?php if($this->session->userdata('logged_in')== true)
                        { ?>
                        <li>
                            <a href="<?= site_url("/home/logout") ?>"><i class="fa fa-user"></i> Logout</a>
                        </li>
                        <?php } ?>
                    </ul>
                <?php } ?>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row page-content">
                <?= $content ?>
                </div>
                <div class="row">
                    <div class="col-md-8" style="color: #cccccc;">
                        This computer system is the property of the the Center of Education Innovation. It is for authorized
                        use only.
                        Unauthorized or improper use of this system may result in civil charges and/or criminal penalties.
                    </div>
                </div>
            </div>
            <!-- /. ROW  -->
            <footer></footer>
            <!-- /. PAGE INNER  -->
        </div>
    <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?= site_url('assets/js/jquery-1.10.2.js') ?>"></script>
    <!-- Bootstrap Js -->
    <script src="<?= site_url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- Metis Menu Js -->
    <script src="<?= site_url('assets/js/jquery.metisMenu.js') ?>"></script>
    <!-- Custom Js -->
    <script src="<?= site_url('assets/js/custom-scripts.js') ?>"></script>


</body>
</html>
