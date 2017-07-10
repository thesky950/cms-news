<?php 
if (isset($_GET["cid"])) {
	$id = $_GET["cid"];
	checkId ($id,"controller=post");
	post_delete($conn,$id);
} else {
	redirect("controller=post");
}
?>