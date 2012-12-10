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

// load cats from r
$query = "SELECT DISTINCT r_cat
		  FROM restaurants";
$result = mysql_query($query, $mysql_connection);
$cats = array();
while ( $row = mysql_fetch_array($result) ) {
	$cat = trim($row['r_cat']);
	$small_cat = explode(', ', $cat);
	$count = count($small_cat);
	for ($i = 0; $i < $count; $i++) {
		array_push($cats, $small_cat[$i]);
	}
}
$unique_r_cats = array_unique($cats);

// load cats from d
$query = "SELECT DISTINCT d_cat
		  FROM dishes";
$result = mysql_query($query, $mysql_connection);
$cats = array();
while ( $row = mysql_fetch_array($result) ) {
	$cat = trim($row['d_cat']);
	$small_cat = explode(', ', $cat);
	$count = count($small_cat);
	for ($i = 0; $i < $count; $i++) {
		array_push($cats, $small_cat[$i]);
	}
}
$unique_d_cats = array_unique($cats);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Razor Eat</title>
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
				<a href="index.php">Razor Eat</a>
			</div>
			<ul class="banner-menu">
				<li class="banner-menu-item"><a href="index.php">Home</a></li>
				<li class="banner-menu-item"><a href="about.php">About</a></li>
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
				<input type="button" id="random-button" class="transition" value="Feeling Hungry" />
			</div>
			<div id="category-menu" class="clearfix">
				<div class="category-menu-r">
					<div class="category-menu-title">Restaurants Category</div>
					<ul class="cat-list">
					<?php
					foreach ($unique_r_cats as $cat) {
						echo '<li><a href="list.php?type=r&cat='.$cat.'">'.$cat.'</a></li>';
					}
					?>
					</ul>
				</div>
				<div class="category-menu-d">
					<div class="category-menu-title">Dishes Category</div>
					<ul class="cat-list">
					<?php
					foreach ($unique_d_cats as $cat) {
						echo '<li><a href="list.php?type=d&cat='.$cat.'">'.$cat.'</a></li>';
					}
					?>
					</ul>
				</div>
			</div>
			<div class="search-show">
				<div id="search-message"></div>
				<ul id="search-result-restaurant-list"></ul>
			</div>
		</div>
		<div class="main">