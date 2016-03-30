$(function () {
	var AttendanceTable = $('table#manageattendance').DataTable({
		dom: 'rtip',
		iDisplayLength: 25,
		"scrollX": true,
		buttons: [
            'colvis',
            {
	            extend: 'csv',
	            text: 'Download CSV'
	        }
        ],
	});

	$("[name='gradelevel']").on('change', function() {
		AttendanceTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change', function() {
		AttendanceTable.column(5).search($(this).val(), true, false).draw();
	});

	//$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-primary').removeClass('datatable-get-csv');
	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');
})