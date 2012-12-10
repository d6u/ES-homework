<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $login_title; ?> | Razor Eat</title>
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
			<h1 class="banner-title"><?php echo $login_header; ?></h1>
			<p class="<?php echo $login_message_style; ?>"><?php echo $login_message; ?></p>
			<div class="banner-return-home">
				<a href="index.php">Return to Homepage</a>
			</div>
		</div>
		<!-- MIDDLE -->
		<div class="middle clearfix">