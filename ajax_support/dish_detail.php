<?php require_once("../_parts/connection.php") ?>
<?php require_once("../_parts/functions.php") ?>
<?php
if ( isset($_POST['dish']) ) {
	$query = "SELECT d_id, d_desc, d_cat
			  FROM dishes
			  WHERE d_id = '{$_POST['dish']}'";
	$result = mysql_query($query, $mysql_connection);
	$row = mysql_fetch_array($result);
	$json = array('dish' => $row);
	echo json_encode($json);
}
