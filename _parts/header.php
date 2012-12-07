<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Restaurant Review Site</title>
	<meta name="viewport" content="width=device-width">
	<!-- Stylesheet -->
	<link rel="stylesheet" href="_css/css-reset.css">
	<link rel="stylesheet" href="_css/input-style.css">
	<link rel="stylesheet" href="_css/main-style.css">
</head>
<body>
	<div class="bar"></div>
	<div id="wrapper">
		<div class="banner">
			<div class="banner-logo">
				<a href="">Restaurant Review</a>
			</div>
			<ul class="banner-menu">
				<li class="banner-menu-item"><a href="index.php">Home</a></li>
				<li class="banner-menu-item"><a href="#">About</a></li>
				<li class="banner-menu-item"><a href="login.php">Login/Register</a></li>
			</ul>
		</div>
		<div class="information">Home</div>
		<div class="search">
			<div class="search-top">
				<input type="button" id="category-button" class="transition" value="Show Category" />
				<input type="text" id="search-input" placeholder="Search for Favorite" />
				<input type="button" id="search-button" class="transition" value="Feeling Lucky" />
			</div>
			<div class="search-show"></div>
		</div>
		<div class="main">