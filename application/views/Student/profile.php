<?php
if (empty($student)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-6 col-sm-8">
        <table class="table table-hover table-bordered">
            <tr>
                <th><?php echo $student->labels()['StudentUniqueId'] ?></th>
                <td><?php echo $student->StudentUniqueId ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['FirstName'] ?></th>
                <td><?php echo $student->FirstName ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['MiddleName'] ?></th>
                <td><?php echo $student->MiddleName ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['LastSurname'] ?></th>
                <td><?php echo $student->LastSurname ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['SexTypeId'] ?></th>
                <td><?php echo $student->getSex()->ShortDescription  ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['BirthDate'] ?></th>
                <td><?php echo easol_date($student->BirthDate)  ?></td>
            </tr>
            <tr>
                <th>Ethnicity</th>
                <td><?php echo $student->getRace()->Description ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['HispanicLatinoEthnicity'] ?></th>
                <td><?php echo ($student->HispanicLatinoEthnicity == 1) ? "Yes" : "No" ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['EconomicDisadvantaged'] ?></th>
                <td><?php echo $student->EconomicDisadvantaged  ?></td>
            </tr>
            <tr>
                <th><?php echo $student->labels()['LimitedEnglishProficiencyDescriptorId'] ?></th>
                <td><?php echo $student->getLimitedEnglishProficiency()->Description ?></td>
            </tr>
        </table>
    </div>
<?php } 