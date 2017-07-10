<?php 
function listPost($conn){
	$stmt = $conn->prepare("SELECT `id`, `name`, `author`, `tag`, `status`, `created_at` FROM `news_post` ORDER BY id DESC");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function data_category ($conn) {
	$stmt = $conn->prepare("SELECT `id`,`name`,`parent_id`,`position`,`status` FROM `news_category`");
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);	
}

function data_post_category($conn,$id){
	$stmt = $conn->prepare("SELECT * FROM `news_post_category` WHERE `post_id` = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function add ($conn,$data,&$error) {
	$check = $conn->prepare("SELECT `name` FROM `news_post` WHERE `name` = :name");
	$check->bindParam(":name",$data["name"],PDO::PARAM_STR);
	$check->execute();
	$row = $check->rowCount();
	if ($row == 0) {
		$stmt = $conn->prepare("INSERT INTO `news_post`(`name`, `content`, `slug`, `title_tag`, `keywords_tag`, `description_tag`, `access`, `author`, `tag`, `robot_tag`, `image`, `alt`, `status`, `user_id`, `created_at`) VALUES (:name, :content, :slug, :title_tag, :keywords_tag, :description_tag, :access, :author, :tag, :robot_tag, :image, :alt, :status, :user_id, :created_at)");
		$stmt->bindParam(':name',$data["name"],PDO::PARAM_STR);
		$stmt->bindParam(':content',$data["content"],PDO::PARAM_STR);
		$stmt->bindParam(':slug',$data["slug"],PDO::PARAM_STR);
		$stmt->bindParam(':title_tag',$data["title_tag"],PDO::PARAM_STR);
		$stmt->bindParam(':keywords_tag',$data["keywords_tag"],PDO::PARAM_STR);
		$stmt->bindParam(':description_tag',$data["description_tag"],PDO::PARAM_STR);
		$stmt->bindParam(':access',$data["access"],PDO::PARAM_STR);
		$stmt->bindParam(':author',$data["author"],PDO::PARAM_STR);
		$stmt->bindParam(':tag',$data["tag"],PDO::PARAM_STR);
		$stmt->bindParam(':robot_tag',$data["robot_tag"],PDO::PARAM_STR);
		$stmt->bindParam(':image',$data["image"],PDO::PARAM_STR);
		$stmt->bindParam(':alt',$data["alt"],PDO::PARAM_STR);
		$stmt->bindParam(':status',$data["status"],PDO::PARAM_STR);
		$stmt->bindParam(':user_id',$data["user_id"],PDO::PARAM_INT);
		$stmt->bindParam(':created_at',$data["created_at"],PDO::PARAM_INT);
		$result = $stmt->execute();
		$post_id = $conn->lastInsertId();

		if ($result == 1) {
			foreach ($data["category"] as $value) {
				$stmt_category = $conn->prepare("INSERT INTO `news_post_category`(`post_id`, `category_id`) VALUES (:post_id,:category_id)");
				$stmt_category->bindParam(":post_id",$post_id,PDO::PARAM_INT);
				$stmt_category->bindParam(":category_id",$value,PDO::PARAM_INT);
				$stmt_category->execute();
			}
		}

		if (isset($_POST["btnSaveNew"])) {
			setFlash ("success" , "Đã thêm Post");
			redirect ('controller=post&action=add');
		}

		if (isset($_POST["btnSaveClose"])) {
			setFlash ("success" , "Đã thêm Post");
			redirect ('controller=post');
		}
	} else {
		$error[] = "Tiêu đề bài viết bị trùng, vui lòng nhập tiêu đề khác";
	}
}

function dataEdit ($conn,$id) {
	$stmt = $conn->prepare("SELECT * FROM `news_post` WHERE id = :id");
	$stmt->bindParam(":id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function edit ($conn,$data) {
	$stmt = $conn->prepare("UPDATE `news_post` SET `name`=:name,`content`=:content,`slug`=:slug,`title_tag`=:title_tag,`keywords_tag`=:keywords_tag,`description_tag`=:description_tag, `access`=:access,`author`=:author,`robot_tag`=:robot_tag, `tag`=:tag,`image`=:image,`alt`=:alt,`status`=:status,`user_id`=:user_id,`updated_at`=:updated_at WHERE `id` =:id");
	$stmt->bindParam(':id',$data["id"],PDO::PARAM_INT);
	$stmt->bindParam(':name',$data["name"],PDO::PARAM_STR);
	$stmt->bindParam(':content',$data["content"],PDO::PARAM_STR);
	$stmt->bindParam(':slug',$data["slug"],PDO::PARAM_STR);
	$stmt->bindParam(':title_tag',$data["title_tag"],PDO::PARAM_STR);
	$stmt->bindParam(':keywords_tag',$data["keywords_tag"],PDO::PARAM_STR);
	$stmt->bindParam(':description_tag',$data["description_tag"],PDO::PARAM_STR);
	$stmt->bindParam(':author',$data["author"],PDO::PARAM_STR);
	$stmt->bindParam(':access',$data["access"],PDO::PARAM_INT);
	$stmt->bindParam(':robot_tag',$data["robot_tag"],PDO::PARAM_STR);
	$stmt->bindParam(':tag',$data["tag"],PDO::PARAM_STR);
	$stmt->bindParam(':image',$data["image"],PDO::PARAM_STR);
	$stmt->bindParam(':alt',$data["alt"],PDO::PARAM_STR);
	$stmt->bindParam(':status',$data["status"],PDO::PARAM_STR);
	$stmt->bindParam(':user_id',$data["user_id"],PDO::PARAM_INT);
	$stmt->bindParam(':updated_at',$data["updated_at"],PDO::PARAM_INT);
	$stmt->execute();

	$stmt_delete = $conn->prepare("DELETE FROM `news_post_category` WHERE `post_id` = :post_id");
	$stmt_delete->bindParam(":post_id",$data["id"],PDO::PARAM_INT);
	$result = $stmt_delete->execute();

	if ($result == 1) {
		foreach ($data["category"] as $value) {
			$stmt_category = $conn->prepare("INSERT INTO `news_post_category`(`post_id`, `category_id`) VALUES (:post_id,:category_id)");
			$stmt_category->bindParam(":post_id",$data["id"],PDO::PARAM_INT);
			$stmt_category->bindParam(":category_id",$value,PDO::PARAM_INT);
			$stmt_category->execute();
		}
	}

	if (isset($_POST["btnSave"])) {
		setFlash ("success" , "Đã sửa Post");
		redirect ('controller=post&action=edit&cid='.$data["id"]);
	}

	if (isset($_POST["btnSaveClose"])) {
		setFlash ("success" , "Đã sửa Post");
		redirect ('controller=post');
	}
}

function post_delete ($conn,$id) {
		$stmt = $conn->prepare("DELETE FROM `news_post` WHERE `id` = :id");
		$stmt->bindParam(":id",$id,PDO::PARAM_INT);
		if($stmt->execute()){
			$delete = $conn->prepare("DELETE FROM `news_post_category` WHERE `post_id` = :id");
			$delete->bindParam(":id",$id,PDO::PARAM_INT);
			$delete->execute();
			setFlash ("success" , "Đã xóa Post");
			redirect("controller=post");
		}
}

function post_category_list ($conn,$id) {
	$stmt_all = $conn->prepare("SELECT * FROM news_category");
	$stmt_all->execute();
	$data_all = $stmt_all->fetchAll(PDO::FETCH_ASSOC);

	$stmt = $conn->prepare("SELECT child.id,child.name,child.parent_id FROM news_category AS child LEFT JOIN news_category AS no_child ON no_child.parent_id = child.id WHERE no_child.id is NULL AND child.id IN (SELECT `category_id` FROM `news_post_category` WHERE `post_id` = :post_id)");
	$stmt->bindParam(":post_id",$id,PDO::PARAM_INT);
	$stmt->execute();
	$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($data as $key => $value) {
		$array = array();
		recursion_reverse($data_all,$value["id"],$array);
		$count = 0;
		foreach (reverse_array_key($array) as $k => $v) {
			$count = $count + 1;
			if (count($array) == $count) {
				echo "<span>".$v."</span>";
			} else {
				echo "<span>".$v."</span>". " " . ">" . " ";
			}
		}
		echo "<br />";
	}
}

function recursion_reverse ($data,$ids,&$array = array()) {
	foreach ($data as $key => $value) {
		$id        = $value["id"];
		$name   = $value["name"];
		$parent_id = $value["parent_id"];
		if ($id == $ids) {
			$array[$id] = $name;
			unset($data[$key]);
			recursion_reverse ($data,$parent_id,$array);
		}
	}	
}
?>