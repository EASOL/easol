$(function () {
	var AssessmentsTable = $('#assessments-table').DataTable({
		dom: 'Vrtip',
                iDisplayLength: 25
	});

	$("[name='filter[Year]']").on('change', function() {
		AssessmentsTable.column(3).search($(this).val(), true, false).draw();
	});

	$("[name='filter[Subject]']").on('change', function() {
		AssessmentsTable.column(2).search($(this).val(), true, false).draw();
	});

	$("[name='filter[GradeLevel]']").on('change', function() {
		AssessmentsTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='filter[PageLength]']").on('change', function() {
		AssessmentsTable.page.len($(this).val()).draw();
	});

	$('.datatable-get-csv').appendTo("#csv-button").addClass('btn btn-default').append(' <i class="fa fa-download"> </i> ').removeClass('datatable-get-csv');

	var StudentsTable = $('#students-table').DataTable({
		dom: 'lVrftip'
	});
})
