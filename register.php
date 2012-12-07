<?php
require_once("_parts/connection.php"); // $mysql_connection
require_once("_parts/functions.php");


if ( isset($_POST['register_submit']) ) {
	$user_email = trim($_POST['register_user_email']);
	$user_pass = trim($_POST['register_user_pass']);
	$hashed_pass = sha1($user_pass);
	$query = 	"INSERT INTO users ( email, hash_pass )
				 VALUES ( '{$user_email}', '{$hashed_pass}')";
	$result = mysql_query($query, $mysql_connection);
	if ($result) {
		$success = true;
	} else {
		$success = false;
	}
} else {
	redirect_to('login.php');
}
?>
<?php require_once("_parts/login_header.php") ?>



<?php require_once("_parts/login_footer.php");