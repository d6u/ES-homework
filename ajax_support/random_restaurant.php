<?php require_once("../_parts/connection.php") ?>
<?php require_once("../_parts/functions.php") ?>
<?php
if ( isset($_POST['random']) && $_POST['random'] == true ) {
	$query = "SELECT r_id
			  FROM restaurants
			  ORDER BY RAND( )
			  LIMIT 0,1";
	$result = mysql_query($query, $mysql_connection);
	$row = mysql_fetch_array($result);
	$json = array('restaurant' => $row);
	echo json_encode($json);
}
