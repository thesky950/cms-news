<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];

	$stmt = $conn->prepare("SELECT MAX(`position`) as position FROM `news_category` WHERE `parent_id` = :parent_id");
	$stmt->bindParam("parent_id", $id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	$position = $data["position"] + 1;
	echo $position;
}
?>