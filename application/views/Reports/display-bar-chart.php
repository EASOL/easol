<?php /* @var $model Easol_Report */ ?>

<?php
$jsonData=[];
$_i=0;
$axisX="";
$axisY="";
foreach($model->getReportData() as $data){
    $_j=0;
    foreach($data as $key => $property){
        if($_j==0){
            if($_i==0)
                $axisX = $key;
            $jsonData[$_i]['label'] = $property;
        }
        else{
            if($_i==0)
                $axisY = $key;
            $jsonData[$_i]['value'] = $property;
        }
        $_j++;
    }
    $_i++;
}

//die(json_encode($jsonData));
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Flex Reports : Bar Chart : <?= $model->ReportName ?></h1>
        <br/><br/>
    </div>
</div>

<div class="row">
    <div class="col-md-12" >
        <style>

            svg {
                display: block;
            }
             #chart1, svg {
                margin: 0px;
                padding: 0px;
                height: 100%;
                width: 100%;
            }

        </style>

        <div id="chart1">
            <svg></svg>
        </div>

        <script>
            historicalBarChart = [
                {
                    key: "Cumulative Return",
                    values: <?= json_encode($jsonData) ?>
                }
            ];
            nv.addGraph(function() {
                var chart = nv.models.discreteBarChart()
                        .x(function(d) { return d.label })
                        .y(function(d) { return d.value })
                        .staggerLabels(true)
                        .staggerLabels(historicalBarChart[0].values.length > 8)
                        .showValues(true)
                        .duration(250)
                    ;
               // chart.xAxis.y
                chart.yAxis.tickFormat(d3.format(',.2f'));
                chart.yAxis.axisLabel('<?= $model->LabelY ?>');
                chart.xAxis.axisLabel('<?= $model->LabelX ?>').axisLabelDistance(-6);
                d3.select('#chart1 svg')
                    .datum(historicalBarChart)
                    .call(chart);
                nv.utils.windowResize(chart.update);
                return chart;
            });
        </script>
        <div>
            <h3><span class="fa fa-arrow-right"></span> <?= $model->LabelX ?></h3>
            <h3><span class="fa fa-arrow-up"></span> <?= $model->LabelY ?></h3>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>


</div>