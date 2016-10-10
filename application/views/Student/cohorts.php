<?php
$cohorts = $student->getCohorts()->result();
if (empty($cohorts)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-sm-12">
        <table id="student-cohort-table" class="table table-striped table-bordered table-widget" data-column-visibility='no'>
            <thead>
                <tr>
                    <th>Cohort Name</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($cohorts as $cohort){ ?>
                <tr>
                    <td><?php echo $cohort->CohortIdentifier ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } 