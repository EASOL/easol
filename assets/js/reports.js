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
})