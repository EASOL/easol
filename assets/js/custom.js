$(function() {

	/* change these to use a class selector since we added more than one of them */
	if ($('table#manageusers').length) {
		$('#manageusers').DataTable({
        dom: 'Vlfrtip'
  		  });
	}

	if ($('table#manageschools').length) {
		$('#manageschools').DataTable({
        dom: 'Vlfrtip'
    });
	}

	if ($('table#manageschooldetails').length) {
		$('#manageschooldetails').DataTable();
	}

	if ($('table#analyzestudents').length) {
		$('#analyzestudents').DataTable();
	}

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

	$('#content-query').focus(function(){
		var query = $(this);
		if (query.val() == 'search text')
			query.val('');
	});

	/* Get the query string into an object for use in the defilter list */
	var urlParams;
	(window.onpopstate = function () {
		var match,
			pl     = /\+/g,  // Regex for replacing addition symbol with a space
			search = /([^&=]+)=?([^&]*)/g,
			decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
			query  = window.location.search.substring(1);

		urlParams = {};
		while (match = search.exec(query))
			urlParams[decode(match[1])] = decode(match[2]);
	})();

	$('.filter_active').click(function () {
		delete urlParams[this.value];
		var newQuery = $.param(urlParams);
		var baseUrl = [location.protocol, '//', location.host, location.pathname].join('');
		window.location = baseUrl+'?'+newQuery;
	})

	/* Sample code for browser extension dev when handling content links */
	var assignmentLink = $('a.extension'), target = 'chrome-extension://maifknjmjnafdaiohogiffkdaebomimn';

	/* Tell the extension what was the last active URL  */
	/*if(window.parent.location.origin === 'chrome-extension://maifknjmjnafdaiohogiffkdaebomimn'){*/
	window.parent.postMessage({operation: 'changeUrl', location: window.location.href}, target);
	/*  }*/

	if (assignmentLink.length) {
		// Hide links if a Google Classroom page is not open
		$(window).on('message', function (event) {
			if (event.originalEvent.origin === target && !event.originalEvent.data.isClassroomOpen) {
				assignmentLink.hide();
			}
		});
		window.parent.postMessage({operation: 'isClassroomOpen'}, target);

		// Click handler for entering fields into the new assignment form
		assignmentLink.click(function(event){
			/*  event.preventDefault();
			 var link   = $(this),
			 title      = link.attr('title'),
			 desc       = link.attr('description'),
			 href       = link.attr('href');*/

			event.preventDefault();
			var link = $(this);
			var message = {title: link.attr('title'), desc: link.attr('description'), href: link.attr('href')};
			window.parent.postMessage(message, target);
		});
	}

    $("#main-menu #management, #main-menu #learning-lab").click(function(event) {
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
    	$.fixSidebarLayout();
    });

    if ($('.sublive').length) {
        $('.sublive').parent().show();
    }

	$( "#schoolFilter" ).change(function() {
		var schoolId = $(this).val();

		if (schoolId == 'all') {

			$('select#staffusi option').show();
			$('select#staffusi').val('');

		}else {

			$('select#staffusi option[school != "'+schoolId+'"]').hide();
			$('select#staffusi option[school = "'+schoolId+'"]').show();
			$('select#staffusi option[school = "reset"]').show();
			$('select#staffusi').val('');
		}

	});

	$('a.usermanagement-index-delete').click(function(event) {
		event.preventDefault();
		if (confirm('Are you sure you want to delete this user?')) {
			window.location = this.href;
		}

	})

	if ($('#usermanagement-addedit-authtype input:checkbox').length && $('#usermanagement-addedit-authtype input:checkbox').prop('checked')) {
		$('#usermanagement-addedit-password').hide();
	}

	$('#usermanagement-addedit-authtype input:checkbox').click(function(event) {
		$('#usermanagement-addedit-password').toggle(this.checked == false)
	});
	$('[data-toggle="tooltip"]').tooltip();

});



/* GOOGLE SIGN IN: https://developers.google.com/identity/sign-in/ */
function onSignIn(googleUser) {
	/*console.log(googleUser);*/
	// Useful data for your client-side scripts:
	var profile = googleUser.getBasicProfile();
	//console.log("ID: " + profile.getId()); // Don't send this directly to your server!
	//console.log("Name: " + profile.getName());
	//console.log("Image URL: " + profile.getImageUrl());
	//console.log("Email: " + profile.getEmail());
	// The ID token you need to pass to your backend:

	var id_token = googleUser.getAuthResponse().id_token;
	var uemail = profile.getEmail();
	var name = profile.getName();


	
	var gloginPosturl = location.href;

	var xhr = new XMLHttpRequest();
	xhr.open('POST', gloginPosturl);
	xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xhr.onload = function() {
		if(xhr.responseText=="gloginValid") {
			/* GOOD SIGN IN */
			/*console.log('Signed in as: ' + profile.getName() );*/
			/* alert(profile.getName() + ' is now logged in!');  alert(xhr.responseText);*/
			window.location='student';
		} else {
			/* FAILED SIGN IN */
			console.log('Signed In Error: ' + xhr.responseText);
			signOut();
			/*
			 * we set the error message server side in the session for display on the redirect.
			 * we redirect to the current url but without resending the post data like window.location.reload() would do.
			 */
			window.location.href = window.location.href;
		}
	};
	xhr.send('idtoken=' + id_token + '&uemail=' + uemail);
}
//  END SIGN IN
/* GOOGLE LOGIN - WELL WE NEED TO LOGOUT */
/* Login button must be on same page as logout button - but hidden  - for this to work */
function signOut() { console.log('Attempting Google Logout');
	var auth2 = gapi.auth2.getAuthInstance();
	auth2.signOut().then(function () {
		console.log('User signed out.');
	});
	console.log('End Google Logout');
}

function loading($node) {

	var $box = $node.closest('.loading-box');
	if ($box.length == 0) $box = $node.css('position', 'relative');
	if ($box.find('.loading-img').length == 0) $box.append('<div class="loading-img"></div>');

	$box.find('.loading-img').fadeIn();
}
function unloading($node) {
	var $box = $node.closest('.loading-box');
	$box.find('.loading-img').fadeOut();
}


