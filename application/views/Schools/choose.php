<?php

?>
<div class="row choose-school">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Choose School:</h3>
                <form class="form form-inline" action="" method="post">
                    <div class="form-group">
                        <select name="school" class="form-control">
                            <?php  foreach($schools as $school) { ?>
                                <option value="<?= $school->EducationOrganizationId ?>" <?= (Easol_Authentication::userdata("SchoolId")==$school->EducationOrganizationId) ? "selected" : "" ?>><?= $school->NameOfInstitution ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Select</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>