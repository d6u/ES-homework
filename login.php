<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php
$login_title = "Login/Register";
$login_header = "Welcome to Restaurant Review Site";
$login_message = "This is the login/register page, please enter your username and password in related field.";
$login_message_style = "banner-introduction";

if ( isset($_POST["login_user_email"]) && isset($_POST["login_user_pass"]) ) {
	// user login
	require_once("_parts/connection.php"); // $mysql_connection
	$email = trim($_POST["login_user_email"]);
	$query = 	"SELECT email, hash_pass
				 FROM users
				 WHERE email = '{$email}'";
	$result = mysql_query($query, $mysql_connection);
	$row = mysql_fetch_array($result);
	if ( $row['hash_pass'] == sha1($_POST['login_user_pass']) ) {
		$_SESSION["email"] = $email;
		// if ( isset($_POST["rememberme"]) ) $_SESSION["rememberme"] = $_POST["rememberme"]; // forever
		redirect_to('index.php');
	} else {
		$login_warning = "User email and password does not match.";
		$last_email = $email;
	}
} elseif ( isset($_SESSION["email"]) ) {
	// user already logged in
	redirect_to("backend/user_panel.php");
}
?>
<?php require_once("_parts/login_header.php") ?>

<div class="left-block">
	<h2 class="form-title">Login here</h2>
	<form class="input-form" method="post" action="login.php">
		<div class="input-section">
			<label for="login_user_email">
				<div>Email Address</div>
				<input type="text" name="login_user_email" id="login_user_email" value="<?php if ( isset($last_email) ) echo $last_email; ?>" tabindex="10">
			</label>
		</div>
		<div class="input-section">
			<label for="login_user_pass">
				<div>Password</div>
				<input type="password" name="login_user_pass" id="login_user_pass" tabindex="20">
			</label>
		</div>
		<div class="input-section-bottom clearfix">
			<input type="submit" name="login_submit" id="login_submit" class="blue-button" value="Log In" tabindex="40">
			<label for="rememberme">
				<input type="checkbox" name="rememberme" id="rememberme" value="forever" tabindex="30" checked="checked">
				<span>Remember Me</span>
			</label>
		</div>
		<div id="login-warning"><?php if ( isset($login_warning) ) echo $login_warning; ?></div>
	</form>
</div>
<div class="right-block">
	<h2 class="form-title">Register here</h2>
	<form class="input-form" method="post" action="register.php">
		<div class="input-section">
			<label for="register_user_email">
				<div>Email Address</div>
				<input type="text" name="register_user_email" id="register_user_email" tabindex="110">
			</label>
		</div>
		<div class="input-section">
			<label for="register_user_pass">
				<div>Password</div>
				<input type="password" name="register_user_pass" id="register_user_pass" tabindex="120">
			</label>
		</div>
		<div class="input-section">
			<label for="register_user_pass_repeat">
				<div>Repeat Your Password</div>
				<input type="password" name="register_user_pass_repeat" id="register_user_pass_repeat" tabindex="130">
			</label>
		</div>
		<div class="input-section-bottom clearfix">
			<input type="submit" name="register_submit" id="register_submit" class="blue-button" value="Register" tabindex="140">
		</div>
		<div id="register-warning"></div>
	</form>
</div>

<?php require_once("_parts/login_footer.php");
