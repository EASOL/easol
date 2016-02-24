<?php


$ReportData = [];
$ChartFilter = [];
$Settings = json_decode($model->Settings);

if ($Settings->Type == 'dynamic') {
    foreach ($model->getReportData() as $data) {
        $ReportData[$data->{$Settings->Variable}]++;
        $ChartFilter[$data->{$Settings->Variable}] = $data->{$Settings->Variable}; 
    }
    ksort($ReportData);
}
elseif ($Settings->Type == 'defined') {
    foreach ($Settings->Columns as $column) {
        $ReportData[$column->Label] = 0;
    }
    
    foreach ($model->getReportData() as $data) {
        foreach ($Settings->Columns as $column) {
            $value = $data->{$Settings->Variable};

            $operator = $column->Operator;
            if (report_value_fits($value, $column->Value, $operator)) $ReportData[$column->Label]++;

            $ChartFilter[$column->Label] = $column;
        }
    }
}


$ChartData = [];
foreach($ReportData as $key=>$value){ 
   $ChartData[] = ['label'=>$key, 'value'=>$value]; 
}
ksort($ChartData);


//die(print_r($_columns))
?>
<?php if($displayTitle==true){ ?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Flex Reports : Bar Chart : <?= $model->ReportName ?></h1>
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
               

                <div id="chart-<?php echo $model->ReportId ?>" data-type="<?php echo $Settings->Type ?>" data-report-id="<?php echo $model->ReportId ?>" data-variable="<?php echo $Settings->Variable ?>" class='bar-chart chart' data-chart-data='<?php echo json_encode($ChartData) ?>' data-chart-filter='<?php echo json_encode($ChartFilter) ?>' data-xaxis-label="<?php echo $Settings->LabelY ?>" data-yaxis-label="<?php echo $Settings->LabelX ?>">
                    <svg></svg>
                </div>

              
            </div>
        </div>
    </div>
</div>



<?php if($displayTable): ?>
    <?php $filter_option = 'no'; ?>
    <div class="row">
        <div class="col-md-12">
            <?php include('display-table-view.php'); ?>
        </div>
    </div>
<?php endif; ?>