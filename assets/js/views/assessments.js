$(function () {

	var AssessmentsTable = $('#assessments-table').dataTable().api();

	/*var AssessmentsTable = $('#assessments-table').DataTable({
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
	});*/

	$("[name='filter[Year]']").on('change.filter', function() {
		AssessmentsTable.column(3).search($(this).val(), true, false).draw();
	});

	$("[name='filter[Subject]']").on('change.filter', function() {
		AssessmentsTable.column(2).search($(this).val(), true, false).draw();
	});

	$("[name='filter[GradeLevel]']").on('change.filter', function() {
		AssessmentsTable.column(1).search($(this).val(), true, false).draw();
	});

	$("[name='filter[PageLength]']").on('change.filter', function() {
		AssessmentsTable.page.len($(this).val()).draw();
	});

	$(window).trigger('hashchange.table-filter');

	/*var StudentsTable = $('#students-table').DataTable({
		dom: 'lVrftip',
		"scrollX": true
	});*/
})
