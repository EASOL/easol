<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">User Management</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php echo anchor('usermanagement/addedit','<button class="btn btn-primary pull-right">Add User</button>'); ?>
        <div style="clear:both;">
            <table id="manageusers" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>StaffUSI</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Authorization Type</th>
                            <th>School</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
            			<?php foreach ($users as $key => $user) : ?>
            				<tr>
                                <td><?php echo $user->StaffUSI ?></td>
                                <td><?php echo $user->FirstName .' '. $user->MiddleName .' '. $user->LastSurname ?></td>
                                <td><?php echo $user->RoleTypeName ?></td>
                                <td><?php echo ($user->GoogleAuth) ? 'Google' : 'Password'; ?></td>
                                <td><?php echo $user->Institutions[0]->NameOfInstitution ?></td>
                                <td>
                                    <a href="<?= site_url("/usermanagement/addedit/$user->StaffUSI") ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                    <a href="<?= site_url("/usermanagement/delete/$user->StaffUSI") ?>" class="usermanagement-index-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                </td>                                    
                            </tr>
            			<?php endforeach; ?>
            		</tbody>
            </table>
        </div>
    </div>
</div>
