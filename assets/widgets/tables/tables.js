$(function() {

	$('.table-widget').each(function() {
		var $table = $(this);
		$table.css('width', '100%').width('100%');
		var filter_option = "<'filter-form'<'row'<'col-sm-9'f><'col-sm-3'l>>>";
		if ($table.attr('data-filter-option') == 'no' || $table.attr('data-filter-option') == 'false') filter_option = "";

		var buttons = [];
		if ($table.attr('data-column-visibility') != 'no' && $table.attr('data-column-visibility') != 'false') buttons.push('colvis');
		if ($table.attr('data-csv') != 'no' && $table.attr('data-csv') != 'false') buttons.push( { extend: 'csv', text: 'Download CSV'});


		var dom = filter_option + "<'row'<'col-xs-12'rtip>><'table-widget-buttons row'<'col-xs-12'B>>";

		if ($table.attr('data-table-type') == 'minimal') dom = 'rt'

		$table.DataTable({				
			
			dom: dom,
			language: {
		        searchPlaceholder: "Search..."
		    },
		    pageLength: "25",
		   	buttons: buttons,
	        'scrollX': true
	   
		});

		/*var $context = $(this).closest('.flex-report-table-wrapper');
		$('.datatable-get-csv', $context).appendTo("#csv-button", $context).addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');*/

	});

});