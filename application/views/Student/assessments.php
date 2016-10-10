<?php
$assessments = $student->getAssessments()->result();
if (empty($assessments)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table id="student-assessment-table" class="table table-striped table-bordered table-widget">
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
            <?php foreach($assessments as $assessment){ ?>
                <tr>
                    <td><?php echo $assessment->AssessmentTitle ?></td>
                    <td><?php echo easol_date($assessment->AdministrationDate) ?></td>
                    <td><?php echo $assessment->Result ?></td>
                    <td><?php echo $assessment->GradeLevel ?></td>
                    <td><?php echo $assessment->AcademicSubject ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } 