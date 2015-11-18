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
                        <?= anchor('reports/view/'.$dashboardConf->getLeftChart()->ReportId, '<h3>'.$dashboardConf->getLeftChart()->ReportName.'</h3>'); ?>
                        <br>
                    </div>
                </div></div>
            <div class="col-md-6 col-sm-12" id="right-chart">
                <div class="thumbnail"><?php
                    $this->load->view("Reports/".$dashboardConf->getRightChart()->getViewName(),['model' => $dashboardConf->getRightChart(), 'displayTitle' => false]);
                    ?>
                    <div class="caption">
                        <?= anchor('reports/view/'.$dashboardConf->getRightChart()->ReportId, '<h3>'.$dashboardConf->getRightChart()->ReportName.'</h3>'); ?>
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

<div id="chardin_template">
    <div class="chardinjs-ext-el" data-chardin-ext="above-intro">
        <h1 class="page-title text-center">Welcome to EASOL!</h1>
    </div>
    <div class="chardinjs-ext-el" data-chardin-ext="below-intro">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <p>The EASOL interface is designed to help educators access resources and analyze data quickly and easily. Below are screenshots from the "Data Center" portion of the EASOL platform where teachers, school leaders and administrators can quickly access up-to-date information about students and their performance.</p>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="center-block text-center">
                    <form class="form-inline undo-overrides default-form-inline chardin-form">
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" checked> Don't show next time</label>
                            </div>
                            <button type="submit" class="btn btn-default">Return to the site</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
