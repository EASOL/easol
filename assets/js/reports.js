$(function() {
    
    if ($('#filter-destination').length > 0) {
    	$("#dataGridFormFilter").detach().appendTo('#filter-destination');
    }
	
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
	})
})