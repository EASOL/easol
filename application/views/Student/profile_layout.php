<?php
if (empty($student)) {
    $this->load->view('no_results_found');
} else { ?>
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header"><?= $student->FirstName ?> <?= $student->LastSurname ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div role="tabpanel">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" <?php if($tab=='overview') echo  'class="active"'; ?>><a href="<?= site_url('student/profile/'.$student->StudentUSI) ?>" aria-controls="overview" role="tab">Overview</a></li>
                            <li role="presentation" <?php if($tab=='contacts') echo  'class="active"'; ?>><a href="<?= site_url('student/contacts/'.$student->StudentUSI) ?>" aria-controls="contacts" role="tab">Contacts</a></li>
                            <li role="presentation" <?php if($tab=='sections') echo  'class="active"'; ?>><a href="<?= site_url('student/sections/'.$student->StudentUSI) ?>" aria-controls="sections" role="tab">Sections</a></li>
                            <li role="presentation" <?php if($tab=='attendance') echo  'class="active"'; ?>><a href="<?= site_url('student/attendance/'.$student->StudentUSI) ?>" aria-controls="attendance" role="tab" >Attendance</a></li>
                            <li role="presentation" <?php if($tab=='assessments') echo  'class="active"'; ?>><a href="<?= site_url('student/assessments/'.$student->StudentUSI) ?>" aria-controls="assessments" role="tab">Assessments</a></li>
                            <li role="presentation" <?php if($tab=='cohorts') echo  'class="active"'; ?>><a href="<?= site_url('student/cohorts/'.$student->StudentUSI) ?>" aria-controls="cohorts" role="tab">Cohorts</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="<?= $tab ?>">
                                <div class="row">
                                    <?= $tabContent ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>