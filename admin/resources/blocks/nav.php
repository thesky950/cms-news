<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-header">
		<a class="navbar-brand" href="index.php">Administrator</a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		<ul class="nav navbar-nav navbar-right">
			

			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<?php 
					$avatar = "";
					if ($_SESSION["login"]["user_avatar"] == NULL) {
						$avatar = 'public/images/placeholder.jpg';
					} else {
						$avatar = $_SESSION["login"]["user_avatar"];
					}
					?>
					<img src="<?php echo $avatar ?>" alt="">
					<span>
						<?php 
						if (isset($_SESSION["login"]["user_firstname"]) && isset($_SESSION["login"]["user_lastname"])) {
							echo "Hello : " . $_SESSION["login"]["user_firstname"] . " " . $_SESSION["login"]["user_lastname"];
						}
						?>
					</span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="index.php?controller=user"><i class="icon-user-plus"></i> List profile</a></li>
					<li class="divider"></li>
					<li><a href="index.php?controller=user&action=edit&cid=<?php echo $_SESSION["login"]["user_id"] ?>"><i class="icon-cog5"></i> Account settings</a></li>
					<li><a href="logout.php"><i class="icon-switch2"></i> Logout</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>