<?php
/* @var $student Edfi_Student */
?>
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
        <?php  foreach($student->getAttendance() as $attendance){ ?>
            <tr>
                <td><?= $attendance->ClassPeriodName ?></td>
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