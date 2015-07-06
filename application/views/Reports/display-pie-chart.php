<?php /* @var $model Easol_Report */ ?>

<?php
/* */
$jsonData=[];
$_i=0;
$axisX="";
$axisY="";
//die(print_r($model->getReportData()));
foreach($model->getReportData() as $key => $value){
    $jsonData[$_i]['key'] = $key;
    $jsonData[$_i]['y'] = $value;
    $_i++;
}
/* */

//die(json_encode($jsonData));
?>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">Flex Reports : Pie Chart : <?= $model->ReportName ?></h1>
        <br/><br/>
    </div>
</div>

<div class="row">
    <div class="col-md-12" >
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
                height: 100%;
                width: 100%;
            }
        </style>

        <div id="pieChart" class='with-3d-shadow with-transitions'>

        <svg id="test1" class="mypiechart"></svg>
        <?php /* <svg id="test2" class="mypiechart"></svg> */ ?>

        <script>
            var testdata = <?= json_encode($jsonData) ?>;
            var testdata2 = <?= json_encode($jsonData) ?>;
             /* var testdata2 = [
                {key: "One", y: 5},
                {key: "Two", y: 2},
                {key: "Three", y: 9},
                {key: "Four", y: 7},
                {key: "Five", y: 4},
                {key: "Six", y: 3},
                {key: "Seven", y: 0.5}
            ]; */
            var height = 350;
            var width = 350;
            nv.addGraph(function() {
                var chart = nv.models.pieChart()
                    .x(function(d) { return d.key })
                    .y(function(d) { return d.y })
                    .width(width)
                    .height(height);
                d3.select("#test1")
                    .datum(testdata2)
                    .transition().duration(1200)
                    .attr('width', width)
                    .attr('height', height)
                    .call(chart);
                // update chart data values randomly
                /* setInterval(function() {
                    testdata2[0].y = Math.floor(Math.random() * 10);
                    testdata2[1].y = Math.floor(Math.random() * 10);
                    chart.update();
                }, 4000); /* */
                return chart;
            });

        </script>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>


</div>