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

        <div class="panel panel-default"  id="dm_association">
            <div class="panel-heading">Objects</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getObjectsList() as $obj) {  ?>
                    <option value="<?= $obj->ID ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right">Show All</div>
        </div>

        <div class="panel panel-default" id="dm_association">
            <div class="panel-heading">Associations</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getAssociationsList() as $obj) {  ?>
                        <option value="<?= $obj->ID ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right">Show All</div>
        </div>

        <div class="panel panel-default" id="dm_type">
            <div class="panel-heading">Types</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getTypesList() as $obj) {  ?>
                        <option value="<?= $obj->ID ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right">Show All</div>
        </div>

        <div class="panel panel-default" id="dm_descriptor">
            <div class="panel-heading">Descriptors</div>
            <div class="panel-body">
                <select class="form-control" size="10">
                    <?php foreach(DataManagementQueries::getDescriptorsList() as $obj) {  ?>
                        <option value="<?= $obj->ID ?>"><?= $obj->TableName ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="panel-footer" style="text-align: right">Show All</div>
        </div>

    </div>
    <div class="col-md-8" id="ajxRes">

    </div>

</div>