<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Reports</h1>
        <br/><br/>

        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <a href="<?= site_url('reports/create') ?>"> <button class="btn btn-primary">New Flex Report</button></a>
    </div>
</div>