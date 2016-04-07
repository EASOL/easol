$(function () {
/*	var AnalyticsTable = $('table#manageanalytics').dataTable().api();

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

	$("#filter-submit").on('click', function() {
		$(this).closest('form').submit();
	})



})
