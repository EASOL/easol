<?php
if (empty($student)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <strong>Address</strong>
                <table class="table student-contacts table-bordered">
                    <tr>
                        <th>Type</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                    </tr>
                    <?php foreach($student->getAddresses()->result() as $row) { ?>
                    <tr>
                        <td><?= $row->Type ?></td>
                        <td><?= $row->StreetNumberName ?></td>
                        <td><?= $row->City ?></td>
                        <td><?= $row->State ?></td>
                        <td><?= $row->PostalCode ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-12 col-sm-12">
                <strong>Parents / Guardians</strong>
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Primary</th>
                        <th>Emergency Contact</th>
                    </tr>
                    <?php foreach($student->getParents()->result() as $row) { ?>
                        <tr>
                            <td><?= $row->PersonalTitlePrefix ?> <?= $row->FirstName ?> <?= $row->LastSurname ?></td>
                            <td><?= $row->Role ?></td>
                            <td><?= $row->PrimaryContactStatus==1 ? "Yes" : "No" ?></td>
                            <td><?= $row->EmergencyContactStatus ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-6 col-sm-6">
                <strong>Telephone Numbers</strong>
                <table class="table table-bordered">
                    <tr>
                        <th>Type</th>
                        <th>Telephone</th>
                    </tr>
                    <?php foreach($student->getTelephones()->result() as $row) { ?>
                        <tr>
                            <td><?= $row->telephonetype ?></td>
                            <td><?= $row->TelephoneNumber ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-md-6 col-sm-6">
                <strong>Email Addresses</strong>
                <table class="table table-bordered">
                    <tr>
                        <th>Type</th>
                        <th>Email</th>
                    </tr>
                    <?php foreach($student->getEmailAddresses()->result() as $row) { ?>
                        <tr>
                            <td><?= $row->emailType ?></td>
                            <td><?= $row->ElectronicMailAddress ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
<?php } ?>