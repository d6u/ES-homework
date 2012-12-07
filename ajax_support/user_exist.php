<?php
require_once("../_parts/connection.php"); // $mysql_connection

$query = "SELECT * FROM users WHERE email = \"{$_POST['email']}\"";
$result = mysql_query($query, $mysql_connection);

if (mysql_num_rows($result) == 0) {
	// user doesn't exist
	echo 'false';
} else {
	// user exist
	echo 'true';
}

mysql_close($mysql_connection);