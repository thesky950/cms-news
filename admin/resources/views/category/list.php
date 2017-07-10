<div class="col-md-12">
	<?php include 'resources/blocks/error.php'; ?>
	<?php include 'resources/blocks/error-flash.php'; ?>
	<?php include 'resources/blocks/success.php'; ?>
</div>
<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h5 class="panel-title">List Category</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>
		<table class="table table-bordered table-hover">
			<thead>
				<tr>
					<th width="150px">Position</th>
					<th>Category Name</th>
					<th width="300px">Description</th>
					<th width="50px">Status</th>
					<th class="text-center" width="70px">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$data = data_category ($conn);
					recursionTable ($data);
				?>
			</tbody>
		</table>
	</div>
</div>