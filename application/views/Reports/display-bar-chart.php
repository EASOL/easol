<?php

$time_start = microtime(true);

$ReportData = [];
$ChartFilter = [];
$ChartColors = [];
$Settings = json_decode($model->Settings);
$variable = str_replace(array("[", "]", "`"), "", $Settings->Variable);
if (strpos($variable, ".") !== false) $variable = substr(strrchr($variable, '.'), 1);

$ReportQuery = $this->db->query($model->getReportQuery());

if ($Settings->Type == 'dynamic') {
    $colors = report_colors($Settings->ColorType, $Settings->ColorScheme);
    foreach ($ReportQuery->result() as $data) {       
        $ReportData[$data->{$variable}]++;
        $ChartFilter[$data->{$variable}] = $data->{$variable}; 
    }
    ksort($ReportData);
}
elseif ($Settings->Type == 'defined') {
    foreach ($Settings->Columns as $column) {
        $ReportData[$column->Label] = 0;
    }
    
    foreach ($ReportQuery->result() as $i=>$data) {
        foreach ($Settings->Columns as $column) {
            $value = $data->{$variable};

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
        <h3 class="page-header"><?= $model->ReportName ?></h3>
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
               

                <div data-context="<?php echo $this->router->fetch_class() ?>" id="chart-<?php echo $model->ReportId ?>" data-type="<?php echo $Settings->Type ?>" data-report-id="<?php echo $model->ReportId ?>" data-variable="<?php echo $variable ?>" class='bar-chart chart' data-chart-data='<?php echo json_encode($ChartData) ?>' data-chart-filter='<?php echo json_encode($ChartFilter) ?>' data-xaxis-label="<?php echo $Settings->LabelX ?>" data-yaxis-label="<?php echo $Settings->LabelY ?>">
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

<?php
/*
$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes other wise seconds
$execution_time = ($time_end - $time_start)/60;

//execution time of the script
echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';

/**/