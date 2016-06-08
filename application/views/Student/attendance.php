<?php
$attendances = $student->getAttendance();
if (empty($attendances)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table id="student-attendance-table" class="table table-striped table-bordered table-widget">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>School Year</th>
                    <th>Grade</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($attendances as $attendance){ ?>
                <tr>
                    <td><?php echo easol_date($attendance->EventDate) ?></td>
                    <td><?php echo $attendance->SchoolYear?></td>
                    <td><?php echo $attendance->Grade ?></td>
                    <td><?php echo $attendance->CodeValue ?></td>
                </tr>
            <?php }  ?>
            </tbody>
        </table>
    </div>
<?php } ?>
