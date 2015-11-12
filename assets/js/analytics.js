$(function () {
	var AnalyticsTable = $('table#manageanalytics').DataTable({
        dom: 'Vrtip'
    });

	$("[name='term']").on('change', function() {
		AnalyticsTable.column(6).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change', function() {
		AnalyticsTable.column(7).search($(this).val(), true, false).draw();
	});

	$("[name='course']").on('change', function() {
		AnalyticsTable.column(0).search($(this).val(), true, false).draw();
	});

	$("[name='educator']").on('change', function() {
		AnalyticsTable.column(3).search($(this).val(), true, false).draw();
	});

	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-primary').removeClass('datatable-get-csv');

	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');
})
