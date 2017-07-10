<?php 
ob_start();
session_start();
include '../../configuration.php';
include '../../vendor/database.php';
include '../../vendor/functions.php';
auth ($_SESSION["login"]["user_level"],"../login.php");

if (isset($_GET["p"])) {
	switch ($_GET["p"]) {
		
		case 'switch':
			include 'switch.php';
			break;
		case 'position':
			include 'position.php';
			break;
		case 'update_position':
			include 'update_position.php';
			break;
		default:
			header("location:../login.php");
			exit();
			break;
	}
} else {
	header("location:../login.php");
	exit();
}
?>