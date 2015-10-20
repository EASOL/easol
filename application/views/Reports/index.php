<?php /* @var $reports Easol_Report[] */ ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Flex Reports</h1>

        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Report Name</th>
                            <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?><th>Display Type</th> <?php } ?>
                            <th>Category</th>
                            <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>

                                <th>School</th>
                                <th>Access</th>
                                <th>Edit</th>
                                <th>Delete</th>

                            <?php } ?>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reports as &$report){ ?>
                        <tr>
                            <td><a href="<?= site_url('reports/view/'.$report->ReportId) ?>"><?= $report->ReportName ?></a></td>
                            <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?><td><?= $report->getDisplayType()->DisplayName ?></td><?php } ?>
                            <td><?= $report->getCategory()->ReportCategoryName ?></td>
                            <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>
                                <td><?= $report->getSchool()->NameOfInstitution ?></td>
                                <td><?php
                                    $_actp=[];
                                foreach($report->getAccessTypes() as $access){
                                    $_actp[] =$access->RoleTypeName;
                                }
                                    echo '<span>'.implode('</span>, <span>', $_actp).'</span>';
                                ?></td>

                                <td style="text-align: center"><a href="<?= site_url('reports/edit/'.$report->ReportId) ?>"><span class="fa fa-pencil"></span></a></td>
                                <td style="text-align: center"><a href="#" onclick="if(confirm('Do you want to delete this report? ')) window.location=' <?= site_url('reports/delete/'.$report->ReportId) ?>'; return false"><span class="fa fa-trash-o"></span></a></td>
                            <?php } ?>



                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <a name="dashConf"></a>
                <a href="<?= site_url('reports/create') ?>" class="btn btn-primary">New Flex Report</a>
            </div>

        </div>
    </div>
 </div>
<div class="row">

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Dashboard Configuration</h3>
            </div>
            <div class="panel-body">
                <?php if ($this->session->flashdata('message_dash_conf')) { ?>
                    <div class="alert alert-success"> <?= $this->session->flashdata('message_dash_conf') ?> </div>
                <?php } ?>

                <?php $this->load->view("Reports/_dashboard_conf_form",['reports' => $reports]); ?>
            </div>

        </div>
    </div>
</div>