<?php require_once("../_parts/connection.php") ?>
<?php require_once("../_parts/functions.php") ?>
<?php
if ( $_POST['search'] != "" ) {
	// search query
	// search restaurants
	$query = "SELECT r_id, r_name, r_address
			  FROM restaurants
			  WHERE r_name LIKE '%{$_POST['search']}%'";
	$result = mysql_query($query, $mysql_connection);
	if ( $result && mysql_num_rows($result) != 0 ) {
		$counter = 0;
		$restaurant = array();
		while ( $row = mysql_fetch_array($result) ) {
			array_push($restaurant, $row);
			if ( $counter > 4 ) {
				break;
			} else {
				$counter ++;
			}
		}
		$json = array('found' => true, 'restaurant' => $restaurant);
//		print_r($json);
		echo json_encode($json);
	} else {
		$json = array('found' => false);
		echo json_encode($json);
	}
	
	
	
	
	// search dishes
	
	
	
	
	// search users
}
