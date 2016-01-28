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
    <?php /* die(print_r($fields)); */ foreach($fields as $key => $field){ ?>
        <?php if( array_key_exists('access',$field) && !Easol_AuthorizationRoles::hasAccess($field['access'])) continue; ?>

        <?php if($key=="Sort") { ?>
            <input type="hidden" name="filter[Sort][column]" value="<?= $field['defaultColumn'] ?>" >
            <input type="hidden" name="filter[Sort][type]" value="<?= $field['defaultSortType'] ?>" >
        <?php continue; } ?>

        <?php if($key=='Result'){?>
            <input type="hidden" name="filter[Result]" value="<?= $field['default'] ?>" id='filter-form-result'>
            <!-- 
            <div class="form-group">
                <?php // echo form_dropdown('filter[Result]', ['0' => '25', '1' => '50', '2' => '100'], $field['default'], "class='form-control' id='filter-form-result'"); ?>
                <label for="filter-PageLength">Records Per Page</label>
            </div>
             -->

        <?php continue; } ?>

        <?php if($field['type']=='dataSort'){ ?>
		<div class="form-group <?= $field['type'] ?>">
			<label for="filter-<?= $key ?>"><?= $field['label'] ?></label>
			<select class="form-control" name="filter[<?= $key ?>][column]">
			    <?php foreach($field['columns'] as $colKey => $colValue){ ?>
				<option <?= ($colKey==$field['defaultColumn']) ? "selected" : ""  ?> value="<?= $colKey ?>"><?= $colValue ?></option>
			    <?php } ?>
			</select>
		</div>
	
		<div class="form-group">
		    <label for="filter-<?= $key ?>-type"><?= $field['sortTypeLabel'] ?></label>
		    <select class="form-control" name="filter[<?= $key ?>][type]">
			<?php foreach($field['sortTypes'] as $sortTypeKey => $sortTypeValue) {  ?>
			    <option <?= ($sortTypeKey==$field['defaultSortType']) ? "selected" : ""  ?> value="<?= $sortTypeKey ?>"><?= $sortTypeValue ?></option>
			<?php } ?>
		    </select>
		</div>

                <?php continue; ?>
        <?php } ?>

        
        <?php if( ( $field['label']=='Educator' ) && !Easol_AuthorizationRoles::hasAccess( ['System Administrator','Data Administrator'] ) ) {} else { ?>
        <?php if( $field['type']=='dropdown' ) { ?>
          <div class="form-group">
                <label for="filter-<?= $key ?>"><?= $field['label'] ?></label>

                <select class="form-control" name="filter[<?= $key ?>]">
                    <?php if(array_key_exists('prompt',$field)) { ?>
                        <option value="" <?php if($field['prompt']==$field['default']) echo 'selected' ?>><?= $field['prompt'] ?></option>
                    <?php } ?>
                    <?php
                        if(isset($field['query'])){
                            foreach($field['query']->result() as $row){

                            	    if($field['default']=="" || $field['default']==null) {$field['default'] = -4;}

                                ?>
                                    <option value="<?= $row->$field['indexColumn'] ?>" <?php if($row->$field['indexColumn']==$field['default']) echo 'selected' ?>><?= $row->$field['textColumn'] ?></option>
                                <?php
                            }
                        }
                        elseif(isset($field['range'])){
                            if($field['range']['type']=='dynamic'){
                                for($i=$field['range']['start'];$i<=$field['range']['end'];$i+=$field['range']['increament']){

                                ?>
                                    <option value="<?= $i ?>" <?php if($i==$field['default']) echo 'selected' ?>><?= $i ?></option>
                                <?php
                                }

                            } elseif($field['range']['type']=='set'){
                                foreach($field['range']['set'] as $setKey => $value){
                                    ?>

                                    <option value="<?= $setKey ?>" <?php if($setKey==$field['default']) echo 'selected' ?>><?= $value ?></option>
                                <?php
                                }

                            }
                        }
                    ?>
                </select>
          </div>
        <?php }} ?>

    <?php } ?>
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