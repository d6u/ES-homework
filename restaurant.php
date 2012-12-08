<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php require_once("_parts/connection.php"); ?>
<?php $current_page = "Restaurant Profile"; ?>
<?php
if ( !isset($_GET['id']) ) {
	redirect_to("index.php");
} else {
	// load restaurant information
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
	
	// load related dish information
	$query = "SELECT d_id, d_name, d_price, d_pic_url
			  FROM dishes
			  WHERE r_id = '{$_GET['id']}'";
	$result = mysql_query($query, $mysql_connection);
	if ( mysql_num_rows($result) == 0 ) {
		// no dishes related
		$dishes = null;
	} else {
		// has dishes related
		$dishes = array();
		while ( $row = mysql_fetch_array($result) ) {
			array_push($dishes, $row);
		}
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
<div class="r-dishes-wrapper clearfix">
	<?php 
	if ( !is_null($dishes) ) {
		foreach ($dishes as $dish) {
			$div = '<a class="dish-achor" href="dish.php?id='.$dish['d_id'].'"><div class="dish">';
			if ( $dish['d_pic_url'] == "" ) {
				$div .= '<img src="_image/dish_default.jpeg" alt="Dish Picture" />';
			} else {
				$div .= '<img src="'.$dish['d_pic_url'].'" alt="Dish Picture" />';
			}
			$div .= '<div class="dish-info">';
			$div .= '<h4 class="dish-name">'.$dish['d_name'].'</h4>';
			$div .= '<p class="dish-price">$ '.$dish['d_price'].'</p>';
			$div .= '</div></div></a>';
			echo $div;
		}
	}
	?>
</div>

<?php $file_name = basename(__FILE__, '.php'); ?>
<?php require_once("_parts/footer.php");