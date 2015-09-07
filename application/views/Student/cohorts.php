<?php
/* @var $student Edfi_Student */
?>
<div class="col-md-6 col-sm-8">

    <table class="table table-striped table-bordered">
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