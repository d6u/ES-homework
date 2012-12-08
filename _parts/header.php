<?php 
if ( isset($_SESSION['email']) ) {
	// user logged in
	$query = "SELECT first, email
			  FROM users
			  WHERE email = '{$_SESSION['email']}'";
	$result = mysql_query($query, $mysql_connection);
	if ($result && mysql_num_rows($result) != 0) {
		$row = mysql_fetch_array($result);
		if ( $row['first'] == '' ) {
			// first name is not set
			$display_name = $row['email'];
		} else {
			// first name is set
			$display_name = $row['first'];
		}
	} else {
		die("How could this happen?");
	}
}
?>

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
				<a href="index.php">Restaurant Review</a>
			</div>
			<ul class="banner-menu">
				<li class="banner-menu-item"><a href="index.php">Home</a></li>
				<li class="banner-menu-item"><a href="#">About</a></li>
				<li class="banner-menu-item">
				<?php if ( isset($display_name) ): ?>
					<span>Hello! </span>
					<a href="user_panel.php"><?php echo $display_name; ?></a>
				</li>
				<li class="banner-menu-item">
					<a href="logout.php">Log Out</a>
				<?php endif; ?>
				<?php if ( !isset($display_name) ): ?>
					<a href="login.php">Login/Register</a>
				<?php endif; ?>
				</li>
			</ul>
		</div>
		<div class="information"><?php echo $current_page; ?></div>
		<div class="search">
			<div class="search-top">
				<input type="button" id="category-button" class="transition" value="Show Category" />
				<input type="text" id="search-input" placeholder="Search for Favorite" />
				<input type="button" id="search-button" class="transition" value="Feeling Hungry" />
			</div>
			<div class="search-show">
				<div id="search-message"></div>
				<ul id="search-result-restaurant-list"></ul>
			</div>
		</div>
		<div class="main">