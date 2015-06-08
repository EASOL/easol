<?php
/**
 * User: Nahid Hossain
 * Email: mail@akmnahid.com
 * Phone: +880 172 7456 280
 * Date: 6/3/2015
 * Time: 3:44 PM
 */

if ($query->num_rows() > 0 && count($columns) > 0)
    {
        ?>
        <?php if($filter!=null) { ?>
        <div class="row" style="padding-bottom: 40px">
            <?php  Easol_Widget::show("DataFilterWidget", $filter) ?>
        </div>
        <div class="clearfix"></div>
        <?php }    ?>
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
                                            if($colType=='url'){
                                                ?>
                                                <a href="<?= $column['url']($row) ?>"><?= $row->$colName ?></a>
                                                <?php

                                            }
                                            else {
                                            ?>
                                            <?= $row->$colName ?>
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


