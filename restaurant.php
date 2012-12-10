<?php require_once("_parts/session.php"); ?>
<?php require_once("_parts/functions.php"); ?>
<?php require_once("_parts/connection.php"); ?>
<?php $current_page = "Restaurant Profile"; ?>
<?php
if ( !isset($_GET['id']) ) {
	redirect_to("index.php");
} else {
	// load restaurant information
	$query = "SELECT *
			  FROM restaurants
			  WHERE r_id = '{$_GET['id']}'";
	$result = mysql_query($query, $mysql_connection);
	if ( mysql_num_rows($result) != 1 ) {
		die("Something wrong with the query statement");
	}
	$row = mysql_fetch_array($result);
	$name = $row['r_name'];
	$addr = $row['r_address'];
	if ( $row['r_tell'] != "" ) {
		$tell = $row['r_tell'];
	}
	if ( $row['r_cat'] != "" ) {
		$cat = $row['r_cat'];
	}
	if ( $row['r_desc'] != "" ) {
		$desc = $row['r_desc'];
	}
	if ( $row['r_pic_url'] != "" ) {
		$pic_url = "restaurant_image/".$row['r_pic_url']; // need extension
	} else {
		$pic_url = "_image/restaurant_default.jpeg";
	}
	
	// load related dish information
	$query = "SELECT d_id, d_name, d_price, d_pic_url
			  FROM dishes
			  WHERE r_id = '{$_GET['id']}'";
	$result = mysql_query($query, $mysql_connection);
	if ( mysql_num_rows($result) == 0 ) {
		// no dishes related
		$dishes = null;
	} else {
		// has dishes related
		$dishes = array();
		while ( $row = mysql_fetch_array($result) ) {
			array_push($dishes, $row);
		}
	}
}
?>
<?php require_once("_parts/header.php"); ?>

<div class="r-pic-wrapper">
	<img src="<?php echo $pic_url; ?>" alt="Restaurant Picture" />
</div>
<div class="r-content-wrapper">
	<h2 class="r-name"><?php echo $name; ?></h2>
	<?php if (isset($cat)) echo '<h3 class="r-cat">'.$cat.'</h3>'; ?>
	<p class="r-address"><?php echo $addr; ?></p>
	<?php if (isset($tell)) echo '<p class="r-tell">'.$tell.'</p>'; ?>
	<hr class="hr-line"/>
	<p class="r-desc"><?php if (isset($desc)) echo $desc; ?></p>
</div>
<div class="r-dishes-wrapper clearfix">
	<?php 
	if ( !is_null($dishes) ) {
		$length = count($dishes) - 1;
		foreach ($dishes as $key => $dish) {
			$div = '<a class="dish-achor" id="dish_'.$dish['d_id'].'" href="#"><div class="dish">';
			if ( $dish['d_pic_url'] == "" ) {
				$div .= '<img src="_image/dish_default.jpeg" alt="Dish Picture" />';
			} else {
				$div .= '<img src="dish_image/'.$dish['d_pic_url'].'" alt="Dish Picture" />';
			}
			$div .= '<div class="dish-info">';
			$div .= '<h4 class="dish-name">'.$dish['d_name'].'</h4>';
			$div .= '<p class="dish-price">$ '.$dish['d_price'].'</p>';
			$div .= '</div></div></a>';
			echo $div;
			if ( $length == $key ) {
				$detail_div = '<div class="detail-block"></div>';
				echo $detail_div;
			} else if ( $key % 3 == 2 ) {
				$detail_div = '<div class="detail-block"></div>';
				echo $detail_div;
			}
		}
	}
	?>
</div>
<div class="comment-wrapper">
	<div class="comment-wrapper-title">User Comments</div>
	<?php 
	$query = "SELECT u.first, u.email, c.title, c.r_rating, c.d_id, c.content, c.post_date
			  FROM comments c
			  JOIN users u
			  WHERE r_id = '{$_GET['id']}'
			  AND c.user_id = u.user_id
			  ORDER BY c.post_date";
	$result = mysql_query($query, $mysql_connection);
	if ( $result ) {
		while ( $row = mysql_fetch_array($result) ) {
			$echo = '<div class="comment-block">';
			$echo .= '<div class="comment-info clearfix">';
			// name
			if ( $row['first'] == "" ) {
				$first = $row['email'];
			} else {
				$first = $row['first'];
			}
			$echo .= '<span class="comment-user-name">'.$first.'</span>';
			// title
			$echo .= '<span class="comment-title">'.$row['title'].'</span>';
			// rating
			if ( $row['r_rating'] != "" ) {
				$echo .= '<span class="comment-rating">'.$row['r_rating'].'</span>';
			}
			// dish
			if ( $row['d_id'] != "" ) {
				$dish_query = "SELECT d_name
							   FROM dishes
							   WHERE d_id = '{$row['d_id']}'";
				$dish_result = mysql_query($dish_query, $mysql_connection);
				$dish_row = mysql_fetch_array($dish_result);
				$echo .= '<span class="comment-dish">'.$dish_row['d_name'].'</span>';
			}
			$echo .= '</div>';
			// content
			$echo .= '<div class="comment-content">'.$row['content'].'</div>';
			$echo .= '</div>';
			echo $echo;
		}
	}
	?>
</div>
	<?php if ( isset($_SESSION['email']) ): ?>
	<form class="user-comment-area" method="post" action="comment_post.php">
		<input type="hidden" name="r_id" value="<?php echo $_GET['id']; ?>" />
		<div class="user-comment-area-title">Please leave your comment here</div>
		<div class="user-comment-meta clearfix">
			<input type="text" name="title" placeholder="Optional Title" />
			<span>Rating: </span>
			<select name="rating">
				<option value="5">5</option>
				<option value="4">4</option>
				<option value="3">3</option>
				<option value="2">2</option>
				<option value="1">1</option>
				<option value="0">0</option>
			</select>
				<?php
				if ( !is_null($dishes) ) {
					$dish_echo = '</br><span>Related dish: </span>';
					$dish_echo .= '<select name="related_dish">';
					foreach ($dishes as $dish) {
						$dish_echo .= "<option value=\"{$dish['d_id']}\">{$dish['d_name']}</option>";
					}
					$dish_echo .= '</select>';
					echo $dish_echo;
				}
				?>
		</div>
		<div class="user-comment-content">
			<textarea name="content"></textarea>
			<input type="submit" name="submit" value="Submit" id="user-comment-submit" class="blue-button" />
		</div>
	</form>
	<?php endif; ?>
<?php $file_name = basename(__FILE__, '.php'); ?>
<?php require_once("_parts/footer.php");