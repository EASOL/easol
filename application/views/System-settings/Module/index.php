<div class="row">
	<div class="col-md-12 col-sm-12">
		<h1 class="page-header">Modules Management</h1>

		<?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
			<div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12">

		<form method="post" action="<?php echo site_url('system-settings/module') ?>">
			<ul class="list-group">
				<?php foreach ($listing as $k=>$row): ?>
				<li class="list-group-item">
					<input <?php echo (isset($configuration[$k])) ? "checked" : "" ?> data-toggle="toggle" type="checkbox" name="module[<?php echo $k ?>]" value="<?php echo $k ?>"> <?php echo $row ?>
				</li>
				<?php endforeach; ?>
			</ul>

			<input type="submit" class="btn btn-default" value="Save">
		</form>

	</div>
</div>
