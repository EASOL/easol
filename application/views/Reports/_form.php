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
<div class="col-md-6">
    <form action="" method="post" class="form-horizontal">


        <div class="form-group">
            <label for="ReportName" class="col-sm-4 control-label"><?= $model->labels()['ReportName'] ?></label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ReportName" name="report[ReportName]" value="<?= $model->ReportName ?>" required>
            </div>
        </div>

        <div class="form-group">
            <label for="ReportCategoryId" class="col-sm-4 control-label"><?= $model->labels()['ReportCategoryId'] ?></label>
            <div class="col-sm-8">
                <select class="form-control" id="ReportCategoryId" name="report[ReportCategoryId]">
                    <?php
                    $this->load->model("entities/easol/Easol_ReportCategory",'Easol_ReportCategory');
                    $reportCategories= new Easol_ReportCategory();
                        foreach($reportCategories->findAll()->result() as $reportCategory){
                            ?>
                            <option value="<?= $reportCategory->ReportCategoryId ?>"><?= $reportCategory->ReportCategoryName ?></option>
                        <?php
                        }

                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="CommandText" class="col-sm-4 control-label"><?= $model->labels()['CommandText'] ?></label>
            <div class="col-sm-8">
                <textarea class="form-control" id="CommandText" name="report[CommandText]" rows="3" required><?= $model->CommandText ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="ReportDisplayId" class="col-sm-4 control-label"><?= $model->labels()['ReportDisplayId'] ?></label>
            <div class="col-sm-8">
                <select class="form-control" id="ReportDisplayId" name="report[ReportDisplayId]">
                    <?php
                    $this->load->model("entities/easol/Easol_ReportDisplay",'Easol_ReportDisplay');
                    $reportDisplayType= new Easol_ReportDisplay();
                    foreach($reportDisplayType->findAll()->result() as $reportDisplay){
                        ?>
                        <option value="<?= $reportDisplay->ReportDisplayId ?>"><?= $reportDisplay->DisplayName ?></option>
                    <?php
                    }

                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="access" class="col-sm-4 control-label">Access</label>
            <div class="col-sm-8">
                <select multiple class="form-control" id="access" name="access[access][]" >
                    <?php
                    $objRoles= new Easol_RoleType();
                    foreach($objRoles->findAll()->result() as $role){
                        ?>
                        <option value="<?= $role->RoleTypeId ?>" <?php if(is_array($this->input->post('access[access]')) && in_array($role->RoleTypeId,$this->input->post('access[access]'))) echo "selected" ?>  ><?= $role->RoleTypeName ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group pull-right">
            <button type="submit" class="btn btn-default">Save</button>
        </div>

    </form>
</div>