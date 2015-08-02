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

<div id="tableContainer" class="dmTableContainer">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable">
        <thead class="fixedHeader" id="fixedHeader">
        <tr class="alternateRow">
            <th><a href="#">Header 1</a></th>
            <th><a href="#">Header 2</a></th>
            <th><a href="#">Header 3</a></th>
        </tr>
        </thead>
        <tbody class="scrollContent">
        <tr class="normalRow">
            <td>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nulla vitae wisi. Nulla euismod aliquet tellus.</td>
            <td>In sit amet enim. Praesent vulputate tortor nec ante. Morbi sollicitudin est non neque.</td>
            <td>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.</td>
        </tr>
        <tr class="alternateRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td><select name="sampleSelect1" id="sampleSelect1"><option>Option 1</option><option>Option 2</option><option>Option 3</option><option>Option 4</option><option>Option 5</option></select></td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td><select name="sampleSelect2" id="sampleSelect2" size="5" multiple="multiple"><option>Option 1</option><option>Option 2</option><option>Option 3</option><option>Option 4</option><option>Option 5</option></select></td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td><input type="text" name="sampleText" id="sampleText" value="This is a sample Text form element"></td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td><input type="password" name="samplePassword" id="samplePassword" value="password"></td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td><input type="submit" name="sampleSubmit" id="sampleSubmit" value="Sample Submit Button"></td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td><input type="reset" name="sampleReset" id="sampleReset" value="Sample Reset Button"></td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td><input type="button" name="sampleButton" id="sampleButton" value="Sample Button Element"></td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td><input type="checkbox" name="sampleCheckbox" id="sampleCheckboxA" value="sampleCheckboxA"> <label for="sampleCheckboxA">Sample Checkbox A</label></td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td><input type="checkbox" name="sampleCheckbox" id="sampleCheckboxB" value="sampleCheckboxB"> <label for="sampleCheckboxB">Sample Checkbox B</label></td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td><input type="radio" name="sampleRadio" id="sampleRadioA" value="sampleRadioA"> <label for="sampleRadioA">Sample Radio A</label></td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td><input type="radio" name="sampleRadio" id="sampleRadioB" value="sampleRadioB"> <label for="sampleRadioB">Sample Radio B</label></td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td><select name="sampleSelect3" id="sampleSelect3"><option>Option 1</option><option>Option 2</option><option>Option 3</option><option>Option 4</option><option>Option 5</option></select></td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td><select name="sampleSelect4" id="sampleSelect4" size="5" multiple="multiple"><option>Option 1</option><option>Option 2</option><option>Option 3</option><option>Option 4</option><option>Option 5</option></select></td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td><textarea cols="20" rows="5" name="sampleTextarea" id="sampleTextarea">Cell Content 3</textarea></td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td><select name="sampleSelect5" id="sampleSelect5"><option>Option 1</option><option>Option 2</option><option>Option 3</option><option>Option 4</option><option>Option 5</option></select></td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td><select name="sampleSelect6" id="sampleSelect6"><option>Option 1</option><option>Option 2</option><option>Option 3</option><option>Option 4</option><option>Option 5</option></select></td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td>Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td>Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td>Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td>Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td>Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>And Repeat 1</td>
            <td>And Repeat 2</td>
            <td>And Repeat 3</td>
        </tr>
        <tr class="normalRow">
            <td>Cell Content 1</td>
            <td>Cell Content 2</td>
            <td>Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>More Cell Content 1</td>
            <td>More Cell Content 2</td>
            <td>More Cell Content 3</td>
        </tr>
        <tr class="normalRow">
            <td>Even More Cell Content 1</td>
            <td>Even More Cell Content 2</td>
            <td>Even More Cell Content 3</td>
        </tr>
        <tr class="alternateRow">
            <td>End of Cell Content 1</td>
            <td>End of Cell Content 2</td>
            <td>End of Cell Content 3</td>
        </tr>
        </tbody>
    </table>
</div>
