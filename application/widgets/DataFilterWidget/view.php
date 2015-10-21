<?php

?>
<form action="" method="get" class="form-inline" name="dataGridFormFilter" id="dataGridFormFilter">
    <?php /* die(print_r($fields)); */ foreach($fields as $key => $field){ ?>
        <?php if( array_key_exists('access',$field) && !Easol_AuthorizationRoles::hasAccess($field['access'])) continue; ?>

        <?php if($key=="Sort") { ?>
            <input type="hidden" name="filter[Sort][column]" value="<?= $field['defaultColumn'] ?>" >
            <input type="hidden" name="filter[Sort][type]" value="<?= $field['defaultSortType'] ?>" >
        <?php continue; } ?>

        <?php if($key=='Result'){?>
            <input type="hidden" name="filter[Result]" value="<?= $field['default'] ?>" id="filter-form-result">

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

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>
<hr>