$(function () {

	$(document).on('click', "#schoolmanagement-details-form-enable", function (event) {
		$(this).replaceWith('<div class="btn-group" role="group"><button id="schoolmanagement-details-form-disable" class="btn btn-primary">Cancel</button><button id="schoolmanagement-details-form-submit" class="btn btn-primary" type="submit">Submit</button></div>');
		$("#schoolmanagement-details-form input, #schoolmanagement-details-form select").prop("disabled",false);
	})

	$(document).on('click', "#schoolmanagement-details-form-disable", function (event) {
		$(this).parent().replaceWith('<button id="schoolmanagement-details-form-enable" class="btn btn-primary">Edit School Configurations</button>');
		$("#schoolmanagement-details-form input:not([type *= 'search']), #schoolmanagement-details-form select").prop("disabled",true);
	})	

	$(document).on('click', '#schoolmanagement-details-form-submit', function (event) {
		if (confirm('Are you sure you want to apply these changes?')) {
			$.post(document.location, $('#schoolmanagement-details-form input, #schoolmanagement-details-form select').serialize(), function (response) {
				console.log(response);
				// reload the page to reset the form to read only with the latest db data and show any flash data.
				location.reload();
			});
		}
	})

	$('#schoolmanagement-addschooldetails-key').change(function (event) {
		var value = $(this).val();
		$('.schoolmanagement-addschooldetails-value-container').hide();
		$('.schoolmanagement-addschooldetails-value', $('.schoolmanagement-addschooldetails-value-container')).prop('disabled',true);		
		$('#schoolmanagement-addschooldetails-submit').hide();
		if (value !== undefined && value !== '') {
			$('.schoolmanagement-addschooldetails-value-container#'+value).css('display', 'inline-block');
			var target = $('.schoolmanagement-addschooldetails-value', $('.schoolmanagement-addschooldetails-value-container#'+value));
			target.val('');
			target.prop('disabled',false);
			if (target.is('input:text'))
				$('#schoolmanagement-addschooldetails-submit').css('display', 'inline-block');
		}		
	})		

	$('.schoolmanagement-addschooldetails-value').change(function (event) {
		var value = $(this).val();
		if (value !== undefined && value != '')
			$('#schoolmanagement-addschooldetails-submit').css('display', 'inline-block');
		else
			$('#schoolmanagement-addschooldetails-submit').hide();
	})	
})
