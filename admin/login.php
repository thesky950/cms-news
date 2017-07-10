<?php
session_start();
ob_start();
include '../vendor/functions.php';

if (isset($_SESSION["login"]["user_level"]) && $_SESSION["login"]["user_level"] == 3) {
	redirect();
}
$error = array();
if (isset($_POST["btnLogin"]) && token()) {
	if (filter_var($_POST["txtEmail"], FILTER_VALIDATE_EMAIL) === false) {
		$error[] = "Email không hợp lệ, hãy kiểm tra lại";
	}
	if ($_POST["txtLock"] != "mphtt") {
		$error[] = "Sai mã Lock, hãy kiểm tra lại";
	}
	if (empty($error)) {
		include '../configuration.php';
		include '../vendor/database.php';
		include 'models/Login.php';
		$data = array(
				'email'    => cleanString($_POST["txtEmail"]),
				'password' => $_POST["txtEmail"]."@-*$".$_POST["txtPass"],
				'status'   => 'On',
				'level'    => 3	
			);
		login ($conn,$data,$error);
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="public/images/favicon.ico" type="image/x-icon">
	<title>Login</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="public/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="public/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="public/css/core.css" rel="stylesheet" type="text/css">
	<link href="public/css/components.css" rel="stylesheet" type="text/css">
	<link href="public/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="public/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="public/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="public/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="public/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="public/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="public/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="public/js/core/app.js"></script>
	<script type="text/javascript" src="public/js/pages/login_validation.js"></script>
	<!-- /theme JS files -->

</head>

<body class="login-container login-cover">

	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content pb-20">

					<!-- Form with validation -->
					<form action="" method="POST" class="form-validate">
					<?php form_token () ?>
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Login to your account <small class="display-block">Mỹ phẩm Hoa Thiên Thảo</small></h5>
							</div>
							<?php include 'resources/blocks/error.php'; ?>
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" class="form-control" placeholder="Email" name="txtEmail" required="required">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" name="txtPass" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Lock" name="txtLock" required="required">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" name="btnLogin" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
							</div>

						</div>
					</form>
					<!-- /form with validation -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
