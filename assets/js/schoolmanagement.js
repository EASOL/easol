$(function () {

	$(document).on('click', "#schoolmanagement-details-form-enable", function (event) {
		$(this).replaceWith('<div class="btn-group" role="group"><button id="schoolmanagement-details-form-disable" class="btn btn-primary">Cancel</button><button id="schoolmanagement-details-form-submit" class="btn btn-primary" type="submit">Submit</button></div>');
		$("#schoolmanagement-details-form input").prop("disabled",false);
	})

	$(document).on('click', "#schoolmanagement-details-form-disable", function (event) {
		$(this).parent().replaceWith('<button id="schoolmanagement-details-form-enable" class="btn btn-primary">Edit School Configurations</button>');
		$("#schoolmanagement-details-form input").prop("disabled",true);
	})	

	$(document).on('click', '#schoolmanagement-details-form-submit', function (event) {
		$.post(document.location, $('#schoolmanagement-details-form input').serialize(), function (response) {
			console.log(response);
			// reload the page to reset the form to read only with the latest db data and show any flash data.
			location.reload();
		});
	})

	$(document).on('click', "#schoolmanagement-details-form-disable", function (event) {
		$(this).parent().replaceWith('<button id="schoolmanagement-details-form-enable" class="btn btn-primary">Edit School Configurations</button>');
		$("#schoolmanagement-details-form input").prop("disabled",true);
	})		
})
