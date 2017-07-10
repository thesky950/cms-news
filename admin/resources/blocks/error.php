<?php if (!empty($error)) { ?>
<div class="alert alert-danger alert-styled-left alert-bordered">
	<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
	<ul>
		<?php foreach ($error as $item) { ?>
		<li><?php echo $item; ?></li> 
		<?php } ?>
	</ul>
</div>
<?php } ?>