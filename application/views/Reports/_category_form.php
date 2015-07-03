<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/27/2015
 * Time: 2:19 PM
 */
/* @var $model Easol_Report */
?>
<div class="col-md-8">
    <form action="" method="post" class="form-horizontal">


        <div class="form-group">
            <label for="ReportCategoryName" class="col-md-4 control-label"><?= $model->labels()['ReportCategoryName'] ?></label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="ReportCategoryName" name="ReportCategory[ReportCategoryName]" value="<?= $model->ReportCategoryName ?>" required>
            </div>
        </div>


        <div class="form-group pull-right">
            <button type="submit" class="btn btn-default"><?= ($model->isNewRecord) ? "Save" : "Update" ?></button>
        </div>

    </form>
</div>