<div class="panel panel-primary">
	<div class="panel-heading default">
		<h3 class="panel-title">Language</h3>
	</div>
	<div class="panel-body default">

		<div class="form-group">
			<label for="timezone">Select your language:</label>
			<?php echo form_dropdown('language', ['english'=>'English'], null, "class='form-control'"); ?>
		</div>

		<input type="submit" class="btn btn-default" value="Save">

	</div>
</div>
