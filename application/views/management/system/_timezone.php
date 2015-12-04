<div class="panel panel-primary">
	<div class="panel-heading default">
		<h3 class="panel-title">Time Zone</h3>
	</div>
	<div class="panel-body default">

		<div class="form-group">
			<label for="timezone">Select your time zone:</label>
			<?php echo form_dropdown('timezone', timezone_listing(), $timezone, "class='form-control'"); ?>
		</div>

		<input type="submit" class="btn btn-default" value="Save">

	</div>
</div>
