<div class="panel panel-primary">
	<div class="panel-heading default">
		<h3 class="panel-title">Modules</h3>
	</div>
	<div class="panel-body default">

		<ul class="list-group">
			<?php foreach ($module_listing as $k => $row): ?>
				<li class="list-group-item">
					<input <?php echo (isset($module[$k])) ? "checked" : "" ?> data-toggle="toggle" type="checkbox" name="module[<?php echo $k ?>]" value="1"> <?php echo $row ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<input type="submit" class="btn btn-default" value="Save">

	</div>
</div>
