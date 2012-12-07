<?php require_once("_parts/functions.php"); ?>
<?php

// 1. Start the session
session_start();
// 2. Unset all the session variables
$_SESSION = array();
// 3. Destroy the session cookie
if(isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-42000, '/');
}
// 4. Destroy the session
session_destroy();
redirect_to("login.php?logout=1");
?>

<?php require_once("_parts/login_header.php") ?>



<?php require_once("_parts/login_footer.php");