<?php 
function login ($conn,$data,&$error) {
	$stmt = $conn->prepare("SELECT * FROM `news_user` WHERE email = :email AND status = :status AND level = :level");
	$stmt->bindParam(":email",$data["email"],PDO::PARAM_STR);
	$stmt->bindParam(":status",$data["status"],PDO::PARAM_STR);
	$stmt->bindParam(":level",$data["level"],PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->rowCount();
	$user = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row != 0 && password_verify($data["password"],$user["password"])) {
		$_SESSION["login"]["user_id"]        = $user["id"];
		$_SESSION["login"]["user_email"]     = $user["email"];
		$_SESSION["login"]["user_level"]     = $user["level"];
		$_SESSION["login"]["user_firstname"] = $user["firstname"];
		$_SESSION["login"]["user_lastname"]  = $user["lastname"];
		$_SESSION["login"]["user_avatar"]    = $user["avatar"];
		redirect();
	} elseif($row != 0 && password_verify($data["password"],$user["password"])==false) {
		$error[] = "Sai password";
	} else {
		$error[] = "Lỗi đăng nhập, hãy kiểm tra lại";
	}
}
?>