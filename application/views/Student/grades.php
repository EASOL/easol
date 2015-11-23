<?php
$grades = $student->getGrades()->result();
if (empty($grades)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Title</th>
                    <th>Term</th>
                    <th>Period Name</th>
                    <th>School Year</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($grades as $grade){ ?>
                <tr>
                    <td><?= $grade->LocalCourseCode ?></td>
                    <td><?= $grade->CourseTitle ?></td>
                    <td><?= $grade->Term ?></td>
                    <td><?= $grade->ClassPeriodName ?></td>
                    <td><?= $grade->SchoolYear ?></td>
                    <td>
                        <?php
                            if($grade->NumericGradeEarned!=null && $grade->LetterGradeEarned!=null)
                                echo $grade->LetterGradeEarned.'('.$grade->NumericGradeEarned.')';
                            elseif($grade->LetterGradeEarned!=null)
                                echo $grade->LetterGradeEarned;
                            else echo $grade->NumericGradeEarned;
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>