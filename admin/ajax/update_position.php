<?php 
if (isset($_GET["id"]) && isset($_GET["pos"])) {
	$id  = $_GET["id"];
	$pos = $_GET["pos"];

	$stmt = $conn->prepare("UPDATE `news_category` SET `position` = :position WHERE `id` = :id");
	$stmt->bindParam("id", $id,PDO::PARAM_INT);
	$stmt->bindParam("position", $pos,PDO::PARAM_INT);
	$stmt->execute();
	echo "Success";
}
?>