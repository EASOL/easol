<?php
$grades = $student->getGrades()->result();
if (empty($grades)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table id="student-section-table" class="table table-striped table-bordered table-widget">
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
                    <td><?php echo $grade->LocalCourseCode ?></td>
                    <td><?php echo $grade->CourseTitle ?></td>
                    <td><?php echo $grade->Term ?></td>
                    <td><?php echo $grade->ClassPeriodName ?></td>
                    <td><?php echo easol_year($grade->SchoolYear); ?></td>
                    <td>
                        <?php
                            if($grade->NumericGradeEarned!=NULL && $grade->LetterGradeEarned!=NULL)
                                echo $grade->LetterGradeEarned.'('.$grade->NumericGradeEarned.')';
                            elseif($grade->LetterGradeEarned!=NULL)
                                echo $grade->LetterGradeEarned;
                            else echo $grade->NumericGradeEarned;
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } 