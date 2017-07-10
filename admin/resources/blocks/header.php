<?php 
if(isset($_GET["controller"])){
	$controller=$_GET["controller"];
	if($controller == "user"){
		$breadcrumb="User";
	} else if ($controller == "category"){
		$breadcrumb="Category";
	} else if ($controller == "post"){
		$breadcrumb="Post";
	} else {
		$breadcrumb="Dashboard";
	}
	
} else {
	$breadcrumb="Dashboard";
}
if(isset($_GET["action"])){
	$action=$_GET["action"];
} else {
	$action="";
}
?>
<div class="page-header page-header-default">
	<div class="page-header-content">
		<div class="page-title">
			<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - <?php echo $breadcrumb ?></h4>
		</div>
	</div>

	<div class="breadcrumb-line">
		<ul class="breadcrumb">
			<li><a href="index.php"><i class="icon-home2 position-left"></i> Home</a></li>
			<li class="active"><?php echo $breadcrumb ?></li>
			<li class="active"><?php echo $action ?></li>
		</ul>
	</div>
</div>