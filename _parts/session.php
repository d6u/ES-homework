<?php
session_start();

if ( isset($_COOKIE['email']) && $_COOKIE['email'] != 'logout' && !isset($_SESSION['email']) ) {
	require_once('connection.php');
	$query = "SELECT email
			  FROM users
			  WHERE email = '{$_COOKIE['email']}'";
	$result = mysql_query($query, $mysql_connection);
	if ( mysql_num_rows($result) > 0 ) {
		$_SESSION['email'] = $_COOKIE['email'];
	} else {
		setcookie('email', 'logout', time()-42000, '/');
	}
}
