<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Students</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">

        <div class="panel panel-default">
            <div class="panel-body">
 
                <form action="" method="get" class="form-inline" name="dataGridFormFilter" id="dataGridFormFilter">

                    <div class="row">
                        <div class="col-sm-12 margin-bottom">
                            <input type="text" placeholder="Search..." name="filter[term]" class="form-control" style="width: 100%">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="filter-Year">Year</label>
                        <?php echo form_dropdown('filter[Year]', filter_year_listing($school_id), '', "class='form-control' id='Year'"); ?>
                    </div>

                    <div class="form-group">
                        <label for="filter-GradeLevel">Grade Level</label>

                        <?php echo form_dropdown('filter[GradeLevel]', filter_grade_listing($school_id), '', "class='form-control'"); ?>
                    </div>

                    <div class="form-group">
                        <label for="filter-Subject">Cohort</label>
                        <?php echo form_dropdown('filter[Cohort]', filter_cohort_listing(), '', "class='form-control'"); ?>
                    </div>

                    <div class="form-group">
                        <label for="filter-PageLength">Records Per Page:</label>
                        <?php echo form_dropdown('filter[PageLength]', filter_page_size_listing(), '', "class='form-control'"); ?>
                    </div>
                </form>

                <div class="datatablegrid">
                    <table id="student-table" class="table table-striped table-bordered table-widget" cellspacing="0" width="100%" data-filter-option='no' data-initial-filter='{"3":"#Year"}'>
                        <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Grade</th>
                            <th>Cohort</th>
                            <th>School Year</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($student_listing as $row) : ?>
                            <tr>
                                <td><a href="<?php echo site_url('student/profile/'.$row->StudentUSI) ?>"><?php echo $row->FirstName . ' ' . $row->LastSurname; ?></a></td>
                                <td><?php echo $row->Grade; ?></td>
                                <td><?php echo $row->CohortIdentifier; ?></td>
                                <td><?php echo easol_year($row->SchoolYear); ?></td>

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
