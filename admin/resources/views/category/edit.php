<?php 
if (isset($_GET["cid"])) {
	$id = $_GET["cid"];
	checkId ($id,"controller=category");
	$data = dataEdit ($conn,$id);
	if ((isset($_POST["btnSave"]) || isset($_POST["btnSaveClose"])) && token()) {
		if (checkEmpty($_POST["txtNameVi"])) {
			$name=$data['name'];
		} else{
			$name=emptyToNull($_POST["txtNameVi"]);
		}
		if (checkEmpty($_POST["txtSlugVi"])) {
			$slug=$data['slug'];
		} else {
			$slug=emptyToNull($_POST["txtSlugVi"]);
		}
		if (checkEmpty($_POST["txtPosition"])) {
			$position=$data['position'];
		} else {
			$position=$_POST["txtPosition"];
		}
		if (isset($_POST["sltParent"])) {
			$parent_id = $_POST["sltParent"];
		} else {
			$parent_id = $data["parent_id"];
		}		
			$data = array(
					'id'   			  => $id,
					'name'            => $name,
					'description'     => emptyToNull($_POST["txtDescriptionVi"]),
					'slug'            => $slug,
					'title_tag'       => emptyToNull($_POST["txtTitleTagVi"]),
					'keywords_tag'    => emptyToNull($_POST["txtKeywordsVi"]),
					'description_tag' => emptyToNull($_POST["txtMetaDescriptionVi"]),
					'image'           => emptyToNull($_POST["txtImage"]),
					'alt'             => emptyToNull($_POST["txtAlt"]),
					'position'        => $position,
					'robot_tag'       => $_POST["sltMetaRobot"],
					'parent_id'       => $parent_id,
					'status'   		  => (isset($_POST["chkStatus"])) ? "On" : "Off",
					'updated_at'      => time()
				);
			edit ($conn,$data);
	}
} else {
	redirect("controller=category");
}
?>
<form action="" method="POST" accept-charset="utf-8">
<?php form_token () ?>
	<div class="col-md-12">
		<div class="panel panel-body border-top-primary text-left">
			<button type="submit" name="btnSave" value="btnSave" class="btn btn-success btn-labeled"><b><i class="icon-add"></i></b> Save</button>
			<button type="submit" name="btnSaveClose" value="btnSaveClose" class="btn btn-default btn-labeled"><b><i class="icon-add-to-list"></i></b> Save & Close</button>
			<a href="index.php?controller=category" class="btn btn-danger btn-labeled"><b><i class="icon-close2"></i></b>Close</a>
		</div>
	</div>
	<div class="col-md-12">
		<?php include 'resources/blocks/error.php'; ?>
		<?php include 'resources/blocks/success.php'; ?>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Edit Category</h6>
				<div class="heading-elements">
					<ul class="icons-list">
	            		<li><a data-action="collapse" class=""></a></li>
	            		<li><a data-action="reload"></a></li>
	            		<li><a data-action="close"></a></li>
	            	</ul>
	        	</div>
			</div>

			<div class="panel-body" style="display: block;">
				<div class="tabbable tab-content-bordered">
					<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
						<li class="active"><a href="#vietnamese" data-toggle="tab" aria-expanded="true">Vietnamese</a></li>
					
					</ul>

					<div class="tab-content">
						<div class="tab-pane has-padding active" id="vietnamese">
							<div class="form-group">
								<label class="control-label">Category Name *</label>
								<input type="text" id="name-slug-vi" name="txtNameVi" class="form-control" placeholder="Please Enter Category Name" <?php issetInput ('txtNameVi',$data["name"]) ?>/>
							</div>
							<div class="form-group">
								<label class="control-label">Slug URL * </label>
								<input type="text" id="txtSlugVi" name="txtSlugVi" class="form-control" placeholder="Please Enter Slug URL" <?php issetInput ('txtSlugVi',$data["slug"]) ?>/>
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea rows="6" name="txtDescriptionVi" cols="3" maxlength="1000" class="form-control maxlength-textarea" placeholder="Please Enter Description"><?php issetTextarea('txtDescriptionVi',$data["description"]); ?></textarea>
							</div>
							
							<div class="form-group" style="margin-bottom: 50px">
								<label class="control-label">SEO Title</label>
								<input type="text" id="txtTitleTagVi" name="txtTitleTagVi" class="form-control col-lg-6 maxlength-textarea" maxlength="70" placeholder="Please Enter SEO Title" <?php issetInput ('txtTitleTagVi',$data["title_tag"]) ?>/>
							</div>
							<div class="form-group">
								<label class="control-label">Meta Keywords</label>
								<input type="text" name="txtKeywordsVi" class="tags-input" placeholder="Please Enter Keywords" <?php issetInput ('txtKeywordsVi',$data["keywords_tag"]) ?>/>
								<span class="help-block">Keywords not more that 10 words</span>
							</div>
							<div class="form-group">
								<label class="control-label">Meta Description</label>
								<textarea rows="3" name="txtMetaDescriptionVi" cols="3" maxlength="160" class="form-control maxlength-textarea" placeholder="Please Enter Meta Description"><?php issetTextarea('txtMetaDescriptionVi',$data["description_tag"]); ?></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Meta Robot</label>
								<select name="sltMetaRobot" class="form-control">
									<option value="">Trống</option>
									<option value="index, follow" <?php issetSelect ('sltMetaRobot','index, follow',$data["robot_tag"]) ?>>INDEX, FOLLOW</option>
									<option value="noindex, follow" <?php issetSelect ('sltMetaRobot','noindex, follow',$data["robot_tag"]) ?>>NOINDEX, FOLLOW</option>
									<option value="index, nofollow" <?php issetSelect ('sltMetaRobot','index, nofollow',$data["robot_tag"]) ?>>INDEX, NOFOLLOW</option>
									<option value="noindex, nofollow" <?php issetSelect ('sltMetaRobot','noindex, nofollow',$data["robot_tag"]) ?>>NOINDEX, NOFOLLOW</option>
								</select>
							</div>
						</div>

				
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Edit Category</h6>
				<div class="heading-elements">
					<ul class="icons-list">
	            		<li><a data-action="collapse" class=""></a></li>
	            		<li><a data-action="reload"></a></li>
	            		<li><a data-action="close"></a></li>
	            	</ul>
	        	</div>
			</div>

			<div class="panel-body" style="display: block;">
				<div class="form-group">
					<label class="control-label">Category Parent *</label>
					<select name="sltParent" class="form-control">
						<option value="0">Trống</option>
						<?php 
						$data_category = data_category($conn);
						if (isset($_POST["sltParent"])) {
							recursionSelect ($data_category,$_POST["sltParent"]);
						} else {
							recursionSelect ($data_category,$data["parent_id"]);
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Category Position * </label>
					<input type="text" name="txtPosition"  class="touchspin-basic" placeholder="Please Enter Position"<?php issetInput('txtPosition',$data["position"]) ?> />
				</div>
				
				
				<div class="form-group">
					<label class="control-label">Main Image</label><br />
					<center>
						<img class="img-responsive" id="main-image" <?php issetInputImage ('txtImage',$data["image"]) ?> />
						<input type="hidden" name="txtImage" id="main-image-input" <?php issetInput('txtImage',$data["image"],'value') ?> />
					</center><br />
					<input type="text" name="txtAlt" class="form-control" placeholder="Please Enter Alt For Image" <?php issetInput ('txtAlt',$data["alt"]) ?>  />
				</div><br />
				<div class="checkbox checkbox-switch">
					<label class="control-label">Status *</label><br/> <br/>
					<input type="checkbox" name="chkStatus"  data-on-color="success" data-off-color="danger" data-on-text="On" data-off-text="Off" class="switch" <?php echo ($data["status"] == "On") ? "checked='checked'" : "" ?> />
				</div>
			</div>
		</div>
	</div>
</form>