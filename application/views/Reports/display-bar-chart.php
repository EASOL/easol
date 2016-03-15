<?php


$ReportData = [];
$ChartFilter = [];
$ChartColors = [];
$Settings = json_decode($model->Settings);

if ($Settings->Type == 'dynamic') {
    $colors = report_colors($Settings->ColorType, $Settings->ColorScheme);
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
    
    foreach ($model->getReportData() as $i=>$data) {
        foreach ($Settings->Columns as $column) {
            $value = $data->{$Settings->Variable};

            $operator = $column->Operator;
            if (report_value_fits($value, $column->Value, $operator)) $ReportData[$column->Label]++;

            $ChartFilter[$column->Label] = $column;
             if (!$column->Color) $column->Color = report_colors('sequential', $i);
            $ChartColors[$column->Label] = $column->Color;
        }
    }
}


$ChartData = [];
$i = 0;
foreach($ReportData as $key=>$value){ 
    if (!isset($ChartColors[$key])) {
        $index = $i % 5;
        $color = $colors[$index];
    }
    else $color = $ChartColors[$key];
   $ChartData[] = ['label'=>$key, 'value'=>$value, 'color'=>$color]; 
   $i++;
}

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
           
            <?php if(($filter = $model->getFilters()) && !$hideFilters): ?>
                <div class="panel-body" id="filter-destination">
                    <?php $this->load->view('Reports/_report-filters',  ['filter'=>$filter, 'report'=>$model]); ?>
                </div>
            <?php endif;   ?>
           

            <div class="panel-body">
               

                <div data-context="<?php echo $this->router->fetch_class() ?>" id="chart-<?php echo $model->ReportId ?>" data-type="<?php echo $Settings->Type ?>" data-report-id="<?php echo $model->ReportId ?>" data-variable="<?php echo $Settings->Variable ?>" class='bar-chart chart' data-chart-data='<?php echo json_encode($ChartData) ?>' data-chart-filter='<?php echo json_encode($ChartFilter) ?>' data-xaxis-label="<?php echo $Settings->LabelY ?>" data-yaxis-label="<?php echo $Settings->LabelX ?>">
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