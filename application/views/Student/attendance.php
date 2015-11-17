<?php
$attendances = $student->getAttendance();
if (empty($attendances)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <br>
        <h3>Attendance</h3><br>
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
                    <td><? list($pCode,$pName) = explode(' - ', $attendance->ClassPeriodName); echo $pCode; ?></td>
                    <td><?= $attendance->LocalCourseCode ?></td>
                    <td><?= $attendance->UniqueSectionCode ?></td>
                    <td><?= ($attendance->CodeValue=='In Attendance') ? $attendance->Days : "" ?></td>
                    <td><?= ($attendance->CodeValue=='Tardy') ? $attendance->Days : "" ?></td>
                    <td><?= ($attendance->CodeValue=='Excused Absence' || $attendance->CodeValue=='Unexcused Absence') ? $attendance->Days : "" ?></td>

                </tr>
            <?php }  ?>
            </tbody>
        </table>
    </div>
<?php } ?>