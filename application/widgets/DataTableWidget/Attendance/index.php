<?php


$groupColumnName='Days';
$noOfColums=3;

$replace=[];
$replacements=[];
Easol_Helper::$tableGroupValue=null;

ob_start();
?>
<div class="panel panel-default">
    <div class="panel-body">
<?php if($filter!=null) { ?>
        <?php  Easol_Widget::show("DataFilterWidget", $filter) ?>
    <div class="clearfix"></div>


<?php }    ?>
<?php
if ($query->num_rows() > 0 && count($columns) > 0)
    {
        ?>

        <div class="dataTableGrid">
            <table class="table table-hover table-condensed">
                <thead>
                <tr>
                    <?php
                    foreach($columns as $column){
                        $dbColName='';
                        if(is_array($column)){
                            $colName = $column['title'];
                            $dbColName = $column['name'];
                        }
                        else {
                            $colName = $column;
                            $dbColName = $column;
                        }

                        ?>
                        <?php if(is_array($column) && isset($column['sortable']) && $column['sortable']==true){ ?>
                            <?php
                            $sortIcon = 'glyphicon-sort';
                            $getVars = $_GET;

                            if(!isset($getVars['filter'])){
                                $getVars['filter']=[];
                            }

                            $getVars['filter']['Sort'] = [];
                            $getVars['filter']['Sort']['column'] = $column['sortField'];
                            $getVars['filter']['Sort']['type'] = 'ASC';
                            if(isset($_GET['filter']) && isset($_GET['filter']['Sort']['type']) && $_GET['filter']['Sort']['column'] == $column['sortField']){
                                if($_GET['filter']['Sort']['type']=='ASC') {
                                    $sortIcon = 'glyphicon-sort-by-attributes';
                                    $getVars['filter']['Sort']['type'] = 'DESC';
                                }
                                else {
                                    $sortIcon = 'glyphicon-sort-by-attributes-alt';
                                }

                            }


                            ?>
                            <th ><a href="<?= (explode("/?",$_SERVER['REQUEST_URI'])[0]) ?>/?<?= http_build_query($getVars); ?>"><?= $colName ?> <span class="glyphicon <?= $sortIcon ?>"> </span></a></th>

                        <?php } else { ?>
                            <th><?= $colName ?></th>
                        <?php } ?>
                        <?php
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $rowNum=1;
                    foreach ($query->result() as $row)
                    {

                            if($row->CodeValue=='In Attendance'){
                                $replacements['c'.$rowNum.'1']=$row->Days;
                            }
                            elseif($row->CodeValue=='Excused Absence'){
                                $replacements['c'.$rowNum.'2']=$row->Days;
                            }
                            elseif($row->CodeValue=='Unexcused Absence'){
                                $replacements['c'.$rowNum.'3']=$row->Days;
                            }

                        if(Easol_Helper::$tableGroupValue==$row->StudentUSI)
                           continue;
                        Easol_Helper::$tableGroupValue=$row->StudentUSI;
                        ?>
                        <tr>
                            <?php
                            $colGroup=1;
                            foreach($columns as $column){
                                $colType='text';
                                if(is_array($column)){
                                    $colName = $column['name'];
                                    if(array_key_exists('type',$column))
                                        $colType=$column['type'];
                                }
                                else
                                    $colName = $column;


                                ?>
                                <td>
                                    <?php if(isset($row->$colName)) { ?>
                                        <?php
                                            $value=$row->$colName;
                                            if(isset($column['value'])){
                                                $value=$column['value']($row);
                                            }
                                        //if($code)
                                            if($colName==$groupColumnName){
                                                $value='c'.$rowNum.$colGroup;
                                                $replace[]=$value;
                                                $colGroup++;
                                            }





                                        ?>
                                            <?php
                                            if($colType=='url'){
                                                ?>
                                                <a href="<?= $column['url']($row) ?>"><?= $value ?></a>
                                            <?php

                                            }
                                            else {
                                            ?>
                                            <?= $value ?>
                                            <?php } ?>
                                    <?php } ?>

                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        $rowNum++;
                    }
                    ?>
                </tbody>
            </table>
        </div>


        <?php
    }
$dataContents = ob_get_contents();
ob_end_clean();

foreach($replace as $rep) {
    if(array_key_exists($rep,$replacements)) {
        $value = $replacements[$rep];
    }
    else
        $value='-';
    $dataContents=str_replace($rep,$value,$dataContents);

}
echo $dataContents;
?>
<?php if($pagination!=null){ ?>
    <?php Easol_Widget::show("PaginationWidget",$pagination) ?>
<?php } ?>


        <div class="col-md-4 pull-right">
            <?php if(isset($filter) && isset($filter['fields']) && isset($filter['fields']['Result'])) { ?>
                <div class="col-md-5">
                    <select class="form-control" id="filter-result" >
                        <?php
                        foreach($filter['fields']['Result']['range']['set'] as $key => $value){
                            ?>
                            <option value="<?= $key ?>" <?php if($key==$filter['fields']['Result']['default']) echo 'selected' ?>><?= $value ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            <?php } ?>
            <?php if($downloadCSV==true){?>
                <div class="col-md-7">

                    <a href="<?= ($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING']."&downloadcsv=y" : "?downloadcsv=y" ?>"><button class="btn btn-default"><i class="fa fa-download"> </i> Download CSV</button></a>
                </div>
            <?php } ?>

        </div>
        <div class="clearfix"></div>

    </div>
</div>


