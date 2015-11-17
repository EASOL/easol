<?php
if (empty($student)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-6 col-sm-8">
        <table class="table table-hover table-bordered">
            <tr>
                <th><?= $student->labels()['StudentUniqueId'] ?></th>
                <td><?= $student->StudentUniqueId ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['FirstName'] ?></th>
                <td><?= $student->FirstName ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['MiddleName'] ?></th>
                <td><?= $student->MiddleName ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['LastSurname'] ?></th>
                <td><?= $student->LastSurname ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['SexTypeId'] ?></th>
                <td><?= $student->getSex()->ShortDescription  ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['BirthDate'] ?></th>
                <td><?= $student->BirthDate  ?></td>
            </tr>
            <tr>
                <th>Ethnicity</th>
                <td><?= $student->getRace()->Description ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['HispanicLatinoEthnicity'] ?></th>
                <td><?= ($student->HispanicLatinoEthnicity == 1) ? "Yes" : "No" ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['EconomicDisadvantaged'] ?></th>
                <td><?= $student->EconomicDisadvantaged  ?></td>
            </tr>
            <tr>
                <th><?= $student->labels()['LimitedEnglishProficiencyDescriptorId'] ?></th>
                <td><?= $student->getLimitedEnglishProficiency()->Description ?></td>
            </tr>
        </table>
    </div>
<?php } ?>