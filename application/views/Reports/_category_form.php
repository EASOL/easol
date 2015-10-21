<?php

/* @var $model Easol_Report */
?>
<div class="row">
    <div class="col-md-8 col-sm-12">
        <form action="" method="post" class="form-horizontal">

            <div class="form-group">
                <label for="ReportCategoryName" class="col-md-4 col-sm-4 control-label"><?= $model->labels()['ReportCategoryName'] ?></label>
                <div class="col-md-8 col-sm-8">
                    <input type="text" class="form-control" id="ReportCategoryName" name="ReportCategory[ReportCategoryName]" value="<?= $model->ReportCategoryName ?>" required>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 col-sm-12">
                    <button type="submit" class="btn btn-primary pull-right"><?= ($model->isNewRecord) ? "Save" : "Update" ?></button>
                </div>
            </div>

        </form>
    </div>
</div>