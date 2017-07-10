<?php 
function getPostNew1($conn){
	$stmt = $conn->prepare("SELECT `id`,`name`, `image` FROM `news_post` WHERE `access` = 0 AND `status` = 'On' ORDER BY id DESC LIMIT 0,4");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);	
}
function getPostNew2($conn){
	$stmt = $conn->prepare("SELECT `id`,`name`, `image` FROM `news_post` WHERE `access` = 0 AND `status` = 'On' ORDER BY id DESC LIMIT 4,4");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);	
}
function getPostNew3($conn){
	$stmt = $conn->prepare("SELECT `id`,`name`, `image` FROM `news_post` WHERE `access` = 0 AND `status` = 'On' ORDER BY id DESC LIMIT 8,2");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);	
}
function getPostNew4($conn){
	$stmt = $conn->prepare("SELECT `id`,`name`, `image` FROM `news_post` WHERE `access` = 0 AND `status` = 'On' ORDER BY id DESC LIMIT 10,2");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);	
}
function getPostNew5($conn){
	$stmt = $conn->prepare("SELECT `id`,`name`, `image` FROM `news_post` WHERE `access` = 0 AND `status` = 'On' ORDER BY id DESC LIMIT 12,3");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);	
}

?>