<div class="row">
	<div class="col-md-12 col-sm-12">
		<h1 class="page-header">User Management</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<?php echo anchor('management/user/save', '<button class="btn btn-primary pull-right pre-data-table">Add User</button>'); ?>
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
							<?php if (!$user->Staff()->Email()): ?>
								<span class="alert alert-danger alert-small" data-toggle="tooltip" data-placement="right" title="Missing email address">	<?php echo ($user->StaffUSI) ? $user->StaffUSI : 'Error'; ?>
								</span>
							<?php else: ?>
								<?php echo ($user->StaffUSI) ? $user->StaffUSI : 'Error'; ?>
							<?php endif; ?>
						</td>
						<td>
							<?php if (!$user->Staff()->FirstName and !$user->Staff()->LastSurname): ?>
								<span class="alert alert-danger alert-small">missing</span>
							<?php else: ?>
								<?php echo $user->Staff()->FirstName . ' ' . $user->Staff()->MiddleName . ' ' . $user->Staff()->LastSurname; ?>
							<?php endif; ?>
						</td>
						<td>
							<?php echo ($user->Role()->RoleTypeName) ? $user->Role()->RoleTypeName : '<span class="alert alert-danger alert-small">missing</span>'; ?>
						</td>
						<td>
							<?php
							if ($user->GoogleAuth === '')
								echo '<span class="alert alert-danger alert-small">missing</span>';
							else
								echo ($user->GoogleAuth) ? 'Google' : 'Password';
							?>
						</td>
						<td>
							<?php if ($school = $user->Staff()->EducationOrganization()[0]): ?>
								<?php echo $school->NameOfInstitution; ?>
							<?php else: ?>
								<span class="alert alert-danger alert-small">missing</span>
							<?php endif; ?>
						</td>
						<td>
							<?php
							if (!$user->StaffUSI) : ?>
								<span class="alert alert-danger alert-small" data-toggle="tooltip" data-placement="left" title="Cant edit/delete without a StaffUSI">Error</span>
							<?php else : ?>
								<a href="<?= site_url("/management/user/save/$user->StaffUSI") ?>"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="<?= site_url("/management/user/delete/$user->StaffUSI") ?>" class="usermanagement-index-delete"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			<div style="padding-top: 0.25em;" class="pull-right form-group">                   
                <div id="csv-button"></div>
            </div>
		</div>
	</div>
</div>
