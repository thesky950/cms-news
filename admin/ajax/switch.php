<?php 
if (isset($_GET["state"]) && isset($_GET["id"]) && isset($_GET["table"]) && isset($_GET["col"])) {
	$s     = $_GET["state"];
	$table = $_GET["table"];
	$col   = $_GET["col"];
	$id    = $_GET["id"];

	if ($s == "true") {
		$state = "On";
	}
	if ($s == "false") {
		$state = "Off";
	}

	$stmt = $conn->prepare("UPDATE `$table` SET $col = :$col WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->bindParam(":$col",$state,PDO::PARAM_STR);
	$stmt->execute();
} 
?>