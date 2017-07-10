<?php 
if (isset($_GET["cid"])) {
	$id = $_GET["cid"];
	checkId ($id,"controller=category");
	category_delete ($conn,$id);
} else {
	redirect("controller=category");
}
?>