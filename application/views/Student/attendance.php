<?php
/* @var $student Edfi_Student */
?>
<div class="col-md-12">
    <br>
    <h3>Attendance</h3><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Title</th>
                <th>Term</th>
                <th>School Year</th>
                <th>Letter Grade</th>
                <th>Numeric Grade</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($student->getGrades()->result() as $grade){ ?>
            <tr>
                <td><?= $grade->LocalCourseCode ?></td>
                <td><?= $grade->CourseTitle ?></td>
                <td><?= $grade->Term ?></td>
                <td><?= $grade->SchoolYear ?></td>
                <td><?= $grade->LetterGradeEarned ?></td>
                <td><?= $grade->NumericGradeEarned ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>



</div>