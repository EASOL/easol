<?php extract($results); ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?php echo $school[0]->NameOfInstitution; ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <button id="schoolmanagement-details-form-enable" class="btn btn-primary">Edit School Configurations</button>
        <?php echo anchor('schoolmanagement/addschooldetails/'.$school[0]->SchoolId ,'<button class="btn btn-primary pull-right">Add a Configuration value</button>'); ?>
        <div style="clear:both; margin:25px 0;">
            <form id="schoolmanagement-details-form" method="post">
                <table id="manageschooldetails" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Configuration Item</th>
                                <th>Value</th>
                                <th>Delete</th>                                
                            </tr>
                        </thead>
                        <tbody>
                			<?php foreach ($details as $index => $obj) : ?>
                				<tr>
                                    <td><?php echo $obj->Key ?></td>
                                    <td><input name="<?php echo $obj->Key ?>" value="<?php echo $obj->Value ?>" disabled /></td>                                  
                                     <td><input type="checkbox" name="delete[]" value="<?php echo $obj->Key ?>" disabled /></td>
                                </tr>
                			<?php endforeach; ?>
                		</tbody>
                </table>
            </form>
        </div>
    </div>
</div>
