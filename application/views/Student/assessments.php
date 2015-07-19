<?php
/* @var $student Edfi_Student */
?>
<div class="col-md-12">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Administration Date</th>
                <th>Result</th>
                <th>Grade Level</th>
                <th>Subject</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($student->getAssessments()->result() as $assessment){ ?>
            <tr>
                <td><?= $assessment->AssessmentTitle ?></td>
                <td><?= $assessment->AdministrationDate ?></td>
                <td><?= $assessment->Result ?></td>
                <td><?= $assessment->GradeLevel ?></td>
                <td><?= $assessment->AcademicSubject ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>



</div>