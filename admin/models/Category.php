<?php  
function add ($conn,$data,&$error) {
	$check = $conn->prepare("SELECT `name` FROM `news_category` WHERE `name` = :name ");
	$check->bindParam(":name",$data["name"],PDO::PARAM_STR);
	$check->execute();
	$rowCount = $check->rowCount();
	if ($rowCount == 0) {
		$stmt = $conn->prepare("INSERT INTO `news_category`(`name`, `description`, `slug`, `title_tag`, `keywords_tag`, `description_tag`, `image`, `alt`, `position`, `robot_tag`, `status`, `parent_id`, `created_at`) VALUES (:name,:description,:slug,:title_tag,:keywords_tag,:description_tag,:image,:alt,:position,:robot_tag,:status,:parent_id,:created_at)");
		$stmt->bindParam(":name",$data["name"],PDO::PARAM_STR);
		$stmt->bindParam(":description",$data["description"],PDO::PARAM_STR);
		$stmt->bindParam(":slug",$data["slug"],PDO::PARAM_STR);
		$stmt->bindParam(":title_tag",$data["title_tag"],PDO::PARAM_STR);
		$stmt->bindParam(":keywords_tag",$data["keywords_tag"],PDO::PARAM_STR);
		$stmt->bindParam(":description_tag",$data["description_tag"],PDO::PARAM_STR);
		$stmt->bindParam(":image",$data["image"],PDO::PARAM_STR);
		$stmt->bindParam(":alt",$data["alt"],PDO::PARAM_STR);
		$stmt->bindParam(":position",$data["position"],PDO::PARAM_STR);
		$stmt->bindParam(":robot_tag",$data["robot_tag"],PDO::PARAM_STR);
		$stmt->bindParam(":parent_id",$data["parent_id"],PDO::PARAM_INT);
		$stmt->bindParam(":status",$data["status"], PDO::PARAM_STR);
		$stmt->bindParam(":created_at",$data["created_at"],PDO::PARAM_INT);
		$stmt->execute();

		if (isset($_POST["btnSaveNew"])) {
			setFlash ("success" , "Đã thêm Category");
			redirect ('controller=category&action=add');
		}

		if (isset($_POST["btnSaveClose"])) {
			setFlash ("success" , " Đã thêm Category");
			redirect ('controller=category');
		}
	} else {
		$error[] = "Category đã tồn tại, vui lòng nhập category khác";
	}
}

function data_category ($conn) {
	$stmt = $conn->prepare("SELECT `id`,`name`,`description`,`parent_id`,`position`,`status` FROM `news_category` ORDER BY position ASC");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function category_position ($conn) {
	$stmt = $conn->prepare("SELECT MAX(`position`) as position FROM `news_category` WHERE `parent_id` = 0");
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	$position = $data["position"] + 1;
	return $position;
}

function checkCategoryHavePost ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM news_post_category WHERE category_id = :category_id");
	$stmt->bindParam(":category_id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$row = $stmt->rowCount();
	return $row;
}

function category_delete ($conn,$id) {
	$checkHaveChild = $conn->prepare("SELECT `parent_id` FROM `news_category` WHERE `parent_id` = :parent_id");
	$checkHaveChild->bindParam(":parent_id",$id,PDO::PARAM_INT);
	$checkHaveChild->execute();
	$row = $checkHaveChild->rowCount();
	$checkHavePost = checkCategoryHavePost ($conn,$id);
	if ($row > 0 || $checkHavePost > 0) {
		setFlash ("error" , "Để xóa category này bạn cần xóa hết tất cả các bài viết và chuyên mục con trực thuộc");
		redirect('controller=category');
	} else {
		$stmt = $conn->prepare("DELETE FROM `news_category` WHERE `id` = :id");
		$stmt->bindParam(":id",$id,PDO::PARAM_INT);
		$stmt->execute();
		setFlash ("success" , "Đã xóa Category");
		redirect('controller=category');
	}
	
}

function dataEdit ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM `news_category` WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function edit ($conn,$data) {
	$stmt = $conn->prepare("UPDATE `news_category` SET `name`=:name,`description`=:description,`slug`=:slug,`title_tag`=:title_tag,`keywords_tag`=:keywords_tag,`description_tag`=:description_tag,`image`=:image,`alt`=:alt,`position`=:position,`robot_tag`=:robot_tag,`status`=:status,`parent_id`=:parent_id,`updated_at`=:updated_at WHERE `id` =:id");
	$stmt->bindParam(":id",$data["id"],PDO::PARAM_INT);
	$stmt->bindParam(":name",$data["name"],PDO::PARAM_STR);
	$stmt->bindParam(":description",$data["description"],PDO::PARAM_STR);
	$stmt->bindParam(":slug",$data["slug"],PDO::PARAM_STR);
	$stmt->bindParam(":title_tag",$data["title_tag"],PDO::PARAM_STR);
	$stmt->bindParam(":keywords_tag",$data["keywords_tag"],PDO::PARAM_STR);
	$stmt->bindParam(":description_tag",$data["description_tag"],PDO::PARAM_STR);
	$stmt->bindParam(":image",$data["image"],PDO::PARAM_STR);
	$stmt->bindParam(":alt",$data["alt"],PDO::PARAM_STR);
	$stmt->bindParam(":position",$data["position"],PDO::PARAM_STR);
	$stmt->bindParam(":robot_tag",$data["robot_tag"],PDO::PARAM_STR);
	$stmt->bindParam(":parent_id",$data["parent_id"],PDO::PARAM_INT);
	$stmt->bindParam(":status",$data["status"],PDO::PARAM_STR);
	$stmt->bindParam(":updated_at",$data["updated_at"],PDO::PARAM_INT);
	$stmt->execute();
	
	if (isset($_POST["btnSave"])) {
		setFlash ("success" , "Đã sửa Category");
		redirect ('controller=category&action=edit&cid='.$data["id"]);
	}

	if (isset($_POST["btnSaveClose"])) {
		setFlash ("success" , "Đã sửa Category");
		redirect ('controller=category');
	}
}


?>