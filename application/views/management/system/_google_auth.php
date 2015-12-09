<div class="panel panel-primary">
	<div class="panel-heading default">
		<h3 class="panel-title">Google Auth</h3>
	</div>
	<div class="panel-body default">

		<div class="form-group">
			<label for="timezone">Allow Google Auth:</label>
			<input <?php echo ($google_auth['enabled'] == 'yes') ? "checked" : "" ?> data-toggle="toggle" type="checkbox" name="google_auth[enabled]" value="yes">
		</div>

		<div class="form-group">
			<label for="timezone">Google App Identificator:</label>
			<input type="text" name="google_auth[app_id]" value="<?php echo $google_auth['app_id'] ?>" class="form-control">
		</div>

		<input type="submit" class="btn btn-default" value="Save">

	</div>
</div>
