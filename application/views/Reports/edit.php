<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Flex Reports</h1>
        <?php if ($this->session->flashdata('message') && $this->session->flashdata('type')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('type') ?>"> <?= $this->session->flashdata('message') ?> </div>
        <?php } ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <?php $this->load->view("Reports/_form",['model' => $model]); ?>
            </div>
        </div>
    </div>
</div>