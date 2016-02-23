
$('.bar-chart.chart').each(function() {
    var $chart = $(this);
   	
   	$chart.data('filter', $.parseJSON($chart.attr('data-chart-filter')));
    historicalBarChart = [
        {
            key: "Cumulative Return",
            values: $.parseJSON($chart.attr('data-chart-data'))
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
            chart.yAxis.axisLabel($chart.attr('data-yaxis-label'));
            chart.xAxis.axisLabel($chart.attr('data-xaxis-label')).axisLabelDistance(-6);
            d3.select('#'+$chart.attr('id')+' svg')
                .datum(historicalBarChart)
                .call(chart);
            nv.utils.windowResize(chart.update);
            return chart;
        }, 
        function() {
            d3.selectAll(".nv-bar").on('click', function(e){
                chart_filter($chart.attr('data-report-id'), e.label, $chart.attr('data-variable'), $(this), $chart);
            });
        }
    );
});

function chart_filter(ReportId, label, variable, $node, $chart) {
	var $table = $('table[data-report-id='+ReportId+']');
	if ($table.length == 0) return;


	var dataTable = $table.data('dataTable');

	var column_no = $table.find('thead th[data-variable='+variable+']').index();

	var chartFilter = $chart.data('filter');

	if (!$table.data('initialData')) $table.data('initialData', dataTable.data());
	dataTable.clear();
	dataTable.rows.add($table.data('initialData')).draw();


	if ($chart.attr('data-type') == 'defined') {
		
		var filter = false;
		if (chartFilter[label] !== undefined && chartFilter[label]['Value'] !== undefined) filter = chartFilter[label];
		
		if (!filter) return;

		var filteredData = dataTable
		    .data()
		    .filter( function ( value, index ) {
		    	value = value[column_no];

		    	if (filter['Operator'] == 'equal') return value == filter['Value'];
		    	if (filter['Operator'] == 'in') {
		    		Values = filter['Value'].split(',');
		    		for (var i in Values) {
		    			if (Values[i] == value) return true;
		    		}
		    	}
		    	if (filter['Operator'] == 'like') {
		    		if (value.match(filter['Value'])) return true;
		    	}
		    	if (filter['Operator'] == 'greater') {
		    		if (value > filter['Value']) return true;	
		    	}
		    	if (filter['Operator'] == 'lesser') {
		    		if (value < filter['Value']) return true;
		    	}
		    	if (filter['Operator'] == 'between') {
		    		Values = filter['Value'].split('-');
		    		if (Values[1] == undefined && value > Values[0]) return true;
		    		else if (value > Values[0] && value < Values[1]) return true;
		    	}

		    	return false;
		    } );

		dataTable.clear();
		dataTable.rows.add(filteredData).draw();
		
		
	}
	else if (column_no || column_no === 0) {
		var value = label;
		if (chartFilter[label] !== undefined) value = chartFilter[label];
		dataTable.column(column_no).search(value, false, false, false).draw();
	}


	var color = $node.css('fill');

	$('#chart-'+ReportId).find('.nv-bar').not($node).css({
		'-webkit-filter': 'none',
		'filter': 'none' 
	});
	$node.css({
		'-webkit-filter': 'drop-shadow( 0px 0px 5px '+color+' )',
		'filter': 'drop-shadow( 0px 0px 5px '+color+')' 
	});
}