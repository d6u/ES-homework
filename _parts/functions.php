<?php
error_reporting(E_ALL);

function redirect_to( $location = NULL ) {
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

require_once("jsonwrapper.php");
