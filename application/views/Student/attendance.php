<?php
$attendances = $student->getAttendance();
if (empty($attendances)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table class="table table-striped table-bordered">
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

                    if(strpos($attendance->ClassPeriodName, " - ")!== false)
                     list($pCode,$pName) = explode(' - ', $attendance->ClassPeriodName);
                    else
                     $pCode = $attendance->ClassPeriodName;
                    echo $pCode;
                     ?></td>
                    <td><?= $attendance->LocalCourseCode ?></td>
                    <td><?= anchor('sections/details/'.$attendance->id, $attendance->UniqueSectionCode, 'target="_blank"'); ?></td>
                    <td><?= $attendance->Present ?></td>
                    <td><?= $attendance->Tardy ?></td>
                    <td><?= $attendance->Absence ?></td>
                </tr>
            <?php }  ?>
            </tbody>
        </table>
    </div>
<?php } ?>
