$(function() {

    if ($('table#manageusers').length) {
        $('#manageusers').DataTable();
    }

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

    $("#main-menu #management").click(function(event) {
    	event.preventDefault();
    	var submenu = $('ul', $(this).parent());
    	if (submenu.length && submenu.is(':visible')) {
    		submenu.slideUp( "slow", function() {
    		// Animation complete.
    		});
    	} else {
    		submenu.slideDown( "slow", function() {
    		// Animation complete.
    		});
    	}
    });

    $( "#schoolFilter" ).change(function() {
        var schoolId = $(this).val();

        $('select#staffusi option[school != "'+schoolId+'"]').hide();
        $('select#staffusi option[school = "'+schoolId+'"]').show();
        $('select#staffusi option[school = "reset"]').show();
        $('select#staffusi').val('');
    });

    if ($('#usermanagement-addedit-authtype input:checkbox').length && $('#usermanagement-addedit-authtype input:checkbox').prop('checked')) {
        $('#usermanagement-addedit-password').hide();
    }

    $('#usermanagement-addedit-authtype input:checkbox').click(function(event) {
            $('#usermanagement-addedit-password').toggle(this.checked == false)
    });

});