<?php
require_once("_parts/session.php");
require_once("_parts/connection.php"); // $mysql_connection
require_once("_parts/functions.php");


if ( isset($_POST['register_user_email']) ) {
	$user_email = trim($_POST['register_user_email']);
	$user_pass = trim($_POST['register_user_pass']);
	$hashed_pass = sha1($user_pass);
	$query = 	"INSERT INTO users ( email, hash_pass )
				 VALUES ( '{$user_email}', '{$hashed_pass}')";
	$result = mysql_query($query, $mysql_connection);
	if ($result) {
		$success = true;
		$_SESSION["email"] = $user_email;
	} else {
		$success = false;
		die("How could this happen?");
	}
} else if ( isset($_SESSION["email"]) ) {
	redirect_to('back_end/user_panel.php');
} else {
	redirect_to('login.php');
}
?>
<?php require_once("_parts/login_header.php") ?>



<?php require_once("_parts/login_footer.php");