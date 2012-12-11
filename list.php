<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php require_once("_parts/connection.php"); ?>
<?php
if ( isset($_GET['type']) ) {
	$echo = '<div class="list-wrapper">';
	$echo .= '<h2 class="list-cat-title">'.$_GET['cat'].'</h2>';
	if ( $_GET['type'] == 'r' ) {
		// restaurant list
		$current_page = "Restaurant Category";
		$query = "SELECT r_id, r_name, r_address, r_cat
				  FROM restaurants
				  WHERE r_cat LIKE '%{$_GET['cat']}%'";
		$result = mysql_query($query, $mysql_connection);
		while ( $row = mysql_fetch_array($result) ) {
			$echo .= '<a href="restaurant.php?id='.$row['r_id'].'">';
			$echo .= '<h3 class="list-r-name">'.$row['r_name'].'</h3>';
			$echo .= '<h4 class="list-r-cat">'.$row['r_cat'].'</h4>';
			$echo .= '<p class="list-r-addr">'.$row['r_address'].'</p>';
			$echo .= '</a>';
		}
	} elseif ( $_GET['type'] == 'd' ) {
		// dish list
		$current_page = "Dish Category";
		$query = "SELECT d.d_id, d.d_name, d.d_cat, d.d_price, r.r_id, r.r_name
				  FROM restaurants r, dishes d
				  WHERE d.d_cat LIKE '%{$_GET['cat']}%'
				  AND d.r_id = r.r_id";
		$result = mysql_query($query, $mysql_connection);
		while ( $row = mysql_fetch_array($result) ) {
			$echo .= '<a href="restaurant.php?id='.$row['r_id'].'#dish_'.$row['d_id'].'">';
			$echo .= '<h3 class="list-r-name">'.$row['d_name'].'</h3>';
			$echo .= '<h4 class="list-restaurant-name">'.$row['r_name'].'</h4>';
			$echo .= '<h4 class="list-r-cat">'.$row['d_cat'].'</h4>';
			$echo .= '<p class="list-r-addr">$ '.$row['d_price'].'</p>';
			$echo .= '</a>';
		}
	}
	$echo .= '</div>';
} else {
	redirect_to('index.php');
}
?>
<?php require_once("_parts/header.php"); ?>

<?php echo $echo; ?>

<?php $file_name = basename(__FILE__, '.php'); ?>
<?php require_once("_parts/footer.php");
