$(function() {

	$('.flex-report-table').each(function() {
		var filter_option = "<'filter-form'<'row'<'col-sm-9'f><'col-sm-3'l>>>";
		if ($(this).attr('data-filter-option') == 'no') filter_option = "";
		
		var table = $(this).DataTable({
			dom: filter_option + "Vrtip",
			language: {
		        searchPlaceholder: "Search..."
		    },
		   "scrollX": true
	    });
	    $(this).data('dataTable', table);

		var $context = $(this).closest('.flex-report-table-wrapper');
		$('.datatable-get-csv', $context).appendTo("#csv-button", $context).addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');
	});
	
    
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

	$("select#DisplayType").on('change', function() {
		if ($(this).val().match(/chart/g)) {
			$('.chart-settings').stop().slideDown().find('input,select,textarea').not('.input-template').removeAttr('disabled').prop('disabled', false);
		}
		else {
			$('.chart-settings').stop().slideUp().find('input,select,textarea').attr('disabled', 'disabled').prop('disabled', true);
		}

		var selected = $(this).val();
		$('div.specific-settings:not(.'+selected+'-settings)').stop().slideUp();
		$('div.specific-settings.'+selected+'-settings').stop().slideDown();
	});
	$("select#DisplayType").trigger('change');

	$('input.settings-type').on('change', function() {
		var selected = $('input.settings-type:checked').val();
		$('div.settings-type:not(.'+selected+'-settings)').stop().slideUp();
		$('div.settings-type.'+selected+'-settings').stop().slideDown();
	});
	$('input.settings-type').trigger('change');


	$('.js-add-column').on('click', function(e){
		e.preventDefault();		
		var $template = $('#add-column-template tr').clone();
		var $table = $("#column-table").data('dataTable');
		
		$template.html($template.html().replace(/\{\{id\}\}/g,  $table.data().length));
		$template.find('input,select,textarea').removeAttr('disabled').prop('disabled', false);
		
		$table.row.add($template).draw();
		colorpicker();
	});

	$(document).on('click', '.js-delete-column-row', function(e) {
		e.preventDefault();
		$("#column-table").data('dataTable').row($(this).closest('tr')).remove().draw();
	});

	// DYNAMIC COLORS
	$colorInput = $('#settings-color-scheme');
	$colorTypeSelect = $('#color-type-btn');
	var selectedColorType = $colorTypeSelect.val();
	$('.chart-pallette-menu a').on('click', function(e) {
		e.preventDefault();
		$colorInput.val($(this).attr('data-index'));
		$('#selected-color-scheme').html($(this).find('.chart-color-pallette').html());
	});

	$colorTypeSelect.on('change', function(e) {
		$('.chart-pallette-menu li').hide()
		$items = $('.chart-pallette-menu li[data-type='+$(this).val()+']');
		$items.show();

		var value = $colorInput.val();
		if (!value) value = '--empty--';
		
		if ($items.filter('[data-type='+selectedColorType+']').find('[data-index='+value+']').length == 0) {
			$items.first().find('a').trigger('click');
		}
	});
	$colorTypeSelect.trigger('change');
    
})