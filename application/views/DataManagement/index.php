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
        <h1 class="page-header" id="page-header">Data Management</h1>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">

                <div class="panel panel-default dm_tables"  id="dm_object">
                    <div class="panel-heading">Objects</div>
                    <div class="panel-body">
                        <select class="form-control dm_select" size="10" id="dm_select_obj">
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
                        <select class="form-control dm_select" size="10" id="dm_select_association">
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
                        <select class="form-control dm_select" size="10" id="dm_select_type">
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
                        <select class="form-control dm_select" size="10" id="dm_select_descriptor">
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
                        <div role="tabpanel" class="tab-pane" id="table_upload">
                            <h2 class="tableName"></h2>
                            <div>
                                <div class="container">
                                    <div class="row" style="padding-top:10px;">
                                        <form action="#" method="post" id="dm_upload_form" enctype="multipart/form-data">
                                            <input id="form-table-name" type="hidden" name="tableName" value="" >
                                        <div class="form-group">
                                            <label for="data-up-csv">Filename</label>
                                            <input type="file" id="data-up-csv" name="csvFile" accept="text/csv" required >
                                        </div>
                                        <div class="radio">
                                            <h4>Operation</h4>
                                            <label>
                                                <input type="radio" name="data_action" id="data_action" value="insert" required >
                                                Insert - Insert only new records
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data_action" id="data_action" value="update">
                                                Insert/Update       - Insert new records, update records if match primary key(s)
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="data_action" id="data_action" value="delete">
                                                Delete                 - Delete records by primary keys
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-default">Upload</button>
                                            </div>
                                        </div>
                                        </form>

                                    </div>
                                    <div class="row" style="padding-top:10px;">
                                        <div class="col-xs-10">
                                            <div id="msgBox">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
