<div class="sidebar sidebar-main sidebar-fixed">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user">
			<div class="category-content">
				<div class="media">
					<?php 
					$avatar = "";
					if ($_SESSION["login"]["user_avatar"] == NULL) {
						$avatar = 'public/images/placeholder.jpg';
					} else {
						$avatar = $_SESSION["login"]["user_avatar"];
					}
					?>
					<a href="#" class="media-left"><img src="<?php echo $avatar ?>" class="img-circle img-sm" alt=""></a>
					<div class="media-body">
						<span class="media-heading text-semibold">
							<?php 
							if (isset($_SESSION["login"]["user_firstname"]) && isset($_SESSION["login"]["user_lastname"])) {
								echo $_SESSION["login"]["user_firstname"] . " " . $_SESSION["login"]["user_lastname"];
							}
							?>
						</span>
						<div class="text-size-mini text-muted">
							<i class="icon-pin text-size-small"></i> &nbsp;Việt Nam
						</div>
					</div>

					<div class="media-right media-middle">
						<ul class="icons-list">
							<li>
								<a href="index.php?controller=user&action=edit&cid=<?php echo $_SESSION["login"]["user_id"] ?>"><i class="icon-cog3"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
					<li><a href="index.php"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
					
					<li>
						<a href="#"><i class="icon-book"></i> <span>Post</span></a>
						<ul>
							<li><a href="index.php?controller=post&action=add">Add Post</a></li>
							<li><a href="index.php?controller=post&action=list">List Post</a></li>
						</ul>
					</li>
					<li>
						<a href="#"><i class="icon-stack2"></i> <span>Category</span></a>
						<ul>
							<li><a href="index.php?controller=category&action=add">Add Category</a></li>
							<li><a href="index.php?controller=category&action=list">List Category</a></li>
						</ul>
					</li>

					<li>
						<a href="#"><i class="icon-users"></i> <span>User</span></a>
						<ul>
							<li><a href="index.php?controller=user&action=add">Add User</a></li>
							<li><a href="index.php?controller=user&action=list">List User</a></li>
						</ul>
					</li>
					

				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>