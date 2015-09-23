<?php echo anchor('schoolmanagement/addedit','<button class="btn btn-primary pull-right">Add a Configuration value</button>'); ?>
<div style="clear:both;">
    <table id="manageschooldetails" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Configuration Item</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                 <tr>
                    <th>Configuration Item</th>
                    <th>Value</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
    			<?php foreach ($details as $index => $obj) : ?>
    				<tr>
                        <td><?php echo $obj->Key ?></td>
                        <td><?php echo $obj->Value ?></td>
                        <td>
                            <a href="<?= site_url("/schoolmanagement/addedit/$obj->EducationOrganizationId/$obj->Key/$obj->Value") ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                            <a href="<?= site_url("/schoolmanagement/delete/$obj->EducationOrganizationId/$obj->Key") ?>" class="usermanagement-index-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                        </td>                                    
                    </tr>
    			<?php endforeach; ?>
    		</tbody>
    </table>
</div>
