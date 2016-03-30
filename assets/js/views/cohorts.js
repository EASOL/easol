$(function () {
	var Table = $('#cohort-table').DataTable({
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

	var StudentTable = $('#student-table').DataTable({
		dom:            'Vrtip',
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


	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

})
