<?php
/* @var $student Edfi_Student */
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header"><?= $student->FirstName ?> <?= $student->LastSurname ?></h1>
        <br/><br/>
    </div>
</div>

<div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab">Overview</a></li>
        <li role="presentation"><a href="<?= site_url('student/contacts') ?>" aria-controls="profile" role="tab">Contacts</a></li>
        <li role="presentation"><a href="<?= site_url('student/section') ?>" aria-controls="messages" role="tab" data-toggle="tab">Sections</a></li>
        <li role="presentation"><a href="<?= site_url('student/grades') ?>" aria-controls="settings" role="tab" data-toggle="tab">Grades</a></li>
        <li role="presentation"><a href="<?= site_url('student/attendance') ?>" aria-controls="settings" role="tab" data-toggle="tab">Attendance</a></li>
        <li role="presentation"><a href="<?= site_url('student/assessments') ?>" aria-controls="settings" role="tab" data-toggle="tab">Assessments</a></li>
        <li role="presentation"><a href="<?= site_url('student/cohorts') ?>" aria-controls="settings" role="tab" data-toggle="tab">Cohorts</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <div class="col-md-8">
                <table class="table">
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
                        <td><?= $student->HispanicLatinoEthnicity  ?></td>
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

        </div>

    </div>

</div>