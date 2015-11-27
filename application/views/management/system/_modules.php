<div class="panel panel-primary">
	<div class="panel-heading default">
		<h3 class="panel-title">Modules</h3>
	</div>
	<div class="panel-body default">

		<?php foreach ($module_listing as $k => $row): ?>
			<h4 class="bg-success section-title clearfix">
				<?php echo $row['label'] ?>
				<div class="pull-right"><input <?php echo (isset($module[$k]['enabled'])) ? "checked" : "" ?> data-toggle="toggle" type="checkbox" name="module[<?php echo $k ?>][enabled]" value="1"></div>
			</h4>


			<?php foreach ($row['config'] as $field=>$label): ?>
			<div class="form-group">
				<label><?php echo $label ?>:</label>
				<input type="text" name="module[<?php echo $k ?>][<?php echo $field ?>]" value="<?php echo isset($module[$k][$field]) ? $module[$k][$field] : "" ?>" class="form-control">
			</div>
			<?php endforeach; ?>


		<?php endforeach; ?>


		<input type="submit" class="btn btn-default" value="Save">

	</div>
</div>
