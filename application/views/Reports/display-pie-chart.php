<?php /* @var $model Easol_Report */ ?>

<?php
/* */
$filter = $model->getFilters();
$jsonData=[];
$_i=0;
$axisX="";
$axisY="";
$_columns=[];
$ReportData = $this->db->query($model->getReportQuery());
if (!empty($ReportData)) {
    foreach($ReportData->list_fields()as $key) {
        $_columns[] = $key;
    }
}

foreach($model->getReportData() as $key => $value){
    $jsonData[$_i]['key'] = $key;
    $jsonData[$_i]['y'] = $value;
    $_i++;
}


//die(print_r($_columns));
?>
<?php if($displayTitle==true){ ?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1 class="page-header">Flex Reports : Pie Chart : <?= $model->ReportName ?></h1>
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
                        float: left;
                        height: 350px !important;
                        width: 350px !important;
                    }
                    #pieChart {
                        margin: 0px;
                        padding: 0px;
                       /* height: 100%; */
                        width: 100%;
                    }
                </style>

                <div id="pieChart" class='with-3d-shadow with-transitions'>

                <svg id="pieChartDisp" class="mypiechart"></svg>

                <script>
                    var chartData = <?= json_encode($jsonData) ?>;

                    var height = 150;
                    var width = 350;
                    nv.addGraph(function() {
                        var chart = nv.models.pieChart()
                            .x(function(d) { return d.key })
                            .y(function(d) { return d.y })
                            .width(width)
                            .height(height)
                            .valueFormat(d3.format(".0f"));
                        d3.select("#pieChartDisp")
                            .datum(chartData)
                            .transition().duration(1200)
                            .attr('width', width)
                            .attr('height', height)
                            .call(chart);

                        return chart;
                    });

                </script>
                </div>

            </div>
        </div>
    </div>
</div>

<?php if(isset($pageNo) && !empty($_columns)): ?>
    <?php $filter_option = 'no'; ?>
    <div class="row">
        <div class="col-md-12">
            <?php include('display-table-view.php'); ?>
        </div>
    </div>
<?php endif;  ?>