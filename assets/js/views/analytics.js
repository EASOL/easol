$(function () {
	var AnalyticsTable = $('table#manageanalytics').DataTable({
        dom: 'rt',
        iDisplayLength: $('table#manageanalytics').attr('data-page-length'),
        "scrollX": true,
        buttons: [
            'colvis',
            {
	            extend: 'csv',
	            text: 'Download CSV'
	        }
        ],
    });

	/*$("[name='term']").on('change', function() {
		AnalyticsTable.column(0).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change', function() {
		AnalyticsTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='course']").on('change', function() {
		AnalyticsTable.column(2).search($(this).val(), true, false).draw();
	});

	$("[name='educator']").on('change', function() {
		AnalyticsTable.column(5).search($(this).val(), true, false).draw();
	});

	$("[name='filter[PageLength]']").on('change', function() {
		AnalyticsTable.page.len($(this).val()).draw();
	});

	 $('#dataGridFormFilter select').trigger('change');*/

	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

	$("#filter-submit").on('click', function() {
		$(this).closest('form').submit();
	})



})
