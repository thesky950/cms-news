<div class="row" style="margin-bottom: 10px">
	<div class="col-xs-4">
		<a href="index.php?controller=post" class="btn bg-warning-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-book"></i> <span>Post Manage</span></a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?controller=category" class="btn bg-teal-400 btn-block btn-float btn-float-lg" type="button"><i class="icon-stack2"></i> <span>Category Manage</span></a>
	</div>
	<div class="col-xs-4">
		<a href="index.php?controller=user" class="btn bg-blue btn-block btn-float btn-float-lg" type="button"><i class="icon-people"></i> <span>Users Manage</span></a>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h6 class="panel-title">Latest posts<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
		<div class="heading-elements">
			<ul class="icons-list">
        		<li><a data-action="collapse"></a></li>
        		<li><a data-action="reload"></a></li>
        		<li><a data-action="close"></a></li>
        	</ul>
    	</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="col-lg-4">
				<ul class="media-list content-group">
					<?php 
					$data=listDashboard_1 ($conn);
					foreach($data as $value) {
					?>
					<li class="media stack-media-on-mobile">
    					<div class="media-left">
							<div class="thumb">
								<a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>" data-toggle="modal">
									<img src="<?php echo $value["image"] ?>" class="img-responsive img-rounded media-preview" alt="">
									
								</a>
							</div>
						</div>

    					<div class="media-body">
							<h6 class="media-heading"><a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>"><?php echo $value["name"] ?></a></h6>
                    		<ul class="list-inline list-inline-separate text-muted mb-5">
                    			<li> <?php echo $value["author"] ?></li>
                    			<li><?php echo time_elapsed_string($value["created_at"]) ?></li>
                    		</ul>
							
						</div>
					</li>
					<?php } ?>
					
				</ul>
			</div>
			<div class="col-lg-4">
				<ul class="media-list content-group">
					<?php 
					$data=listDashboard_2 ($conn);
					foreach($data as $value) {
					?>
					<li class="media stack-media-on-mobile">
    					<div class="media-left">
							<div class="thumb">
								<a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>" data-toggle="modal">
									<img src="<?php echo $value["image"] ?>" class="img-responsive img-rounded media-preview" alt="">
									
								</a>
							</div>
						</div>

    					<div class="media-body">
							<h6 class="media-heading"><a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>"><?php echo $value["name"] ?></a></h6>
                    		<ul class="list-inline list-inline-separate text-muted mb-5">
                    			<li> <?php echo $value["author"] ?></li>
                    			<li><?php echo time_elapsed_string($value["created_at"]) ?></li>
                    		</ul>
							
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="col-lg-4">
				<ul class="media-list content-group">
					<?php 
					$data=listDashboard_3 ($conn);
					foreach($data as $value) {
					?>
					<li class="media stack-media-on-mobile">
    					<div class="media-left">
							<div class="thumb">
								<a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>" data-toggle="modal">
									<img src="<?php echo $value["image"] ?>" class="img-responsive img-rounded media-preview" alt="">
									
								</a>
							</div>
						</div>

    					<div class="media-body">
							<h6 class="media-heading"><a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>"><?php echo $value["name"] ?></a></h6>
                    		<ul class="list-inline list-inline-separate text-muted mb-5">
                    			<li> <?php echo $value["author"] ?></li>
                    			<li><?php echo time_elapsed_string($value["created_at"]) ?></li>
                    		</ul>
							
						</div>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>





