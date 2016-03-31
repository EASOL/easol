<?php /* @var $cohort Edfi_Cohort */ ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Cohort</h1>
        <br/><br/>
    </div>
</div>
<div class="col-md-6">
<table class="table table-bordered ">
    <tr>
        <th>Cohort ID:</th>
        <td><?= $cohort->CohortIdentifier ?></td>
    </tr>
    <tr>
        <th>Cohort Description:</th>
        <td><?= $cohort->CohortDescription ?></td>
    </tr>
</table>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="datatablegrid">
            <table id="student-table" class="table table-striped table-bordered table-widget" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Student Name</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($student_listing as $row) : ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url('student/profile/' . $row->StudentUSI) ?>"><?php echo $row->FirstName . ' ' . $row->LastSurname; ?></a>
                        </td>

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
