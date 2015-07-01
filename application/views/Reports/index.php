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
                    <th>Display Type</th>
                    <th>Category</th>
                    <th>School</th>
                    <th>Access</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($reports as $report){ ?>
                <tr>
                    <td><?= $report->ReportName ?></td>
                    <td><?= $report->getDisplayType()->DisplayName ?></td>
                    <td><?= $report->getCategory()->ReportCategoryName ?></td>
                    <td><?= $report->getSchool()->NameOfInstitution ?></td>
                    <td><?php
                        foreach($report->getAccessTypes() as $access){
                            echo '<span> '.$access->RoleTypeName.'</span> ';
                        }
                        ?></td>
                    <td>Edit</td>
                    <td>Delete</td>
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