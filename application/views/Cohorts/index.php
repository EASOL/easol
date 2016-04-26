<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Cohorts</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">


                <div class="datatablegrid">
                    <table id="cohort-table" class="table table-striped table-bordered table-widget" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Students</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cohort_listing as $row) : ?>
                            <tr>
                                <td>
                                    <a href="<?php echo site_url('cohorts/students/' . $row->CohortIdentifier) ?>"><?php echo $row->CohortIdentifier; ?></a>
                                </td>
                                <td><?php echo $row->CohortDescription; ?></td>
                                <td><?php echo $row->StudentCount; ?></td>


                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="pull-right form-group" style="padding-top: 0.25em;">
                        <div id="csv-button"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
