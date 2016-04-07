function create_charts() {
	$('.bar-chart.chart').each(function() {
	    var $chart = $(this);
	   	
	   	$chart.data('filter', $.parseJSON($chart.attr('data-chart-filter')));
	   	var historicalBarChart = [
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
	                    .color(function(d){ return d.color })
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
	        	if ($chart.attr('data-report-id')) {
		            d3.selectAll(".nv-bar").on('click', function(e){
		                chart_filter($chart.attr('data-report-id'), e.label, $chart.attr('data-variable'), $(this), $chart);
		            });
		        }
	        }
	    );
	});

	$('.pie-chart.chart').each(function() {

		var $chart = $(this);

		$chart.data('filter', $.parseJSON($chart.attr('data-chart-filter')));
		var chartData = $.parseJSON($chart.attr('data-chart-data'));

	    var height = 250;
	    var width = 550;
	  	nv.addGraph(
	  		function() {
		        var chart = nv.models.pieChart()
		            .x(function(d) { return d.label })
		            .y(function(d) { return d.value })
		        	.color(function(d){ return d.color })
		        	.showLabels(true)
		        	.labelsOutside(true)
		            .valueFormat(d3.format(".0f"));
		        d3.select('#'+$chart.attr('id')+' svg')
		            .datum(chartData)
		            .transition().duration(1200)
		           
		            .call(chart);
		        nv.utils.windowResize(chart.update);

		        chart.legend.dispatch.on('stateChange.pie', function(state){
		        	chart_nfilter($chart, d3.selectAll('.nv-legend .nv-series').data(), state);
		        }); 


		        return chart;
		    },
		    function() {
		    	if ($chart.attr('data-report-id')) {
		            d3.selectAll(".nv-slice").on('click', function(e){
		            	chart_filter($chart.attr('data-report-id'), e.data.label, $chart.attr('data-variable'), $(this), $chart);
		            });
		        }
	        }
		);

	});
};


