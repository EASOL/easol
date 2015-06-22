<?php
/* @var $student Edfi_Student */
?>
<div class="col-md-12">
    <br>
    <h3>Cohorts</h3><br>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Cohort Name</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($student->getCohorts()->result() as $cohort){ ?>
            <tr>
                <td><?= $cohort->CohortIdentifier ?></td>
            </tr>
        <?php } ?>
        </tbody>

    </table>



</div>