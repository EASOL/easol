<?php
$cohorts = $student->getCohorts()->result();
if (empty($cohorts)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-6 col-sm-8">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Cohort Name</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($cohorts as $cohort){ ?>
                <tr>
                    <td><?= $cohort->CohortIdentifier ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } ?>