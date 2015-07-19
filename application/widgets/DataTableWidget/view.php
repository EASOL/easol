<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 3:44 PM
 */
?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php if($filter!=null) { ?>
            <?php  Easol_Widget::show("DataFilterWidget", $filter) ?>
        <?php }    ?>
        <div class="clearfix"></div>
        <?php if($downloadCSV==true){?>
            <div class="pull-right">
                <a href="<?= ($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING']."&downloadcsv=y" : "?downloadcsv=y" ?>"><button class="btn btn-default"><i class="fa fa-download"> </i> Download CSV</button></a>
            </div>
            <div class="clearfix"></div>
        <?php } ?>
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
                            foreach ($query->result() as $row)
                            {
                                ?>
                                <tr>
                                    <?php
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
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


                <?php
            }
        ?>
        <?php if($pagination!=null){ ?>
            <?php Easol_Widget::show("PaginationWidget",$pagination) ?>
        <?php } ?>
    </div>
</div>


