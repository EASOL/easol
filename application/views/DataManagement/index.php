<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 7/8/2015
 * Time: 9:52 PM
 */
$this->load->model("DataManagementQueries");
?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Data Management</h1>
        <br/><br/>
    </div>
</div>
<div class="row">
    <div class="col-md-4">

        <div class="panel panel-default dm_tables"  id="dm_object">
            <div class="panel-heading">Objects</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getObjectsList() as $obj) {  ?>
                    <option value="<?= $obj->TableName ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right"><a href="#">Show All</a></div>

        </div>

        <div class="panel panel-default dm_tables" id="dm_association">
            <div class="panel-heading">Associations</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getAssociationsList() as $obj) {  ?>
                        <option value="<?= $obj->TableName ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right"><a href="#">Show All</a></div>

        </div>

        <div class="panel panel-default dm_tables" id="dm_type">
            <div class="panel-heading">Types</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getTypesList() as $obj) {  ?>
                        <option value="<?= $obj->TableName ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right"><a href="#">Show All</a></div>
        </div>

        <div class="panel panel-default dm_tables" id="dm_descriptor">
            <div class="panel-heading">Descriptors</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getDescriptorsList() as $obj) {  ?>
                        <option value="<?= $obj->TableName ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right"><a href="#">Show All</a></div>
        </div>

    </div>
    <div class="col-md-8" id="ajxRes">
        <div id="ajxTabDisplay" style="display: none">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="dm_data_tabs">
                <li role="presentation" class="active"><a href="#table_info" aria-controls="table_info" role="tab" data-toggle="tab">Table Information</a></li>
                <li role="presentation"><a href="#table_browse" aria-controls="table_browse" role="tab">Browse Data</a></li>
                <li role="presentation"><a href="#table_upload" aria-controls="table_upload" role="tab">Upload Data</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="table_info"></div>
                <div role="tabpanel" class="tab-pane" id="table_browse"></div>
                <div role="tabpanel" class="tab-pane" id="table_upload"></div>
            </div>

        </div>

    </div>

</div>
