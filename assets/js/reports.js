$(function() {
    
    $('.js-add-filter').on('click', function(e){
		e.preventDefault();		
		var $template = $('#add-filter-template tr').clone();
		var $table = $("#filter-table").data('dataTable');
		
		$template.html($template.html().replace(/\{\{id\}\}/g,  $table.data().length));
		$template.find('input,select,textarea').removeAttr('disabled');
		
		$table.row.add($template).draw();
	});

        $(document).on('click', '.js-delete-row', function(e) {
		e.preventDefault();
		$("#filter-table").data('dataTable').row($(this).closest('tr')).remove().draw();
	})
        
        $('.js-add-link').on('click', function(e){
		e.preventDefault();		
		var $templateLink = $('#add-link-template tr').clone();
		var $tableLink = $("#link-table").data('dataTable');
		
		$templateLink.html($templateLink.html().replace(/\{\{id\}\}/g,  $tableLink.data().length));
		$templateLink.find('input,select,textarea').removeAttr('disabled');
		
		$tableLink.row.add($templateLink).draw();
	});
        
	$(document).on('click', '.js-delete-link-row', function(e) {
		e.preventDefault();
		$("#link-table").data('dataTable').row($(this).closest('tr')).remove().draw();
	});



	$('.flex-report-table').each(function() {
		var filter_option = "<'panel-body filter-form'<'row'<'col-sm-9'f><'col-sm-3'l>>>";
		if ($(this).attr('data-filter-option') == 'no') filter_option = "";
		
		$('.flex-report-table').DataTable({
			dom: filter_option + "Vrtip",
			language: {
		        searchPlaceholder: "Search..."
		    }
	    });
		var $context = $(this).closest('.flex-report-table-wrapper');
		$('.datatable-get-csv', $context).appendTo("#csv-button", $context).addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');
	})
    
})