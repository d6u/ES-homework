(function () {
	var url = 'ajax_support/user_panel_info.php',
		email = $('#email_address').html();
	
	$('#edit-profile-button').click(function () {
		// edit data
		var data = {'load': true, 'email': email};
		
		$.post(url, data, function (response) {
			console.log(response);
			var info = JSON.parse(response);
			$('#user_first').val(info.fist);
			$('#user_last').val(info.last);
			
			if ( info.gender != null ) {
				if ( info.gender == "m" ) {
					$('input[name="gender"]').val(['m'])
				} else {
					$('input[name="gender"]').val(['f'])
				}
			}
			
			$('#user_dob').val(info.dob);
			
			$("#inner-profile-show").slideUp(200);
			$("#inner-profile-edit").slideDown(200);
		});
	});
	
	
	$('#submit-profile-button').click(function (event) {
		// submit data
		var data = {'email': email, };
		
		$.post(url, data, function (response) {
			console.log(response);
			var info = JSON.parse(response);
			$('#user_first').val(info.fist);
			$('#user_last').val(info.last);
			
			if ( info.gender != null ) {
				if ( info.gender == "m" ) {
					$('input[name="gender"]').val(['m'])
				} else {
					$('input[name="gender"]').val(['f'])
				}
			}
			
			$('#user_dob').val(info.dob);
			
			$("#inner-profile-show").slideUp(200);
			$("#inner-profile-edit").slideDown(200);
		});
		
		event.preventDefault();
	});
})();
