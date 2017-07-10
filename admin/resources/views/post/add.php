<?php 
$error = array();
if ((isset($_POST["btnSaveNew"]) || isset($_POST["btnSaveClose"])) && token()) {
	if (checkEmpty($_POST["txtNameVi"])) {
		$error[] = "Vui lòng nhập post name ";
	} 
	if (checkEmpty($_POST["txtSlugVi"])) {
		$error[] = "Vui lòng nhập slug ";
	}	
	if (checkEmpty($_POST["txtOpenContentVi"])) {
		$error[] = "Vui lòng nhập content ";
	}
	if (empty($_POST["chkCategory"])) {
		$error[] = "Vui lòng chọn category";
	}		
	if (empty($error)) {
		$data = array(
				'name'            => emptyToNull($_POST["txtNameVi"]),
				'slug'            => emptyToNull($_POST["txtSlugVi"]),
				'content'         => emptyToNull($_POST["txtOpenContentVi"]),
				'title_tag'       => emptyToNull($_POST["txtTitleTagVi"]),
				'keywords_tag'    => emptyToNull($_POST["txtKeywordsVi"]),
				'description_tag' => emptyToNull($_POST["txtMetaDescriptionVi"]),
				'access'          => $_POST["sltAccess"],
				'author'          => emptyToNull($_POST["txtAuthor"]),
				'tag'      		  => $_POST["txtTags"],
				'robot_tag'       => $_POST["sltMetaRobot"],
				'image'           => emptyToNull($_POST["txtImage"]),
				'alt'             => emptyToNull($_POST["txtAlt"]),
				'status'   		  => (isset($_POST["chkStatus"])) ? "On" : "Off",
				'user_id'         => $_SESSION["login"]["user_id"],
				'created_at'      => time(),
				'category'        => $_POST["chkCategory"]
			);
		add ($conn,$data,$error);
	}
}
?>
<form action="" method="POST" accept-charset="utf-8">
<?php form_token () ?>
	<div class="col-md-12">
		<div class="panel panel-body border-top-primary text-left">
			<button type="submit" name="btnSaveNew" value="btnSaveNew" class="btn btn-success btn-labeled"><b><i class="icon-add"></i></b> Save & New</button>
			<button type="submit" name="btnSaveClose" value="btnSaveClose" class="btn btn-default btn-labeled"><b><i class="icon-add-to-list"></i></b> Save & Close</button>
			<a href="index.php?controller=post" class="btn btn-danger btn-labeled"><b><i class="icon-close2"></i></b> Close</a>
		</div>
	</div>
	<div class="col-md-12">
		<?php include 'resources/blocks/error.php'; ?>
		<?php include 'resources/blocks/success.php'; ?>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h6 class="panel-title">Add Post</h6>
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
								<label class="control-label">Post Title * </label>
								<input type="text" id="name-slug-vi" name="txtNameVi" class="form-control" placeholder="Please Enter Post Name" <?php issetInput ('txtNameVi') ?>/>
							</div>
							<div class="form-group">
								<label class="control-label">Slug URL *</label>
								<input type="text" id="txtSlugVi" name="txtSlugVi" class="form-control" placeholder="Please Enter Slug URL" <?php issetInput ('txtSlugVi') ?>/>
							</div>
							<div class="form-group">
								<label class="control-label">Post Content *</label>
								<textarea name="txtOpenContentVi"><?php issetTextarea('txtOpenContentVi'); ?></textarea>
								<script type="text/javascript">
									 CKEDITOR.replace('txtOpenContentVi', {
									 	height: '200px',
									 	extraPlugins: 'forms',
									 	filebrowserBrowseUrl: 'public/js/ckfinder/ckfinder.html',
									 	filebrowserUploadUrl: 'public/js/ckfinder/connector?command=QuickUpload&type=Files'
									 });
								</script>
							</div>
							
							<div class="form-group" style="margin-bottom: 50px">
								<label class="control-label">SEO Title</label>
								<input type="text" id="txtTitleTagVi" name="txtTitleTagVi" class="form-control col-lg-6 maxlength-textarea" maxlength="70" placeholder="Please Enter SEO Title" <?php issetInput ('txtTitleTagVi') ?>/>
							</div>
							<div class="form-group">
								<label class="control-label">Meta Keywords</label>
								<input type="text" name="txtKeywordsVi" class="tags-input" placeholder="Please Enter Keywords" <?php issetInput ('txtKeywordsVi') ?>/>
								<span class="help-block">Keywords not more that 10 words</span>
							</div>
							<div class="form-group">
								<label class="control-label">Meta Description</label>
								<textarea rows="3" name="txtMetaDescriptionVi" cols="3" maxlength="160" class="form-control maxlength-textarea" placeholder="Please Enter Description"><?php issetTextarea('txtMetaDescriptionVi'); ?></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Meta Robot</label>
								<select name="sltMetaRobot" class="form-control">
									<option value="NULL">Trống</option>
									<option value="index, follow" <?php issetSelect ('sltMetaRobot','index, follow') ?>>INDEX, FOLLOW</option>
									<option value="noindex, follow" <?php issetSelect ('sltMetaRobot','noindex, follow') ?>>NOINDEX, FOLLOW</option>
									<option value="index, nofollow" <?php issetSelect ('sltMetaRobot','index, nofollow') ?>>INDEX, NOFOLLOW</option>
									<option value="noindex, nofollow" <?php issetSelect ('sltMetaRobot','noindex, nofollow') ?>>NOINDEX, NOFOLLOW</option>
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
				<h6 class="panel-title">Add Post</h6>
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
					<label class="control-label">Access *</label>
					<select name="sltAccess" class="form-control">
						<option value="0" <?php issetSelect ('sltAccess','0') ?>>Guest</option>
						<option value="1" <?php issetSelect ('sltAccess','1') ?>>Member</option>
						<option value="2" <?php issetSelect ('sltAccess','2') ?>>Member Vip</option>
						<option value="3" <?php issetSelect ('sltAccess','3') ?>>Admin</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label">Author *</label>
					<div class="input-group">
						<span class="input-group-addon"><i class="icon-user"></i></span>
						<input type="text" name="txtAuthor" readonly class="form-control" placeholder="Please Enter Author Name" <?php $author=$_SESSION["login"]["user_firstname"]. " " .$_SESSION["login"]["user_lastname"]; issetInput ('txtAuthor',$author) ?>/>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label"> Category * </label>
					<div class="well" id="scroll-category">
						<?php 
						$data_category = data_category($conn);
						if (isset($_POST["chkCategory"])) {
							recursionList ($data_category,$_POST["chkCategory"]);
						} else {
							recursionList ($data_category);
						} 
						?>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label">Tags</label>
					<input type="text" name="txtTags" class="tags-input" placeholder="Please Enter Tags" <?php issetInput ('txtTags')?>/>
					<span class="help-block">Tags not more that 10 words</span>
				</div>
				
				<div class="form-group">
					<label class="control-label">Main Image</label><br />
					<center>
						<img class="img-responsive" id="main-image" <?php issetInputImage ('txtImage') ?> />
						<input type="hidden" name="txtImage" id="main-image-input" <?php issetInput('txtImage','public/images/upload.png') ?> />
					</center><br />
					<input type="text" name="txtAlt" class="form-control" placeholder="Please Enter Alt For Image" <?php issetInput ('txtAlt') ?>  />
				</div><br />
				
				<div class="checkbox checkbox-switch">
					<label class="control-label">Status *</label><br/> <br/>
					<input type="checkbox" name="chkStatus"  data-on-color="success" data-off-color="danger" data-on-text="On" data-off-text="Off" class="switch" <?php if(isset($_POST["chkStatus"]))echo "checked='checked'"; ?> />
				</div>
				
			</div>
		</div>
	</div>
</form>