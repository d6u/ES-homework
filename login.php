<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login | Restaurant Review Site</title>
	<meta name="viewport" content="width=device-width">
	<!-- Stylesheet -->
	<link rel="stylesheet" href="_css/css-reset.css">
	<link rel="stylesheet" href="_css/input-style.css">
	<link rel="stylesheet" href="_css/login-style.css">
</head>
<body>
	<div class="bar"></div>
	<div id="wrapper" class="clearfix">
		<div class="banner">
			<h1 class="banner-title">Welcome to Restaurant Review Site</h1>
			<p class="banner-introduction">This is the login/register page, please enter your username and password in the correct field.</p>
			<div class="banner-return-home">
				<a href="#">Return Home</a>
			</div>
		</div>
		<div class="login-wrapper">
			<h2 class="form-title">Login here</h2>
			<form id="login-form" method="post" action="login.php">
				<p class="login-input">
					<label for="user_login">
						Username
						<br>
						<input type="text" name="user_name" id="user_login" class="input" value="" size="20" tabindex="10">
					</label>
				</p>
				<p class="login-input">
					<label for="user_pass">
						Password
						<br>
						<input type="password" name="password" id="user_pass" class="input" value="" size="20" tabindex="20">
					</label>
				</p>
				<p class="forgetmenot">
					<label for="rememberme">
						<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90">
						Remember Me
					</label>
				</p>
				<p class="submit">
					<input type="submit" name="submit" id="submit" class="blue-button" value="Log In" tabindex="100">
				</p>
			</form>
		</div>
		<div class="register-wrapper">
			<h2 class="form-title">Register here</h2>
			<form id="register-form" method="post" action="register.php">
				<p class="login-input">
					<label for="user_register">
						Email Address
						<br>
						<input type="text" name="user_name" id="user_register" class="input" value="" size="20" tabindex="210">
					</label>
				</p>
				<p class="login-input">
					<label for="user_register_pass">
						Password
						<br>
						<input type="password" name="password" id="user_register_pass" class="input" value="" size="20" tabindex="220">
					</label>
				</p>
				<p class="login-input">
					<label for="user_register_pass_repeat">
						Repeat Your Password
						<br>
						<input type="password" name="password" id="user_register_pass_repeat" class="input" value="" size="20" tabindex="220">
					</label>
				</p>
				<p class="register-submit clearfix">
					<input type="submit" name="submit" id="register-submit" class="blue-button" value="Register" tabindex="300">
				</p>
			</form>
		</div>
		<div class="footer">
			<p class="footer-copyright">@Copyright Reserved</p>
			<ul class="footer-menu">
				<li class="footer-menu-item"><a href="#">About</a></li>
				<li class="footer-menu-item"><a href="#">About</a></li>
				<li class="footer-menu-item"><a href="#">About</a></li>
				<li class="footer-menu-item"><a href="#">About</a></li>
			</ul>
		</div>
	</div>
	<!-- Javascript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="_js/jquery-1.8.2.min.js"><\/script>')</script>
	<script src="_js/login.js"></script>
</body>
</html>