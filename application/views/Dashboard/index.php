<?php /* @var $dashboardConf Easol_DashboardConfiguration */ ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Dashboard</h1>

        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>

<?php if($dashboardConf): ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
            <div class="col-md-6 col-sm-12" id="left-chart">
                <div class="thumbnail">
                    <?php
                    $this->load->view("Reports/".$dashboardConf->getLeftChart()->getViewName(),['model' => $dashboardConf->getLeftChart(), 'displayTitle' => false ]);
                            ?>
                    <div class="caption">
                        <h3><?= $dashboardConf->getLeftChart()->ReportName; ?> </h3>
                        <br>
                    </div>
                </div></div>
            <div class="col-md-6 col-sm-12" id="right-chart">
                <div class="thumbnail"><?php
                    $this->load->view("Reports/".$dashboardConf->getRightChart()->getViewName(),['model' => $dashboardConf->getRightChart(), 'displayTitle' => false]);
                    ?>
                    <div class="caption">
                        <h3><?= $dashboardConf->getRightChart()->ReportName; ?> </h3>
                        <br>
                    </div>
                </div></div>
            <div class="col-md-12 col-sm-12" id="bottom-table"><div class="thumbnail"><?php
                    $this->load->view("Reports/".$dashboardConf->getBottomTable()->getViewName(),['model' => $dashboardConf->getBottomTable(),'pageNo'=>$tablePageNo,'paginationUrl' =>"dashboard/index", 'displayTitle' => true ]);
                    ?></div></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>