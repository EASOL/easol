$(function() {
    $( "#filter-result" ).change(function() {
        $("#filter-form-result").val($( "#filter-result" ).val());
        $( "#dataGridFormFilter").submit();
    });

    $('#content-query').focus(function(){
    	var query = $(this);
    	if (query.val() == 'search text')
    		query.val('');
    });

});