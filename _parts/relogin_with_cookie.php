<?php
if ( isset($_COOKIE['email']) && !isset($_SESSION['email']) ) {
	require_once('connection.php');
	$query = "SELECT email
			  FROM users
			  WHERE email = '{$_COOKIE['email']}'";
	$result = mysql_query($query, $mysql_connection);
	if ( mysql_num_rows($result) > 0 ) {
		$_SESSION['email'] = $_COOKIE['email'];
	}
}
