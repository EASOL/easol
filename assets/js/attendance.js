$(function () {
	var AttendanceTable = $('table#manageattendance').DataTable({
        dom: 'Vrtip'
    });

	$("[name='gradelevel']").on('change', function() {
		AttendanceTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change', function() {
		AttendanceTable.column(5).search($(this).val(), true, false).draw();
	});

	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-primary').removeClass('datatable-get-csv');

	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');
})