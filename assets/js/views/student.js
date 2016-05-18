$(function () {
	var Table = $('#student-table').dataTable().api();

	
	$("[name='filter[term]']").on('keyup.filter', function() {
		Table.search($(this).val(), true, false).draw();
	});

	$("[name='filter[Year]']").on('change.filter', function() {
		Table.column(3).search($(this).val(), true, false).draw();
	});

	$("[name='filter[Cohort]']").on('change.filter', function() {
		Table.column(2).search($(this).val(), true, false).draw();
	});

	$("[name='filter[GradeLevel]']").on('change.filter', function() {
		Table.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='filter[PageLength]']").on('change.filter', function() {
		Table.page.len($(this).val()).draw();
	});

	$(window).trigger('hashchange.table-filter');
})
