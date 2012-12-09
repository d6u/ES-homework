<?php require_once("../_parts/connection.php") ?>
<?php require_once("../_parts/functions.php") ?>
<?php
if ( isset($_POST['search']) && $_POST['search'] != "" ) {
	// search restaurants
	$query = "SELECT r_id, r_name, r_address
			  FROM restaurants
			  WHERE r_name LIKE '%{$_POST['search']}%'
			  LIMIT 5";
	$result = mysql_query($query, $mysql_connection);
	if ( $result ) {
		$num = mysql_num_rows($result);
		if ( $num > 0 ) {
			$restaurant = array();
			for ($i = 0; $i < $num; $i++) {
				$row = mysql_fetch_array($result);
				array_push($restaurant, $row);
			}
		} else {
			$restaurant = false;
		}
	} // end of $result
	
	// search dishes
	$query = "SELECT d_id, d_name, d.r_id, r.r_name
			  FROM dishes d, restaurants r
			  WHERE d.r_id = r.r_id
			  AND d_name LIKE '%{$_POST['search']}%'
			  LIMIT 5";
	$result = mysql_query($query, $mysql_connection);
	if ( $result ) {
		$num = mysql_num_rows($result);
		if ( $num > 0 ) {
			$dish = array();
			for ($i = 0; $i < $num; $i++) {
				$row = mysql_fetch_array($result);
				array_push($dish, $row);
			}
		} else {
			$dish = false;
		}
	} // end of $result
	
	// send result
	$json = array('restaurant' => $restaurant, 'dish' => $dish);
	echo json_encode($json);
}
