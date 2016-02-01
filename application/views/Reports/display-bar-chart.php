<?php /* @var $model Easol_Report */ ?>

<?php
$jsonData=[];
$_i=0;
$axisX="";
$axisY="";
$_colums=[];
foreach($model->getReportData() as $data){
    $_j=0;
    foreach($data as $key => $property){
        if($_i==0){

            $_columns[] = $key;
        }
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
            <div class="panel-body">
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
                                .valueFormat(d3.format(".0f"))
                                .staggerLabels(historicalBarChart[0].values.length > 8)
                                .showValues(true)
                                .duration(250)
                            ;
                       // chart.xAxis.y
                        chart.yAxis.tickFormat(d3.format('.0f'));
                        chart.yAxis.axisLabel('<?= $model->LabelY ?>');
                        chart.xAxis.axisLabel('<?= $model->LabelX ?>').axisLabelDistance(-6);
                        d3.select('#chart1 svg')
                            .datum(historicalBarChart)
                            .call(chart);
                        nv.utils.windowResize(chart.update);
                        return chart;
                    });
                </script>
                <!-- <div>
                    <h3><span class="fa fa-arrow-right"></span> < $model->LabelX ></h3>
                    <h3><span class="fa fa-arrow-up"></span> < $model->LabelY ></h3>
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php if(isset($pageNo)){ ?>
<div class="row">
    <div class="col-md-12">
        <?php Easol_Widget::show("DataTableWidget",
            [
                'query' => preg_replace("/ORDER BY.*?(?=\\)|$)/mi"," ", clean_subquery($model->CommandText)),
                'pagination' => [

                    'pageSize' => EASOL_PAGINATION_PAGE_SIZE,
                    'currentPage' => $pageNo,
                    'url'   =>  'reports/view/'.$model->ReportId.'/@pageNo'
                ],
                'colOrderBy'    =>  [$_columns[0]],
                'columns'   => $_columns,
                'downloadCSV' => true
            ]

        ) ?>
    </div>
</div>
<?php } ?>
