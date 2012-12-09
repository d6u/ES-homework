<?php require_once("_parts/functions.php"); ?>
<?php

// 1. Start the session
session_start();

if ( isset($_SESSION['email']) ) {
	// 2. Unset all the session variables
	$_SESSION = array();
	
	// 3. Destroy the session cookie
	setcookie('email', 'logout', time() + 1 , '/'); // firefox have a bug not forgetting cookies
	
	if( isset($_COOKIE[session_name()]) ) {
		setcookie(session_name(), '', time() - 42000, '/');
	}
	
	// 4. Destroy the session and remember me cookies
	session_destroy();
	
	redirect_to("login.php?logout=1");
}
