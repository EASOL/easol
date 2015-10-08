<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">User Management</h1>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <?php echo anchor('usermanagement/addedit','<button class="btn btn-primary pull-right pre-data-table">Add User</button>'); ?>
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
                                <td>
                                    <?php
                                        $valid = true;
                                        $tooltip = "missing data in field ";
                                        foreach($user as $k => $v)
                                        {
                                            if ($v === '') {
                                                $valid = false;
                                                $tooltip .= $k . ',';
                                            }
                                         }
                                        $tooltip = mb_strimwidth(rtrim($tooltip, ','), 0, 40, "...");
                                        if (!$valid) : ?>
                                            <span class="alert alert-danger alert-small" data-toggle="tooltip" data-placement="right" title="<?php echo $tooltip; ?>"><?php echo (!empty($user->StaffUSI)) ? $user->StaffUSI : 'Error'; ?></span>
                                        <?php else : echo $user->StaffUSI; endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        if (empty($user->FirstName) or empty($user->LastSurname))
                                            echo '<span class="alert alert-danger alert-small">missing</span>';
                                        else 
                                            echo $user->FirstName .' '. $user->MiddleName .' '. $user->LastSurname;
                                    ?>
                                </td>
                                <td><?php echo (!empty($user->RoleTypeName)) ? $user->RoleTypeName : '<span class="alert alert-danger alert-small">missing</span>'; ?></td>
                                <td>
                                    <?php 
                                        if ($user->GoogleAuth === '') 
                                            echo '<span class="alert alert-danger alert-small">missing</span>';
                                        else 
                                            echo ($user->GoogleAuth) ? 'Google' : 'Password'; 
                                        ?>
                                </td>
                                <td><?php echo (isset($user->Institutions[0]->NameOfInstitution)) ? $user->Institutions[0]->NameOfInstitution : '<span class="alert alert-danger alert-small">missing</span>'; ?></td>
                                <td>
                                    <?php
                                         if (empty($user->StaffUSI)) : ?>
                                            <span class="alert alert-danger alert-small" data-toggle="tooltip" data-placement="left" title="Cant edit/delete without a StaffUSI">Error</span>
                                        <?php else : ?>    
                                            <a href="<?= site_url("/usermanagement/addedit/$user->StaffUSI") ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                            <a href="<?= site_url("/usermanagement/delete/$user->StaffUSI") ?>" class="usermanagement-index-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
                                        <?php endif; ?>
                                </td>                                                                   
                            </tr>
            			<?php endforeach; ?>
            		</tbody>
            </table>
        </div>
    </div>
</div>
