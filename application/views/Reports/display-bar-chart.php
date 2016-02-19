<?php


$ReportData = [];
$Settings = json_decode($model->Settings);

if ($Settings->Type == 'dynamic') {
    foreach ($model->getReportData() as $data) {
        $ReportData[$data->{$Settings->Variable}]++;
    }
}
ksort($ReportData);

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
                <style>

                    svg {
                        display: block;
                    }
                     .bar-chart, svg {
                        margin: 0px;
                        padding: 0px;
                        height: 100%;
                        width: 100%;
                    }

                </style>

                <div id="chart-<?php echo $model->ReportId ?>" data-report-id="<?php echo $model->ReportId ?>" data-variable="<?php echo $Settings->Variable ?>" class='bar-chart chart'>
                    <svg></svg>
                </div>

                <script>
                    historicalBarChart = [
                        {
                            key: "Cumulative Return",
                            values: <?= json_encode($ChartData) ?>
                        }
                    ];
                    nv.addGraph(
                        function() {
                            var chart = nv.models.discreteBarChart()
                                    .x(function(d) { return d.label })
                                    .y(function(d) { return d.value })
                                    .staggerLabels(true)
                                    .valueFormat(d3.format(".0f"))
                                    .staggerLabels(historicalBarChart[0].values.length > 8)
                                    .showValues(true)
                                    .duration(250)
                                ;
                           // chart.xAxis.y
                            chart.yAxis.tickFormat(d3.format('.0f'));
                            chart.yAxis.axisLabel('<?= $Settings->LabelY ?>');
                            chart.xAxis.axisLabel('<?= $Settings->LabelX ?>').axisLabelDistance(-6);
                            d3.select('#chart-<?php echo $model->ReportId ?> svg')
                                .datum(historicalBarChart)
                                .call(chart);
                            nv.utils.windowResize(chart.update);
                            return chart;
                        }, 
                        function() {
                            d3.selectAll(".nv-bar").on('click', function(e){
                                var $chart = 
                                chart_filter("<?php echo $model->ReportId ?>", e.label, '<?php echo $Settings->Variable ?>', $(this));
                            });
                        }
                    );
                </script>
                <!-- <div>
                    <h3><span class="fa fa-arrow-right"></span> < $model->LabelX ></h3>
                    <h3><span class="fa fa-arrow-up"></span> < $model->LabelY ></h3>
                </div> -->
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