<div class="row">
	<div class="col-md-12 col-sm-12">
		<h1 class="page-header">User Management</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<form method="post">

					<div class="form-group">
						<label for="school">Filter by School</label>
						<?php echo form_dropdown("school", $school_listing, $post['school'], "class='form-control' id='schoolFilter'" . (isset($user) ? " disabled" : "")); ?>

					</div>

					<div class="form-group">
						<label for="staffusi">
							<?php echo form_error('StaffUSI'); ?>
							StaffUSI Full Name
						</label>

						<select class="form-control" id="staffusi" name="user[StaffUSI]" <?php echo (!isset($user)) ? '' : 'disabled'; ?>>
							<option school="reset" value="">Choose a user to add or edit</option>
							<?php foreach ($staff_listing as $staff): ?>

								<option value="<?php echo $staff->StaffUSI ?>" school="<?php echo $staff->EducationOrganization()[0]->EducationOrganizationId ?>" <?php echo ($post['user']['StaffUSI'] == $staff->StaffUSI) ? "selected" : "" ?>>
									<?php echo "$staff->FirstName $staff->LastSurname $staff->StaffUSI" ?>
								</option>
							<?php endforeach; ?>
						</select>

					</div>

					<?php if (isset($user)) : ?>
						<div class="form-group">
							<label for="staffEmail">StaffUSI Email</label>

							<input class="form-control" type="text" value="<?php echo $user->Staff()->Email()[0]->ElectronicMailAddress ?>" disabled>


						</div>
					<?php endif; ?>

					<div class="form-group">
						<label for="role">Role</label>
						<?php echo form_dropdown("user[RoleId]", $role_listing, ($post['user']) ? $post['RoleId'] : "", "class='form-control'"); ?>


					</div>

					<div id="usermanagement-addedit-password" class="form-group">
						<label for="Password">
							<?php echo form_error('Password'); ?>
							Password </label> <input type="text" class="form-control input-sm" name="user[Password]" value="" />
					</div>

					<div id="usermanagement-addedit-authtype" class="checkbox">
						<label for="GoogleAuth">
							<input type="checkbox" name="user[GoogleAuth]" value="1" <?php echo ($post['user']['GoogleAuth']) ? 'checked' : ''; ?>>
							Google Authorization
						</label>
					</div>

					<?php if (isset($user)): ?>
						<input type="hidden" name="user[StaffUSI]" value="<?php echo $user->StaffUSI; ?>">
					<?php endif; ?>

					<button type="submit" class="btn btn-default" id="userAddEdit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</div>
