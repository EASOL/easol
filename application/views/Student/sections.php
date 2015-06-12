<?php
/* @var $student Edfi_Student */
?>
<div class="col-md-12">

    <h3>Sections:</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Section Name</th>
                <th>Period</th>
                <th>Educator</th>
            </tr>
        <?php foreach($student->getSections()->result() as $row ) { ?>
            <tr>
                <td><?= $row->UniqueSectionCode ?></td>
                <td><?= $row->ClassPeriodName ?></td>
                <td><?= $row->FirstName ?> <?= $row->LastSurname ?></td>
            </tr>
        <?php } ?>
        </thead>
    </table>


</div>