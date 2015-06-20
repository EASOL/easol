<?php
/* @var $student Edfi_Student */
?>
<div class="col-md-12">

    <h3>Sections:</h3><br>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Section Name</th>
                <th>Period</th>
                <th>Educator</th>
            </tr>
        </thead>
        <?php foreach($student->getSections()->result() as $row ) { ?>
            <tr>
                <td><?= $row->UniqueSectionCode ?></td>
                <td><?= $row->ClassPeriodName ?></td>
                <td><?= $row->FirstName ?> <?= $row->LastSurname ?></td>
            </tr>
        <?php } ?>

    </table>


</div>