function chart_filter(ReportId, label, variable, $node, $chart) {

	if ($chart.attr('data-context') == 'dashboard') {
		window.open(Easol_SiteUrl+'reports/view/'+ReportId, '_self');
		return;
	}

	var $table = $('table[data-report-id='+ReportId+']');
	if ($table.length == 0) return;

	if ($chart.data('selected') == label) return chart_unfilter(ReportId, label, variable, $node, $chart);

	$chart.data('selected', label);


	var dataTable = $table.dataTable().api();
	var column_no = $table.find('thead th[data-variable='+variable+']').index();
	var chartFilter = $chart.data('filter');
	if (!$table.data('initialData')) $table.data('initialData', dataTable.data());

	if ($chart.attr('data-type') == 'defined') {
		
		dataTable.clear();
		dataTable.rows.add($table.data('initialData')).draw();
		
		var filter = false;
		if (chartFilter[label] !== undefined && chartFilter[label]['Value'] !== undefined) filter = chartFilter[label];
		
		if (!filter) return;

		var filteredData = dataTable
		    .data()
		    .filter( function ( value, index ) {
		    	value = value[column_no];

		    	if (filter['Operator'] == 'equal') {
		    		return value == filter['Value'];
		    	}
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
		    		if (parseFloat(value) > parseFloat(filter['Value'])) return true;	
		    	}
		    	if (filter['Operator'] == 'lesser') {
		    		if (parseFloat(value) < parseFloat(filter['Value'])) return true;
		    	}
		    	if (filter['Operator'] == 'between') {
		    		Values = filter['Value'].split(';');
		    		if (Values[1] == undefined && parseFloat(value) > parseFloat(Values[0])) return true;
		    		else if (parseFloat(value) > parseFloat(Values[0]) && parseFloat(value) < parseFloat(Values[1])) return true;
		    	}


				if (filter['Operator'] == 'greater_or_equal') {
		    		if (parseFloat(value) >= parseFloat(filter['Value'])) return true;	
		    	}
		    	if (filter['Operator'] == 'lesser_or_equal') {
		    		if (parseFloat(value) <= parseFloat(filter['Value'])) return true;
		    	}
		    	if (filter['Operator'] == 'between_closed') {
		    		Values = filter['Value'].split(';');
		    		if (Values[1] == undefined && parseFloat(value) >= parseFloat(Values[0])) return true;
		    		else if (parseFloat(value) >= parseFloat(Values[0]) && parseFloat(value) <= parseFloat(Values[1])) return true;
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

	$('#chart-'+ReportId).find('.nv-bar, .nv-slice').not($node).removeClass('selected').css({
		'-webkit-filter': 'none',
		'filter': 'none' 
	}).find('path').css({
		'stroke-dasharray': ''
	});

	$node.css({
		'-webkit-filter': 'drop-shadow( 0px 0px 5px '+color+' )',
		'filter': 'drop-shadow( 0px 0px 5px '+color+')' 
	}).addClass('selected');
	$node.find('path').css({
		'stroke-dasharray': "5.5"
	});

	//highlight text in pie charts
	var $pie_labels = $('#chart-'+ReportId).find('.nv-pieLabels .nv-label');
	$pie_labels.removeClass('selected-label')
	$pie_labels.eq($node.index()).addClass('selected-label');

}

function chart_unfilter(ReportId, label, variable, $node, $chart) {

	var $table = $('table[data-report-id='+ReportId+']');
	if ($table.length == 0) return;

	var dataTable = $table.dataTable().api();

	var column_no = $table.find('thead th[data-variable='+variable+']').index();

	if ($chart.attr('data-type') == 'defined') {
		dataTable.clear();
		dataTable.rows.add($table.data('initialData')).draw();
	}
	else if (column_no || column_no === 0) {		
		dataTable.column(column_no).search('', true).draw();
	}
	

	$chart.data('selected', false);

	var color = $node.css('fill');

	$node.removeClass('selected').css({
		'-webkit-filter': 'none',
		'filter': 'none' 
	}).find('path').css({
		'stroke-dasharray': ''
	});

	//highlight text in pie charts
	var $pie_labels = $('#chart-'+ReportId).find('.nv-pieLabels .nv-label');
	$pie_labels.removeClass('selected-label')

}

function chart_nfilter($chart, legends, state) {

	if (!$chart.data('nfilter')) $chart.data('nfilter', 1);

	var ReportId = $chart.attr('data-report-id');
	var variable = $chart.attr('data-variable');

	var $table = $('table[data-report-id='+ReportId+']');
	if ($table.length == 0) return;

	var dataTable = $table.dataTable().api();
	var column_no = $table.find('thead th[data-variable='+variable+']').index();
	var chartFilter = $chart.data('filter');

	if (!$table.data('initialData')) $table.data('initialData', dataTable.data());

	dataTable.clear();
	dataTable.rows.add($table.data('initialData')).draw();
	var filteredData = dataTable.data();

	if ($chart.attr('data-type') == 'defined') {		

		for (var i in legends) {
			var filter = false;
			var legend = legends[i];
			
			if (!legend.disabled) continue;

			var label = legend.label;

			if (chartFilter[label] !== undefined && chartFilter[label]['Value'] !== undefined) filter = chartFilter[label];

			if (!filter) return;
			
			filteredData = filteredData.filter( function ( value, index ) {
		    	
		    	value = value[column_no];

		    	if (filter['Operator'] == 'equal') return value != filter['Value'];
		    	if (filter['Operator'] == 'in') {
		    		Values = filter['Value'].split(';');
		    		for (var i in Values) {
		    			if (Values[i] == value) return false;
		    		}
		    	}
		    	if (filter['Operator'] == 'like') {
		    		if (value.match(filter['Value'])) return false;
		    	}
		    	if (filter['Operator'] == 'greater') {
		    		if (parseFloat(value) > parseFloat(filter['Value'])) return false;	
		    	}
		    	if (filter['Operator'] == 'lesser') {
		    		if (parseFloat(value) < parseFloat(filter['Value'])) return false;
		    	}
		    	if (filter['Operator'] == 'between') {
		    		Values = filter['Value'].split(';');
		    		if (Values[1] == undefined && parseFloat(value) > parseFloat(Values[0])) return false;
		    		else if (parseFloat(value) > parseFloat(Values[0]) && parseFloat(value) < parseFloat(Values[1])) return false;
		    	}
		    	if (filter['Operator'] == 'between_closed') {
		    		Values = filter['Value'].split(';');
		    		if (Values[1] == undefined && parseFloat(value) >= parseFloat(Values[0])) return false;
		    		else if (parseFloat(value) >= parseFloat(Values[0]) && parseFloat(value) <= parseFloat(Values[1])) return false;
		    	}		

		    	return true;
		    });
		}		
		
	}
	else if (column_no || column_no === 0) {

		for (var i in legends) {
			var filter = false;
			var legend = legends[i];
			
			if (!legend.disabled) continue;

			var label = legend.label;
			
			if (chartFilter[label] !== undefined) value = chartFilter[label];
			
			filteredData = filteredData.filter( function ( value, index ) {
		    	
		    	value = value[column_no];

		    	return value != label;
		    });

		}
	}

	dataTable.clear();
	dataTable.rows.add(filteredData).draw();


}
 