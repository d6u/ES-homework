<?php
require_once("../_parts/connection.php"); // $mysql_connection
require_once("../_parts/functions.php");

if ( isset($_POST['load']) && $_POST['load'] == true ) {
	// load data
	$query = "SELECT * FROM users WHERE email = \"{$_POST['email']}\"";
	$result = mysql_query($query, $mysql_connection);
	
	if (mysql_num_rows($result) == 0) {
		mysql_error();
		die("How could this happen?");
	} else {
		// function successful
		$row = mysql_fetch_array($result);
		$json = array('first' => $row['first'], 'last' => $row['last'], 'gender' => $row['gender'], 'dob' => $row['date_of_birth']);
		echo json_encode($json);
	}
} else {
	// write data
	if ( $_POST['first'] != "" ) {
		$query = "UPDATE users
				  SET first = '{$_POST['first']}'
				  WHERE email = '{$_POST['email']}'";
		$result = mysql_query($query, $mysql_connection);
		if ( !$result ) {
			mysql_error();
			die("How could this happen?");
		}
	}
	if ( $_POST['last'] != "" ) {
		$query = "UPDATE users
				  SET last = '{$_POST['last']}'
				  WHERE email = '{$_POST['email']}'";
		$result = mysql_query($query, $mysql_connection);
		if ( !$result ) {
			mysql_error();
			die("How could this happen?");
		}
	}
	if ( $_POST['gender'] != "" ) {
		$query = "UPDATE users
				  SET gender = '{$_POST['gender']}'
				  WHERE email = '{$_POST['email']}'";
		$result = mysql_query($query, $mysql_connection);
		if ( !$result ) {
			mysql_error();
			die("How could this happen?");
		}
	}
	if ( $_POST['dob'] != "" ) {
		$query = "UPDATE users
				  SET date_of_birth = '{$_POST['dob']}'
				  WHERE email = '{$_POST['email']}'";
		$result = mysql_query($query, $mysql_connection);
		if ( !$result ) {
			mysql_error();
			die("How could this happen?");
		}
	}
	$json = array('success' => true);
	echo json_encode($json);
}

mysql_close($mysql_connection);