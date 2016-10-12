$(function () {

	var AttendanceTable = $('table#manageattendance').dataTable().api();
	

	$("[name='gradelevel']").on('change.filter', function() {
		AttendanceTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change.filter', function() {
		AttendanceTable.column(5).search($(this).val(), true, false).draw();
	});

	$("[name='filter[term]']").on('change.filter', function() {
		AttendanceTable.search($(this).val(), true, false).draw();
	});

	$("[name='filter[PageLength]']").on('change.filter', function() {
		AttendanceTable.page.len($(this).val()).draw();
	});
	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');

	$(window).trigger('hashchange.table-filter');
})