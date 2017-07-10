<?php 
include 'models/Category.php';
if (isset($_GET["action"])) {
	$action = $_GET["action"];
	switch ($action) {
		case 'add':
			include 'resources/views/category/add.php';
			break;
		case 'edit':
			include 'resources/views/category/edit.php';
			break;
		case 'delete':
			include 'resources/views/category/delete.php';
			break;
		case 'list':
			include 'resources/views/category/list.php';
			break;
		default:
			include 'resources/views/category/list.php';
			break;
	}
} else {
	include 'resources/views/category/list.php';
}
?>