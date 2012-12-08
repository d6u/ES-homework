(function () {
	var url = 'ajax_support/user_panel_info.php',
		email = $('#email_address').html();
	
	$('#edit-profile-button').click(function () {
		// edit data
		var data = {'load': true, 'email': email};
		
		$.post(url, data, function (response) {
			console.log(response);
			var info = $.parseJSON(response);
			// first and last
			$('#user_first').val(info.first);
			$('#user_last').val(info.last);
			// gender
			if ( info.gender != null ) {
				if ( info.gender == "m" ) {
					$('input[name="gender"]').val(['m'])
				} else {
					$('input[name="gender"]').val(['f'])
				}
			}
			// date of birth
			$('#user_dob').val(info.dob);
			// animation
			$("#inner-profile-show").slideUp(200);
			$("#inner-profile-edit").slideDown(200);
		});
	});
	
	
	$('#submit-profile-button').click(function (event) {
		// submit data
		var first = $('#user_first').val(),
			last = $('#user_last').val(),
			gender = $('input[name="gender"]:checked').val() ? $('input[name="gender"]:checked').val() : "",
			dob = $('#user_dob').val(),
			data = {'first': first, 'last': last, 'gender': gender, 'dob': dob, 'email': email};
		
		$.post(url, data, function (response) {
			console.log(response);
			$("#inner-profile-show").slideDown(200);
			$("#inner-profile-edit").slideUp(200);
		});
		event.preventDefault();
	});
})();
