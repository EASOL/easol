<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Dashboard</h1>
        <br/><br/>

        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>