<?php
session_start();

function redirect_if_not_logged_in( $target = null ) {
	if ( !isset($_SESSION['email']) ) {
		redirect_to($target);
	}
}
