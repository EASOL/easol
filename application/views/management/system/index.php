<div class="row">
	<div class="col-md-12 col-sm-12">
		<h1 class="page-header">System Configuration</h1>

		<?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
			<div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
		<?php } ?>
	</div>
</div>

<form method="post" action="<?php echo site_url('management/system') ?>">
	<div class="row">

		<div class="col-md-6 col-sm-12">
			<?php $this->load->view('management/system/_timezone'); ?>
			<?php $this->load->view('management/system/_google_auth'); ?>
			<?php $this->load->view('management/system/_language'); ?>
		</div>

		<div class="col-md-6 col-sm-12">
			<?php $this->load->view('management/system/_modules'); ?>
		</div>
	</div>

</form>
