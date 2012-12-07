(function () {
	function validateEmail(email) {
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}
	
	// Register behavior
	$('.middle').on('change', 'input[type="text"], input[type="password"]', function () {
		$('#register-warning').empty();
	})
	.on('change', '#register_user_email', function () {
		var email = $(this).val();
		if ( email != "" && !validateEmail(email) ) {
			$('#register-warning').html("Email address is not valid.");
		} else if ( validateEmail(email) ) {
			var url = "ajax_support/user_exist.php",
				data = {'email': email};
			$.post(url, data, function (exist) {
				if ( exist == 'true') {
					$('#register-warning').html('Email address already registered, <a href="#">forget yoru password?</a>');
				};
			});
		}
	})
	.on('change', '#register_user_pass_repeat', function () {
		var pass = $('#register_user_pass').val(), pass_r = $(this).val();
		if ( pass != pass_r ) {
			$('#register-warning').html("Password doesn't match.");
		}
	})
	.on('change', '#register_user_pass', function () {
		var pass = $(this).val(), pass_r = $('#register_user_pass_repeat').val();
		if ( pass_r != "" && pass != pass_r ) {
			$('#register-warning').html("Password doesn't match.");
		}
	})
	.on('click', '#register_submit', function (event) {
		var email = $('#register_user_email').val(),
			pass = $('#register_user_pass').val(),
			pass_r = $('#register_user_pass_repeat').val(),
			url = "ajax_support/user_exist.php",
			data = {'email': email},
			exist,
			warning = $('#register-warning');
		event.preventDefault();
		$.post(url, data, function (response) {
			if ( email == '' ) {
				warning.html("Email can't be empty.");
				var valid = false;
			} else if ( !validateEmail(email) ) {
				warning.html("Email address is not valid.");
				var valid = false;
			} else if ( response == 'true' ) {
				warning.html('Email address already registered, <a href="#">forget yoru password?</a>');
				var valid = false;
			} else if ( pass != pass_r ) {
				warning.html("Password doesn't match.");
				var valid = false;
			} else if ( pass == '' ) {
				warning.html("Password can't be empty.");
				var valid = false;
			}
			if ( valid != false ) {
				$('form[action="register_option.php"]').submit();
			}
		});
	});
	
	// Login behavior
	
})();
