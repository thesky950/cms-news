<?php  
function add ($conn,$data,&$error) {
	$check = $conn->prepare("SELECT `email` FROM `news_user` WHERE email = :email");
	$check->bindParam(":email",$data["email"],PDO::PARAM_STR);
	$check->execute();
	$rowCount = $check->rowCount();

	if ($rowCount == 0) {
		$stmt = $conn->prepare("INSERT INTO `news_user`(`email`, `password`, `level`, `firstname`, `lastname`, `phone`, `address`, `facebook`, `avatar`, `status`, `created_at`) VALUES (:email, :password,:level,:firstname,:lastname,:phone,:address,:facebook,:avatar, :status,:created_at)");
		$stmt->bindParam(":email",$data["email"],PDO::PARAM_STR);
		$stmt->bindParam(":password",$data["pass"],PDO::PARAM_STR);
		$stmt->bindParam(":level",$data["level"],PDO::PARAM_INT);
		$stmt->bindParam(":firstname",$data["firstname"],PDO::PARAM_STR);
		$stmt->bindParam(":lastname",$data["lastname"],PDO::PARAM_STR);
		$stmt->bindParam(":phone",$data["phone"],PDO::PARAM_STR);
		$stmt->bindParam(":address",$data["address"],PDO::PARAM_STR);
		$stmt->bindParam(":facebook",$data["facebook"],PDO::PARAM_STR);
		$stmt->bindParam(":avatar",$data["avatar"],PDO::PARAM_STR);
		$stmt->bindParam(":status",$data["status"],PDO::PARAM_STR);
		$stmt->bindParam(":created_at",$data["created_at"],PDO::PARAM_INT);
		$stmt->execute();

		if (isset($_POST["btnSaveNew"])) {
			setFlash ("success" , "Đã thêm User");
			redirect ('controller=user&action=add');
		}

		if (isset($_POST["btnSaveClose"])) {
			setFlash ("success" , "Đã thêm User");
			redirect ('controller=user');
		}
	} else {
		$error[] = "Email đã tồn tại, vui lòng chọn email khác";
	}
}

function listUser ($conn) {
	$stmt = $conn->prepare("SELECT id,email,level,status,firstname,lastname FROM `news_user`");
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function dataEdit ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM `news_user` WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function edit ($conn,$data) {
	$stmt = $conn->prepare("UPDATE `news_user` SET `password`=:password,`level`=:level,`firstname`=:firstname,`lastname`=:lastname,`phone`=:phone,`address`=:address,`facebook`=:facebook,`avatar`=:avatar,`status`=:status,`updated_at`=:updated_at WHERE `id`=:id");
	$stmt->bindParam(":id",$data["id"],PDO::PARAM_INT);
	$stmt->bindParam(":password",$data["pass"],PDO::PARAM_STR);
	$stmt->bindParam(":level",$data["level"],PDO::PARAM_INT);
	$stmt->bindParam(":firstname",$data["firstname"],PDO::PARAM_STR);
	$stmt->bindParam(":lastname",$data["lastname"],PDO::PARAM_STR);
	$stmt->bindParam(":phone",$data["phone"],PDO::PARAM_STR);
	$stmt->bindParam(":address",$data["address"],PDO::PARAM_STR);
	$stmt->bindParam(":facebook",$data["facebook"],PDO::PARAM_STR);
	$stmt->bindParam(":avatar",$data["avatar"],PDO::PARAM_STR);
	$stmt->bindParam(":status",$data["status"],PDO::PARAM_STR);
	$stmt->bindParam(":updated_at",$data["updated_at"],PDO::PARAM_INT);
	$stmt->execute();

	if (isset($_POST["btnSave"])) {
		setFlash ("success" , "Đã sửa User");
		redirect ('controller=user&action=edit&cid='.$data["id"]);
	}

	if (isset($_POST["btnSaveClose"])) {
		setFlash ("success" , "Đã sửa User");
		redirect ('controller=user');
	}
}
function checkUserHavePost ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM news_post WHERE user_id = :user_id");
	$stmt->bindParam(":user_id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->rowCount();
	return $row;
}

function delete_user ($conn,$id) {
	$data = dataEdit ($conn,$id);
	$checkHavePost=checkUserHavePost ($conn,$id);
	if (($id == 1) || ($_SESSION["login"]["user_id"] != 1 && $data["level"] == 3)) {
		setFlash ("error" , "Bạn không đủ quyền xóa thành viên này");
		redirect ('controller=user');
	} else if ($checkHavePost > 0) {
		setFlash ("error" , "Bạn cần xóa hết bài viết của User này trước khi xóa nó");
		redirect ('controller=user');
	} else {
	$stmt = $conn->prepare("DELETE FROM `news_user` WHERE `id` = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	setFlash("success","Đã xóa User");
	redirect('controller=user');
	}
}

?>