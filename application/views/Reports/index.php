<?php /* @var $reports Easol_Report[] */ ?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Flex Reports</h1>
        <br/><br/>

        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
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
                <?php foreach($reports as $report){ ?>
                <tr>
                    <td><a href="<?= site_url('reports/view/'.$report->ReportId) ?>"><?= $report->ReportName ?></a></td>
                    <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?><td><?= $report->getDisplayType()->DisplayName ?></td><?php } ?>
                    <td><?= $report->getCategory()->ReportCategoryName ?></td>
                    <?php if(Easol_AuthorizationRoles::hasAccess(['System Administrator','Data Administrator'])) { ?>
                        <td><?= $report->getSchool()->NameOfInstitution ?></td>
                        <td><?php
                        foreach($report->getAccessTypes() as $access){
                            echo '<span> '.$access->RoleTypeName.'</span> ';
                        }
                        ?></td>

                        <td style="text-align: center"><a href="<?= site_url('reports/edit/'.$report->ReportId) ?>"><span class="fa fa-pencil"></span></a></td>
                        <td style="text-align: center"><a href="#" onclick="if(confirm('Do you want to delete this report? ')) window.location=' <?= site_url('reports/delete/'.$report->ReportId) ?>'; return false"><span class="fa fa-trash-o"></span></a></td>
                    <?php } ?>



                </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <a href="<?= site_url('reports/create') ?>"> <button class="btn btn-primary">New Flex Report</button></a>
    </div>
</div>