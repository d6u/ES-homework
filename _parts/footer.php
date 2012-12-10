		</div>
		<div class="main-shadow"></div>
		<div class="footer">
			<p class="footer-copyright">@Copyright Reserved</p>
			<ul class="footer-menu">
				<li class="footer-menu-item"><a href="about.php">About</a></li>
			</ul>
		</div>
	</div>
	<!-- Javascript -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="_js/jquery-1.8.2.min.js"><\/script>')</script>
	<?php
	switch ($file_name) {
		case 'user_panel':
			echo '<script src="_js/user_panel.js"></script>';
		case 'index':
		case 'restaurant':
		case 'about':
			echo '<script src="_js/main.js"></script>';
			break;
	}
	?>
</body>
</html>
<?php mysql_close($mysql_connection);