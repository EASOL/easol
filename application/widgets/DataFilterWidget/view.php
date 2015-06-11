<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/8/2015
 * Time: 12:49 AM
 */
?>
<div class="row">
    <form action="" method="get" class="form-inline">
        <div class="col-md-12">
            <?php foreach($fields as $key => $field){ ?>
                <?php if( array_key_exists('access',$field) && !Easol_AuthorizationRoles::hasAccess($field['access'])) continue; ?>
                <div class="form-group">
                    <label for="filter-<?= $key ?>"><?= $field['label'] ?></label>
                    <?php if($field['type']=='dropdown') { ?>
                        <select class="form-control" name="filter[<?= $key ?>]">
                            <?php if(array_key_exists('prompt',$field)) { ?>
                                <option value="" <?php if($field['prompt']==$field['default']) echo 'selected' ?>><?= $field['prompt'] ?></option>
                            <?php } ?>
                            <?php
                                if(isset($field['query'])){
                                    foreach($field['query']->result() as $row){
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
                                        foreach($field['range']['set'] as $key => $value){
                                            ?>
                                            <option value="<?= $key ?>" <?php if($value==$field['default']) echo 'selected' ?>><?= $value ?></option>
                                        <?php
                                        }

                                    }
                                }
                            ?>

                        </select>
                <?php } ?>
                </div>


            <?php } ?>
            <button type="submit" class="btn btn-default">Filter</button>
        </div>
    </form>

</div>