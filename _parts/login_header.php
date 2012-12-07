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
			<h1 class="banner-title">
				<?php if ( !isset($success) ) {
					echo "Welcome to Restaurant Review Site";
				} elseif ( $success == true ) {
					echo "Congratulations! You are now a member of Restaurant Review Site!";
				}?>
			</h1>
			<p class="banner-introduction">
				<?php if ( !isset($success) ) {
					echo "This is the login/register page, please enter your username and password in the correct field.";
				} elseif ( $success == true ) {
					echo "Please take some time to complete your profiles, however, you can do this later.";
					echo "</br>";
					echo "<a href=\"index.php\">Start suffer our coolest website?</a>";
				}?>
			</p>
			<div class="banner-return-home">
				<a href="index.php">Return to Homepage</a>
			</div>
		</div>
		
		<!-- MIDDLE -->
		<div class="middle clearfix">