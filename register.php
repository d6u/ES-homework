<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php require_once("_parts/connection.php"); ?>
<?php
$login_title = "Register Successful";
$login_header = "Congratulations! You are now a member of Razor Eat!";

$login_message = "Please take some time to complete profiles, we can do this later.";
$login_message .= "</br>";
$login_message .= "Or, you can <a class= \"underline-achor\" href=\"index.php\">start suffering our coolest website!</a>";

$login_message_style = "register-introduction";


if ( isset($_SESSION["email"]) ) {
	// user already login
	redirect_to('user_panel.php');
} else if ( isset($_POST['register_user_email']) && isset($_POST['register_user_pass']) ) {
	// user register
	$user_email = trim($_POST['register_user_email']);
	$user_pass = trim($_POST['register_user_pass']);
	$hashed_pass = sha1($user_pass);
	$query = 	"INSERT INTO users ( email, hash_pass )
				 VALUES ( '{$user_email}', '{$hashed_pass}')";
	$result = mysql_query($query, $mysql_connection);
	if ($result) {
		$_SESSION["email"] = $user_email;
		setcookie('email', $user_email, time() + 60*60*24*365, '/');
	} else {
		die("How could this happen?");
	}
} else {
	// user not logged in and not register
	redirect_to('login.php');
}
?>
<?php require_once("_parts/login_header.php") ?>

<h2 class="form-title">Complete your profile</h2>
<form class="profile-form" method="post" action="user_panel.php">
	<div class="input-section">
		<label for="user_first">
			<div>First Name</div>
			<input type="text" name="user_first" id="user_first" tabindex="10">
		</label>
	</div>
	<div class="input-section">
		<label for="user_last">
			<div>Last Name</div>
			<input type="text" name="user_last" id="user_last" tabindex="20">
		</label>
	</div>
	<div class="input-section clearfix">
		<div>Gender</div>
		<label for="male">
			<input type="radio" name="gender" id="male" value="m" tabindex="30" />
			<span>Male</span>
		</label>
		<label for="female">
			<input type="radio" name="gender" id="female" value="f" tabindex="40" />
			<span>Female</span>
		</label>
	</div>
	<div class="input-section">
		<label for="user_dob">
			<div>Date of Birth</div>
			<input type="date" name="user_dob" id="user_dob" tabindex="50">
		</label>
	</div>
	<div class="input-section-bottom clearfix">
		<input type="submit" name="submit" id="submit" class="blue-button" value="Submit" tabindex="60">
	</div>
</form>

<?php require_once("_parts/login_footer.php");