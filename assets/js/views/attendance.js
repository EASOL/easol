$(function () {

	var AttendanceTable = $('table#manageattendance').dataTable().api();
	

	$("[name='gradelevel']").on('change', function() {
		AttendanceTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change', function() {
		AttendanceTable.column(5).search($(this).val(), true, false).draw();
	});
	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');
})