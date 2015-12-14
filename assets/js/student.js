$(function () {
	var Table = $('#student-table').DataTable({
		dom: 'Vrtip',
                iDisplayLength: 25
	});

	$("[name='filter[term]']").on('keyup', function() {
		Table.search($(this).val(), true, false).draw();
	});

	$("[name='filter[Year]']").on('change', function() {
		Table.column(3).search($(this).val(), true, false).draw();
	});

	$("[name='filter[Cohort]']").on('change', function() {
		Table.column(2).search($(this).val(), true, false).draw();
	});

	$("[name='filter[GradeLevel]']").on('change', function() {
		Table.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='filter[PageLength]']").on('change', function() {
		Table.page.len($(this).val()).draw();
	});

	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

})
