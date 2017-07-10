<?php 
ob_start();
session_start();
include 'configuration.php';
include 'vendor/database.php';
include 'vendor/functions.php';
include 'models/model.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Mỹ Phâm Hoa Thiên Thảo</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="public/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="public/assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="public/assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="public/assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
<!--[if lt IE 9]>
<script src="assets/js/html5shiv.min.js"></script>
<script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <?php include('resources/blocks/header.php') ?>
  <?php include('resources/blocks/nav.php') ?>
  <div id="content">
	<?php 
	if (isset($_GET["page"])) {
		$page = $_GET["page"];
		switch ($page) {
			case 'home':
				include 'resources/views/home.php';
				break;
			case 'category':
				include 'resources/views/category.php';
				break;
			case 'detail':
				include 'resources/views/detail.php';
				break;
			case 'contact':
				include 'resources/views/contact.php';
				break;
			case 'about':
				include 'resources/views/about.php';
				break;	
			default:
				include 'resources/views/home.php';
			break;
		}
	} else {
		include 'resources/views/home.php';
	}
	?>
  </div>
  
</div>
<?php include('resources/blocks/footer.php') ?>
<script src="public/assets/js/jquery.min.js"></script> 
<script src="public/assets/js/bootstrap.min.js"></script> 
<script src="public/assets/js/wow.min.js"></script> 
<script src="public/assets/js/slick.min.js"></script> 
<script src="public/assets/js/custom.js"></script>
</body>
</html>