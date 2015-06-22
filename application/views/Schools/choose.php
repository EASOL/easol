<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/22/2015
 * Time: 11:42 AM
 */
?>
<div class="col-md-12">
    <br>
    <h3>Choose School:</h3><br>
    <form class="form form-inline" action="" method="post">
        <div class="form-group">
            <select name="school">
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