<?php 
    $filter = $model->getFilters();
    $ReportData = $this->db->query($model->getReportQuery()); 
    $_columns=[];

    if (!empty($ReportData)) {
        foreach($ReportData->list_fields() as $key){
            $_columns[] = $key;
        }
    }
?>

<?php if($displayTitle==true){ ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header"><?= $model->ReportName ?></h1>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">

            <?php if($filter!= null) { ?>
                <div class="panel-body" id="filter-destination">
                    <?php  Easol_Widget::show("DataFilterWidget", ['filter'=>$filter, 'report'=>$model]) ?>
                </div>
            <?php }    ?>

            <div class="panel-body">
                <?php include('display-table-view.php'); ?>
            </div>
        </div>
    </div>
</div>