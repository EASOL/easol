<form action="" method="get" class="form-inline" name="dataGridFormFilter" id="dataGridFormFilter">
    <?php $get = $this->input->get('filter'); ?>
    <?php if (!empty($get)): ?>
        <?php foreach ($get as $key=>$value): ?>
            <?php if ($key == $report->ReportId) continue; ?>
            <?php foreach ($value as $k2=>$v2): ?>
                <input type="hidden" name='filter[<?php echo $key ?>][<?php echo $k2 ?>]' value="<?php echo $v2 ?>">
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endif; ?>
   
    <?php if (!empty($filter)): ?>
        <?php foreach ($filter as $key=>$row): ?>  
            <?php $fieldName = str_replace(".", "-", $row->FieldName); ?>
            <?php if ($row->FilterType == 'Free Text'): ?>
                <div class="form-group">
                    <label for="filter-<?= $key ?>"><?= $row->DisplayName ?></label>
                    <input type='text' name='filter[<?php echo $report->ReportId ?>][<?php echo $fieldName ?>]' class='form-control' value="<?php echo (isset($_GET["filter"][$report->ReportId][$fieldName])) ? $_GET["filter"][$report->ReportId][$fieldName] : system_variable($row->DefaultValue) ?>">
                </div>
            <?php elseif ($row->FilterType == 'Static List' || $row->FilterType == 'Dynamic List'): ?>
                <div class='form-group'>
                    <label for="filter-<?= $key ?>"><?= $row->DisplayName ?></label>
                    
                    <?php echo form_dropdown("filter[{$report->ReportId}][{$fieldName}]", report_filter_options($row->FilterOptions), (isset($_GET["filter"][$report->ReportId][$fieldName])) ? $_GET["filter"][$report->ReportId]["$fieldName"] : system_variable($row->DefaultValue), "class='form-control'"); ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    <?php endif; ?>
</form>
<hr>