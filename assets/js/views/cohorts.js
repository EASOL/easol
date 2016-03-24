$(function () {
	var Table = $('#cohort-table').DataTable({
		dom: 'Vrtip',
		iDisplayLength: 25,
		"scrollX": true
	});

	var StudentTable = $('#student-table').DataTable({
		dom:            'Vrtip',
		iDisplayLength: 25,
		"scrollX": true
	});


	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

})
