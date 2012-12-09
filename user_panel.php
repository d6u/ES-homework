<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php require_once("_parts/connection.php"); ?>
<?php
$current_page = "User Panel";

if ( isset($_SESSION['email']) ) {
	// user logged in
	if ( isset($_POST['user_first']) || isset($_POST['user_last']) || isset($_POST['gender']) || isset($_POST['user_dob']) ) {
		// submitting changes in profile
		$first = trim($_POST['user_first']);
		$last = trim($_POST['user_last']);
		
		if ( isset($_POST['gender']) ) {
			$gender = $_POST['gender'];
		} else {
			$gender = "";
		}
		
		$dob = $_POST['user_dob'];
		
		if ( $first != "" ) {
			$query = "UPDATE users
					  SET first = '{$first}'
					  WHERE email = '{$_SESSION['email']}'";
			$result = mysql_query($query, $mysql_connection);
			if ( !$result ) {
				mysql_error();
				die("How could this happen?");
			}
		}
		if ( $last != "" ) {
			$query = "UPDATE users
					  SET last = '{$last}'
					  WHERE email = '{$_SESSION['email']}'";
			$result = mysql_query($query, $mysql_connection);
			if ( !$result ) {
				mysql_error();
				die("How could this happen?");
			}
		}
		if ( $gender != "" ) {
			$query = "UPDATE users
					  SET gender = '{$gender}'
					  WHERE email = '{$_SESSION['email']}'";
			$result = mysql_query($query, $mysql_connection);
			if ( !$result ) {
				mysql_error();
				die("How could this happen?");
			}
		}
		if ( $dob != "" ) {
			$query = "UPDATE users
					  SET date_of_birth = '{$dob}'
					  WHERE email = '{$_SESSION['email']}'";
			$result = mysql_query($query, $mysql_connection);
			if ( !$result ) {
				mysql_error();
				die("How could this happen?");
			}
		}
		
		// redirect to self prevent resubmitting form
		redirect_to("user_panel.php");
	} // end of submitting changes in profile
} else {
	// user not logged in
	redirect_to("login.php");
}

// CRUD data
$query = "SELECT *
		  FROM users
		  WHERE email = '{$_SESSION['email']}'";
$result = mysql_query($query, $mysql_connection);
if ($result) {
	$row = mysql_fetch_array($result);
	$first = $row['first'];
	$last = $row['last'];
	$email = $row['email'];
	
	$gender_symble = $row['gender'];
	if ( $gender_symble == "m" ) {
		$gender = "Male";
	} elseif ( $gender_symble == "f" ) {
		$gender = "Female";
	} else {
		$gender = null;
	}
	
	$dob = $row['date_of_birth'];
	$user_pic_url = $row['user_pic'];
	$role = $row['role'];
} else {
	mysql_error();
	die("How could this happen?");
}
?>
<?php require_once("_parts/header.php"); ?>

<div class="user-inner clearfix">
	<div class="inner-left">
		<div class="pic-wrapper">
			<img src="<?php
			if ( $user_pic_url != "" ) {
				echo "user_pics/".$user_pic_url;
			} else {
				echo "_image/default_user_pic.jpg";
			}
			?>" alt="User Picture" />
		</div>
	</div>
	<div class="inner-right" id="inner-profile-show">
		<div class="profile-block">
			<h3><span class="firstname"><?php echo $first; ?></span> <span class="lastname"><?php echo $last; ?></span></h3>
		</div>
		<div class="profile-block">
			<h4>Email</h4>
			<p id="email_address"><?php echo $email; ?></p>
		</div>
		<div class="profile-block">
			<h4>Gender</h4>
			<p><?php echo $gender; ?></p>
		</div>
		<div class="profile-block">
			<h4>Date of Birth</h4>
			<p><?php echo $dob; ?></p>
		</div>
		<div class="profile-block">
			<h4>User Group</h4>
			<p><?php echo $role; ?></p>
		</div>
		<div class="profile-block-bottom">
			<input type="button" class="blue-button" id="edit-profile-button" name="submit" value="Edit Profile" />
		</div>
	</div>
	<div class="inner-right" id="inner-profile-edit">
		<form method="post" action="user_panel.php">
			<div class="profile-block">
				<label for="user_first">
					<div>First Name</div>
					<input type="text" name="user_first" id="user_first" tabindex="10">
				</label>
			</div>
			<div class="profile-block">
				<label for="user_last">
					<div>Last Name</div>
					<input type="text" name="user_last" id="user_last" tabindex="20">
				</label>
			</div>
			<div class="profile-block clearfix">
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
			<div class="profile-block">
				<label for="user_dob">
					<div>Date of Birth</div>
					<input type="date" name="user_dob" id="user_dob" tabindex="50">
				</label>
			</div>
			<div class="profile-block-bottom">
				<input type="submit" class="blue-button" id="submit-profile-button" name="submit" value="Update Profile" />
			</div>
		</form>
	</div>
</div>

<?php $file_name = basename(__FILE__, '.php'); ?>
<?php require_once("_parts/footer.php");