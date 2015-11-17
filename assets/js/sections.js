$(function () {
	var SectionsTable = $('table#managesections').DataTable({
        dom: 'Vrtip'
    });

	$("[name='term']").on('change', function() {
		SectionsTable.column(6).search($(this).val(), true, false).draw();
	});

	$("[name='year']").on('change', function() {
		SectionsTable.column(7).search($(this).val(), true, false).draw();
	});

	$("[name='course']").on('change', function() {
		SectionsTable.column(0).search($(this).val(), true, false).draw();
	});

	$("[name='educator']").on('change', function() {
		SectionsTable.column(3).search($(this).val(), true, false).draw();
	});

	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-primary').removeClass('datatable-get-csv');

	/* Apply the default filters as set by the server */
	$('#dataGridFormFilter select').trigger('change');
})