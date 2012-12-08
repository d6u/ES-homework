<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php require_once("_parts/connection.php"); ?>
<?php $current_page = "Restaurant Profile"; ?>
<?php
if ( !isset($_GET['id']) ) {
	redirect_to("index.php");
} else {
	$query = "SELECT *
			  FROM restaurants
			  WHERE r_id = '{$_GET['id']}'";
	$result = mysql_query($query, $mysql_connection);
	if ( mysql_num_rows($result) != 1 ) {
		die("Something wrong with the query statement");
	}
	
	
	$row = mysql_fetch_array($result);
	$name = $row['r_name'];
	$addr = $row['r_address'];
	if ( $row['r_tell'] != "" ) {
		$tell = $row['r_tell'];
	}
	if ( $row['r_cat'] != "" ) {
		$cat = $row['r_cat'];
	}
	if ( $row['r_desc'] != "" ) {
		$desc = $row['r_desc'];
	}
	
	if ( $row['r_pic_url'] != "" ) {
		$pic_url = $row['r_pic_url'];
	} else {
		$pic_url = "_image/restaurant_default.jpeg";
	}
}
?>
<?php require_once("_parts/header.php"); ?>

<div class="r-pic-wrapper">
	<img src="<?php echo $pic_url; ?>" alt="Restaurant Picture" />
</div>
<div class="r-content-wrapper">
	<h2 class="r-name"><?php echo $name; ?></h2>
	<?php if (isset($cat)) echo '<h3 class="r-cat">'.$cat.'</h3>'; ?>
	<p class="r-address"><?php echo $addr; ?></p>
	<?php if (isset($tell)) echo '<p class="r-tell">'.$tell.'</p>'; ?>
	<hr class="hr-line"/>
	<p class="r-desc"><?php if (isset($desc)) echo $desc; ?></p>
</div>

<?php $file_name = basename(__FILE__, '.php'); ?>
<?php require_once("_parts/footer.php");