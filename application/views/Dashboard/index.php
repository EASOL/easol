<?php /* @var $dashboardConf Easol_DashboardConfiguration */ ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Dashboard</h1>
        <br/><br/>

        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">`
        <div class="panel panel-default">
            <div class="panel-body">
            <div class="col-md-6 col-sm-12" id="left-chart"><div class="thumbnail"><?php
                    $this->load->view("Reports/display-bar-chart",['model' => $dashboardConf->getLeftChart(),'pageNo' => 1]);

                    //print_r($dashboardConf->getLeftChart()) ?></div></div>
            <div class="col-md-6 col-sm-12" id="right-chart"><div class="thumbnail"><?php print_r($dashboardConf->getRightChart()) ?></div></div>
            <div class="col-md-12 col-sm-12" id="bottom-table"><div class="thumbnail"><?php
                    $this->load->view("Reports/display-table",['model' => $dashboardConf->getBottomTable(),'pageNo' => 1]);
                    ?></div></div>
            </div>
        </div>
    </div>
</div>