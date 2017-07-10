<?php 
if (isset($_GET["cid"])) {
	$id = $_GET["cid"];
	checkId ($id,"controller=user");
	delete_user($conn,$id);
} else {
	redirect("controller=user");
}
?>