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
<div class="row">
    <div class="col-md-8 col-sm-12">
        <form action="" method="post" class="form-horizontal">


            <div class="form-group">
                <label for="ReportName" class="col-md-4 control-label"><?= $model->labels()['ReportName'] ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="ReportName" name="report[ReportName]" value="<?= $model->ReportName ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="ReportCategoryId" class="col-md-4 control-label"><?= $model->labels()['ReportCategoryId'] ?></label>
                <div class="col-md-4">
                    <select class="form-control" id="ReportCategoryId" name="report[ReportCategoryId]">
                        <?php
                        $this->load->model("entities/easol/Easol_ReportCategory",'Easol_ReportCategory');
                        $reportCategories= new Easol_ReportCategory();
                            foreach($reportCategories->findAll()->result() as $reportCategory){
                                ?>
                                <option value="<?= $reportCategory->ReportCategoryId ?>" <?= ($model->ReportCategoryId==$reportCategory->ReportCategoryId) ? "selected" : "" ?>><?= $reportCategory->ReportCategoryName ?></option>
                            <?php
                            }

                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <a href="<?= site_url("reports/createcategory") ?>">Add New Category</a>
                </div>
            </div>

            <div class="form-group">
                <label for="CommandText" class="col-md-4 control-label"><?= $model->labels()['CommandText'] ?></label>
                <div class="col-md-8">
                    <textarea class="form-control" id="CommandText" name="report[CommandText]" rows="14" required><?= $model->CommandText ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="LabelX" class="col-md-4 control-label"><?= $model->labels()['LabelX'] ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="LabelX" name="report[LabelX]" value="<?= $model->LabelX ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="LabelY" class="col-md-4 control-label"><?= $model->labels()['LabelY'] ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="LabelY" name="report[LabelY]" value="<?= $model->LabelY ?>" >
                </div>
            </div>

            <div class="form-group">
                <label for="ReportDisplayId" class="col-md-4 control-label"><?= $model->labels()['ReportDisplayId'] ?></label>
                <div class="col-md-8">
                    <select class="form-control" id="ReportDisplayId" name="report[ReportDisplayId]">
                        <?php
                        $this->load->model("entities/easol/Easol_ReportDisplay",'Easol_ReportDisplay');
                        $reportDisplayType= new Easol_ReportDisplay();
                        foreach($reportDisplayType->findAll()->result() as $reportDisplay){
                            ?>
                            <option value="<?= $reportDisplay->ReportDisplayId ?>" <?= ($model->ReportDisplayId==$reportDisplay->ReportDisplayId) ? "selected" : "" ?> ><?= $reportDisplay->DisplayName ?></option>
                        <?php
                        }

                        ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="access" class="col-md-4 control-label">Access</label>
                <div class="col-md-8">
                    <select multiple class="form-control" id="access" name="access[access][]" >
                        <?php
                        $objRoles= new Easol_RoleType();

                        $assignedRoles = $model->getAccessTypes();
                        $aRoles = [];

                        foreach($assignedRoles as $aRole){
                            $aRoles[]=$aRole->RoleTypeId;
                        }


                        foreach($objRoles->findAllBySql("SELECT RoleTypeId, RoleTypeName FROM EASOL.RoleType WHERE RoleTypeName NOT IN ('System Administrator', 'Data Administrator')") as $role){
                        ?>
                            <?php if($model->isNewRecord){ ?>
                                <option value="<?= $role->RoleTypeId ?>" <?php if(is_array($this->input->post('access[access]')) && in_array($role->RoleTypeId,$this->input->post('access[access]'))) echo "selected" ?>  ><?= $role->RoleTypeName ?></option>
                            <?php }

                            else {
                            ?>
                                <option value="<?= $role->RoleTypeId ?>" <?php if(in_array($role->RoleTypeId,$aRoles)) echo "selected" ?>  ><?= $role->RoleTypeName ?></option>
                            <?php } ?>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary pull-right"><?= ($model->isNewRecord) ? "Save" : "Update" ?></button>
                </div>
            </div>

        </form>
    </div>
</div>