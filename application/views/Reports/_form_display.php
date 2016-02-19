<h3 class='subtitle'>Display Definitions</h3>
<div class="form-group">
    <label for="ReportDisplayId" class="col-md-2 control-label"><?= $model->labels()['DisplayType'] ?></label>
    <div class="col-md-8">
        <?php echo form_dropdown('report[DisplayType]', report_display_types(), $model->DisplayType, "id='DisplayType' class='form-control'"); ?>
    </div>
</div>

<div class='chart-settings' style="display: none">

    <div class="form-group">
        <label class="col-md-2 control-label">Chart Definitions</label>
        <div class="col-md-8">
            <label class="radio-inline">
                <?php echo form_radio("report[Settings][Type]", 'defined', $model->Settings->Type == 'defined', 'class="settings-type"') ?> Defined bars/slices 
            </label>
            <label class="radio-inline">
                <?php echo form_radio("report[Settings][Type]", 'dynamic', $model->Settings->Type == 'dynamic', 'class="settings-type"') ?>Dynamic bars/slices
            </label>
        </div>


    </div>


    <div class='specific-settings bar-chart-settings' style='display: none'>

        <div class="form-group">
            <label for="LabelX" class="col-md-2 control-label">X Axis Label</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="LabelX" name="report[Settings][LabelX]" value="<?= $model->Settings->LabelX ?>" >
            </div>
        </div>
        <div class="form-group">
            <label for="LabelY" class="col-md-2 control-label">Y Axis Label</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="LabelY" name="report[Settings][LabelY]" value="<?= $model->Settings->LabelY ?>" >
            </div>
        </div>
    </div>

    <div>
        <div class="form-group">
            <label class="col-md-2 control-label">Variable</label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="report[Settings][Variable]" value="<?= $model->Settings->Variable ?>" >
            </div>
            <label class='col-md-1 control-label'>Data Type</label>
            <div class="col-md-2">
                <?php echo form_dropdown("report[Settings][DataType]", report_data_types(), $model->Settings->DataType, 'class="form-control"'); ?>
            </div>

        </div>
    </div>

    <div class='settings-type defined-settings' style='display: none'>

       <div class="form-group">
        <label class="col-md-4 control-label">Bars/Slices</label>
        <div class="col-md-12">

            <table id="column-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Operator</th>
                        <th>Value</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($columns = $model->Settings->Columns)): ?>


                    <?php $i = 0; ?>
                    <?php foreach($columns as $k=>$column){ ?>
                    <tr>
                        <td>
                            <input type='text' name='report[Settings][Columns][<?php echo $i ?>][Label]' value="<?php echo $model->Settings->Columns[$k]->Label ?>" class='form-control'>
                        </td>

                        <td>
                            <?php echo form_dropdown("report[Settings][Columns][$i][Operator]", report_operators(), $model->Settings->Columns[$k]->Operator, "class='form-control'"); ?>
                        </td>


                        <td> 
                            <input type='text' name='report[Settings][Columns][<?php echo $i ?>][Value]' value="<?php echo $model->Settings->Columns[$k]->Value ?>" class='form-control'>                                                       
                        </td>

                        <td>
                            <a href="#" class='js-delete-column-row'><span class="fa fa-trash-o"></span></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php  } ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class='col-md-12'>
            <a href="#" class='js-add-column'>Add New Bar/Slice</a>
        </div>



        <table class='html-template' id='add-column-template'>
            <tr>
                <td><input type='text' name='report[Settings][Columns][{{id}}][Label]' class='form-control input-template' disabled='disabled'></td>
                <td>
                    <?php echo form_dropdown("report[Settings][Columns][{{id}}][Operator]", report_operators(), null, "class='form-control input-template' disabled"); ?>
                </td>
                <td>
                    <input type='text' name='report[Settings][Columns][{{id}}][Value]' class='form-control input-template' disabled>
                </td>

                <td>
                    <a href="#" class='js-delete-column-row'><span class="fa fa-trash-o"></span></a>
                </td>
            </tr>
        </table>

    </div>
</div>


</div>



</div>