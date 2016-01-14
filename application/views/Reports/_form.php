<?php

/* @var $model Easol_Report */
?>

<?php if (validation_errors()) { ?>
    <div class="alert alert-danger"> <?php echo validation_errors(); ?> </div>
<?php } ?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <form action="" method="post" class="form-horizontal" id="report-form">


            <div class="form-group">
                <label for="ReportName" class="col-md-2 control-label"><?= $model->labels()['ReportName'] ?></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" id="ReportName" name="report[ReportName]" value="<?= $model->ReportName ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="ReportCategoryId" class="col-md-2 control-label"><?= $model->labels()['ReportCategoryId'] ?></label>
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
                <div class="col-md-12">
                    <textarea class="form-control" id="CommandText" name="report[CommandText]" rows="14" required><?= $model->CommandText ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="CommandText" class="col-md-4 control-label">Filters</label>
                <div class="col-md-12">
                        
                    <table id="filter-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Display Name</th>
                                <th>Field Name</th>
                                <th>Type</th>
                                <th>Values</th>
                                <th>Default</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($filters = $model->getFilters()->result())): ?>
                            <?php foreach($filters as $filter){ ?>
                                <tr>
                                    <td><input type='text' name='filter[<?php echo $filter->ReportFilterId ?>][DisplayName]' value="<?php echo $filter->DisplayName ?>" class='form-control'></td>
                                    <td><input type='text' name='filter[<?php echo $filter->ReportFilterId ?>][FieldName]' value="<?php echo $filter->FieldName ?>" class='form-control'></td>
                                    <td>
                                        <?php echo form_dropdown("filter[{$filter->ReportFilterId}][FilterType]", report_types(), $filter->FilterType, "class='form-control'"); ?>                                        
                                    </td>
                                    <td><textarea class='form-control' name='filter[<?php echo $filter->ReportFilterId ?>][FilterOptions]' style='height: 34px'><?php echo $filter->FilterOptions ?></textarea></td>
                                    <td><input type='text' name='filter[<?php echo $filter->ReportFilterId ?>][DefaultValue]' value="<?php echo $filter->DefaultValue ?>" class='form-control'></td>
                                    <td>
                                        <a href="#" class='js-delete-row'><span class="fa fa-trash-o"></span></a>
                                    </td>
                                </tr>
                            <?php  } ?>
                        <?php endif; ?>
                        </tbody>
                    </table>

                    <div class='col-md-12'>
                        <a href="#" class='js-add-filter'>Add New Filter</a>
                    </div>



                    <table class='html-template' id='add-filter-template'>
                        <tr>
                            <td><input type='text' name='filter[{{id}}][DisplayName]' class='form-control' disabled></td>
                            <td><input type='text' name='filter[{{id}}][FieldName]' class='form-control' disabled></td>
                            <td>
                                <?php echo form_dropdown("filter[{{id}}][FilterType]", report_types(), '', "class='form-control' disabled"); ?>                                        
                            </td>
                            <td><textarea class='form-control' name='filter[{{id}}][FilterOptions]' style='height: 34px' disabled></textarea></td>
                            <td><input type='text' name='filter[{{id}}][DefaultValue]' class='form-control' disabled></td>
                            <td>
                                <a href="#" class='js-delete-row'><span class="fa fa-trash-o"></span></a>
                            </td>
                        </tr>
                    </table>
                   
                </div>
            </div>
            <div class="form-group">
                <label for="LabelX" class="col-md-2 control-label"><?= $model->labels()['LabelX'] ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="LabelX" name="report[LabelX]" value="<?= $model->LabelX ?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="LabelY" class="col-md-2 control-label"><?= $model->labels()['LabelY'] ?></label>
                <div class="col-md-8">
                    <input type="text" class="form-control" id="LabelY" name="report[LabelY]" value="<?= $model->LabelY ?>" >
                </div>
            </div>

            <div class="form-group">
                <label for="ReportDisplayId" class="col-md-2 control-label"><?= $model->labels()['ReportDisplayId'] ?></label>
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
                <label for="access" class="col-md-2 control-label">Access</label>
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
                    <button type="submit" class="btn btn-primary"><?= ($model->isNewRecord) ? "Save" : "Update" ?></button>
                    <button type="button" class="btn btn-default" data-href="<?php echo site_url('reports/preview/') ?>" data-toggle="modal" data-post-data="#report-form" data-target="#preview-report">Preview</button>
                </div>
            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="preview-report">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Preview</h4>
            </div>
            <div class="modal-body">
                <div class="loading" style="display: none"></div>
                <div class="modal-ajax-content"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>