<?php require_once("_parts/session.php") ?>
<?php require_once("_parts/connection.php") ?>
<?php require_once("_parts/functions.php") ?>
<?php
if ( isset($_POST['content']) && isset($_SESSION['email']) ) {
	$user_id_query = "SELECT user_id
					  FROM users
					  WHERE email = '{$_SESSION['email']}'";
	$user_id_result = mysql_query($user_id_query, $mysql_connection);
	$user_id_row = mysql_fetch_array($user_id_result);
	$user_id = $user_id_row['user_id'];
	$query = "INSERT INTO comments ( user_id, title, post_date, content, r_id, d_id, r_rating )
			  VALUES ('{$user_id}', '{$_POST['title']}', '".time()."', '{$_POST['content']}', '{$_POST['r_id']}', '{$_POST['related_dish']}', '{$_POST['rating']}')";
	$result = mysql_query($query, $mysql_connection);
	if ($result) {
		redirect_to('restaurant.php?id='.$_POST['r_id'].'');
	} else {
		die(mysql_error());
	}
	
} else {
	redirect_to('index.php');
}
