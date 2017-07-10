<?php
function listDashboard_1 ($conn){
	$stmt=$conn->prepare("SELECT * FROM `news_post` ORDER BY id DESC LIMIT 0,3");
	$stmt-> execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
} 
function listDashboard_2 ($conn){
	$stmt=$conn->prepare("SELECT * FROM `news_post` ORDER BY id DESC LIMIT 3,3");
	$stmt-> execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
} 
function listDashboard_3 ($conn){
	$stmt=$conn->prepare("SELECT * FROM `news_post` ORDER BY id DESC LIMIT 6,3");
	$stmt-> execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
} 


?>