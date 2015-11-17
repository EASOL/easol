<?php
$sections = $student->getSections()->result();
if (empty($sections)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Section Name</th>
                    <th>Period</th>
                    <th>Educator</th>
                </tr>
            </thead>
            <?php foreach($sections as $row ) { ?>
                <tr>
                    <td><?= $row->UniqueSectionCode ?></td>
                    <td><?= $row->ClassPeriodName ?></td>
                    <td><?= $row->FirstName ?> <?= $row->LastSurname ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php } ?>