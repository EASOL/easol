<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 3:44 PM
 */

$groupColumnName='Days';
$noOfColums=3;

$replace=[];
$replacements=[];
Easol_Helper::$tableGroupValue=null;

ob_start();
?>
<?php if($filter!=null) { ?>
    <div class="row" style="padding-bottom: 40px">
        <?php  Easol_Widget::show("DataFilterWidget", $filter) ?>
    </div>
    <div class="clearfix"></div>
    <?php if($downloadCSV==true){ ?>
        <div class="pull-right">
            <a href="<?= ($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING']."&downloadcsv=y" : "?downloadcsv=y" ?>"><button><i class="fa fa-download"> </i> Download CSV</button></a>
        </div>
        <div class="clearfix"></div>
    <?php } ?>

<?php }    ?>
<?php
if ($query->num_rows() > 0 && count($columns) > 0)
    {
        ?>

        <div class="dataTableGrid">
            <table class="table">
                <thead>
                    <tr>
                        <?php
                            foreach($columns as $column){
                                if(is_array($column)){
                                    $colName = $column['title'];
                                }
                                else
                                    $colName = $column;

                                ?>
                                <th><?= $colName ?></th>
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



