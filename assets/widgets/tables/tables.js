$(function() {

	$('.table-widget').each(function() {
		var $table = $(this);
		$table.attr('min-width', '100%');
		var filter_option = "<'filter-form'<'row'<'col-sm-9'f><'col-sm-3'l>>>";
		if ($table.attr('data-filter-option') == 'no' || $table.attr('data-filter-option') == 'false') filter_option = "";

		var buttons = [];
		if ($table.attr('data-column-visibility') != 'no' && $table.attr('data-column-visibility') != 'false') buttons.push('colvis');
		if ($table.attr('data-csv') != 'no' && $table.attr('data-csv') != 'false') buttons.push( { extend: 'csv', text: 'Download CSV'});


		var dom = filter_option + "<'row'<'col-xs-12'r<'table-widget-wrapper't>ip>><'table-widget-buttons row'<'col-xs-12'B>>";

		if ($table.attr('data-table-type') == 'minimal') dom = "r<'table-widget-wrapper't>";

		var options = {
			dom: dom,
			language: {
		        searchPlaceholder: "Search..."
		    },
		    pageLength: "25",
		   	buttons: buttons
	      //  'scrollX': true
		}

		if ($table.attr('data-initial-filter')) {
			try {
				initial_filter = $.parseJSON($table.attr('data-initial-filter'));
				options['searchCols'] = [];
				$table.find('thead tr th').each(function(index) {
					
					if (initial_filter[index] != undefined) {
						$filter =  $(initial_filter[index]);
						if ($filter.length > 0) var filter = $filter.val();
						else var filter = initial_filter[index]
						options['searchCols'].push({'search': filter})
					}
					else {
						options['searchCols'].push(null);
					}
					
				});
			}
			catch (err) {
				console.log(err);
			}

		}


		$table.DataTable(options);

		/*var $context = $(this).closest('.flex-report-table-wrapper');
		$('.datatable-get-csv', $context).appendTo("#csv-button", $context).addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');*/

	});

/*	$('select[name^="filter["').on('change', function() {
		var name = $(this).attr('name');
		var hash = {};
		hash[name] = $(this).val();
		url_hash(hash);
	});

	$('input[name^="filter["').on('keyup', function() {
		var name = $(this).attr('name');
		var hash = {};
		hash[name] = $(this).val();
		url_hash(hash);
	});

	$(window).on('hashchange.table-filter', function() {
		var params = url_param();
		for (var i in params) {
			var $filter = $('select[name="'+ i +'"], input[name="'+ i +'"]').first();
			$filter.val(params[i]);
			if ($filter.length > 0) {
				if ($filter.is('input')) $filter.trigger('keyup.filter');
				if ($filter.is('select')) $filter.trigger('change.filter');
			}
		}
	});*/
	$(window).trigger('hashchange.table-filter');

});
