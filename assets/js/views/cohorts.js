$(function () {
	var Table = $('#cohort-table').DataTable({
		dom: 'Vrtip',
                iDisplayLength: 25
	});

	var StudentTable = $('#student-table').DataTable({
		dom:            'Vrtip',
		iDisplayLength: 25
	});


	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

})
