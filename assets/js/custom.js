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

    /* Sample code for browser extension dev when handling content links */
    $('a.extension').click(function(event){
    	event.preventDefault();
    	var link	= $(this),
    	title		= link.attr('title'),
    	desc		= link.attr('description'), 
    	href		= link.attr('href');
    });
});