<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	$con = mysqli_connect("localhost", "root" , "" , "phpmaket");
	mysqli_set_charset($con, "utf8");

	if(mysqli_connect_errno()) {
		echo "Failed to connect MySQL: ". mysqli_connect_error();
		exit();
	}
?>