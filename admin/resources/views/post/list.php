<div class="col-md-12">
	<?php include 'resources/blocks/error.php'; ?>
	<?php include 'resources/blocks/error-flash.php'; ?>
	<?php include 'resources/blocks/success.php'; ?>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="panel-title">List Post</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>
		<table class="table table-bordered table-hover datatable-highlight">
			<thead>
				<tr>
					<th width="10px">STT</th>
					<th>Post Name</th>
					<th>Author</th>
					<th>Category</th>
					<th>Tags</th>
					<th>Status</th>
					<th>Date</th>
					<th class="text-center" width="70px">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$data = listPost($conn);
				$stt = 0;
				foreach ($data as $value) {
					$stt++;
				?>
				<tr>
					<td><?php echo $stt ?></td>
					<td><span style='color: blue'><?php echo $value["name"] ?></span></td>
					<td><?php echo $value["author"] ?></td>
					<td>
						<?php post_category_list ($conn,$value["id"]); ?>
					</td>
					<td><?php echo $value["tag"] ?></td>
					<td><input type="checkbox" name="chkStatus"  data-on-color="success" data-off-color="danger" data-on-text="On" data-off-text="Off" class="switch"  data-table="news_post" data-col="status" data-id="<?php echo $value["id"] ?>" <?php echo ($value["status"] == "On") ? "checked='checked'" : "" ?>/></td>
					<td><?php echo time_elapsed_string($value["created_at"]) ?></td>
					<td class="text-center">
						<ul class="icons-list">
							<li class="text-primary-600"><a href="index.php?controller=post&action=edit&cid=<?php echo $value["id"] ?>" data-popup="tooltip" title="Edit"><i class="icon-pencil7"></i></a></li>
							<li class="text-danger-600"><a href="index.php?controller=post&action=delete&cid=<?php echo $value["id"] ?>" data-popup="tooltip" title="Remove" class="sweet_warning"><i class="icon-trash"></i></a></li>
						</ul>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>