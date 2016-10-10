<?php
$attendances = $student->getAttendance();
if (empty($attendances)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table id="student-attendance-table" class="table table-striped table-bordered table-widget">
            <thead>
                <tr>
                    <th>Period</th>
                    <th>Course Code</th>
                    <th>Section Code</th>
                    <th>Present</th>
                    <th>Tardy</th>
                    <th>Absent</th>
                </tr>
            </thead>
            <tbody>
            <?php  foreach($attendances as $attendance){ ?>
                <tr>
                    <td><?php

                    if(strpos($attendance->ClassPeriodName, " - ")!== FALSE)
                     list($pCode,$pName) = explode(' - ', $attendance->ClassPeriodName);
                    else
                     $pCode = $attendance->ClassPeriodName;
                    echo $pCode;
                     ?></td>
                    <td><?php echo $attendance->LocalCourseCode ?></td>
                    <td><?php echo anchor('sections/details/'.$attendance->id, $attendance->UniqueSectionCode, 'target="_blank"'); ?></td>
                    <td><?php echo $attendance->Present ?></td>
                    <td><?php echo $attendance->Tardy ?></td>
                    <td><?php echo $attendance->Absence ?></td>
                </tr>
            <?php }  ?>
            </tbody>
        </table>
    </div>
<?php } 