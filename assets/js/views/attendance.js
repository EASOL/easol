$(function () {

	var AttendanceTable = $('table#manageattendance').dataTable().api();
	

	$("[name='gradelevel']").on('change.filter', function() {
		AttendanceTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change.filter', function() {
		AttendanceTable.column(5).search($(this).val(), true, false).draw();
	});

	$("[name='term']").on('change.filter', function() {
		AttendanceTable.column(6).search($(this).val(), true, false).draw();
	});
	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');

	$(window).trigger('hashchange.table-filter');
})