<?php 
include 'models/Post.php';
if (isset($_GET["action"])) {
	$action = $_GET["action"];
	switch ($action) {
		case 'add':
			include 'resources/views/post/add.php';
			break;
		case 'edit':
			include 'resources/views/post/edit.php';
			break;
		case 'delete':
			include 'resources/views/post/delete.php';
			break;
		case 'list':
			include 'resources/views/post/list.php';
			break;
		default:
			include 'resources/views/post/list.php';
			break;
	}
} else {
	include 'resources/views/post/list.php';
}
?>