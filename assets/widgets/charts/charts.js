function chart_filter(ReportId, value, variable, $node) {
	var $table = $('table[data-report-id='+ReportId+']');
	if ($table.length == 0) return;

	var dataTable = $table.data('dataTable');

	var column_no = $table.find('thead th[data-variable='+variable+']').index();

	if (column_no || column_no === 0) {
		dataTable.column(column_no).search(value, false, false, false).draw();
	}

	console.log($node);

	
	//$node.addClass('selected');

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