<?php 
include 'models/User.php';
if (isset($_GET["action"])) {
	$action = $_GET["action"];
	switch ($action) {
		case 'add':
			include 'resources/views/user/add.php';
			break;
		case 'edit':
			include 'resources/views/user/edit.php';
			break;
		case 'delete':
			include 'resources/views/user/delete.php';
			break;
		case 'list':
			include 'resources/views/user/list.php';
			break;
		default:
			include 'resources/views/user/list.php';
			break;
	}
} else {
	include 'resources/views/user/list.php';
}
?>