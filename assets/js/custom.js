$(function() {
    $( "#filter-result" ).change(function() {
        $("#filter-form-result").val($( "#filter-result" ).val());
        $( "#dataGridFormFilter").submit();
    });

    $("[data-toggle='modal']").on('click', function(e) {
    	e.preventDefault();
    	var $that = $(this);

        var $loading = $(".loading", $that.attr('data-target')).fadeIn();

    	if ($(this).attr('data-post-data')) {
    		var $form = $($(this).attr('data-post-data'));
    		$.ajax({
    			url: $(this).attr('data-href'),
    			type: 'post',
    			data: $form.serialize(),
    			dataType: 'json',
    			success: function(response) {
                    $loading.fadeOut();
    				$(".modal-ajax-content", $that.attr('data-target')).html(response.html);
    			}
    		})
    	}
    })


});