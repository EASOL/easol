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
        <li role="presentation" class="active"><a href="<?= site_url('student/profile/'.$student->StudentUSI) ?>" aria-controls="home" role="tab">Overview</a></li>
        <li role="presentation"><a href="<?= site_url('student/contacts/'.$student->StudentUSI) ?>" aria-controls="profile" role="tab">Contacts</a></li>
        <li role="presentation"><a href="<?= site_url('student/section/'.$student->StudentUSI) ?>" aria-controls="messages" role="tab" data-toggle="tab">Sections</a></li>
        <li role="presentation"><a href="<?= site_url('student/grades/'.$student->StudentUSI) ?>" aria-controls="settings" role="tab" data-toggle="tab">Grades</a></li>
        <li role="presentation"><a href="<?= site_url('student/attendance/'.$student->StudentUSI) ?>" aria-controls="settings" role="tab" data-toggle="tab">Attendance</a></li>
        <li role="presentation"><a href="<?= site_url('student/assessments/'.$student->StudentUSI) ?>" aria-controls="settings" role="tab" data-toggle="tab">Assessments</a></li>
        <li role="presentation"><a href="<?= site_url('student/cohorts/'.$student->StudentUSI) ?>" aria-controls="settings" role="tab" data-toggle="tab">Cohorts</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
            <?= $tabContent ?>

        </div>

    </div>

</div>