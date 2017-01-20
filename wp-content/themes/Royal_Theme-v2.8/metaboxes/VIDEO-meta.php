<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>-->
<style type="text/css">
#radioGroup .wrap {
	display: inline-block;
}
#radioGroup label {
  display: block;
  text-align: center;
  margin: 0 0.2em;
}
#radioGroup input[type="radio"] {
  display: block;
  margin: 0.5em auto;
}
</style>
<div class="my_meta_control metabox">
<?php 
	global $wpalchemy_media_access;
?>
<?php if(get_post_type()=='videos'){ ?>
<!--Section 1 Start-->
	<div class="postbox section-background">
		<button type="button" class="handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">Toggle panel: Page Layout</span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>
		<h2 class="hndle ui-sortable-handle">
			<span>General Options</span>
		</h2>
		<div class="inside">
			<div class="my_meta_control metabox">
				<div class="row">
					<div class="col-sm-12">
						<label>Select Category</label>
						<?php $metabox->the_field('video_category'); ?>
						<?php 
						$video_category = get_terms(array(
							'taxonomy' => 'videos_category',
							'hide_empty' => false,
							'orderby' => 'name',
							'order' => 'asc'
						));
						?>
						<p>
						<select class="col-sm-12" name="<?php $metabox->the_name(); ?>">
							<option value="">---</option>
							<?php foreach($video_category as $category){
								$selected = '';
								if($category->name==$metabox->get_the_value()){
									$selected = 'selected="selected"';
								}
								echo '<option value="'.$category->name.'" '.$selected.'>'.$category->name.'</option>';
							 } ?>
						</select>
						</p>
					</div>
					<div class="col-sm-12">
						<label>Select SubCategory</label>
						<?php $metabox->the_field('video_subcategory'); ?>
						<?php 
						$video_subcategory = get_terms(array(
							'taxonomy' => 'videos_subcategory',
							'hide_empty' => false,
							'orderby' => 'name',
							'order' => 'asc'
						));
						?>
						<p>
						<select class="col-sm-12" name="<?php $metabox->the_name(); ?>">
							<option value="">---</option>
							<?php foreach($video_subcategory as $subcategory){
								$selected = '';
								if($subcategory->name==$metabox->get_the_value()){
									$selected = 'selected="selected"';
								}
								echo '<option value="'.$subcategory->name.'" '.$selected.'>'.$subcategory->name.'</option>';
							 } ?>
						</select>
						</p>
					</div>
					<div class="col-sm-12">
						<label>Keywords</label>
						<?php $metabox->the_field('keywords'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Address 1</label>
						<?php $metabox->the_field('address1'); ?>
						<textarea name="<?php $metabox->the_name(); ?>"><?php $metabox->the_value(); ?></textarea>
					</div>
					<div class="col-sm-12">
						<label>Address 2</label>
						<?php $metabox->the_field('address2'); ?>
						<textarea name="<?php $metabox->the_name(); ?>"><?php $metabox->the_value(); ?></textarea>
					</div>
					<div class="col-sm-12">
						<label>Email</label>
						<?php $metabox->the_field('email'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Country</label>
						<?php $metabox->the_field('country'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>State</label>
						<?php $metabox->the_field('state'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>City</label>
						<?php $metabox->the_field('city'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Pin Code</label>
						<?php $metabox->the_field('pin_code'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Phone</label>
						<?php $metabox->the_field('phone'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Landline</label>
						<?php $metabox->the_field('landline'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Watsapp no</label>
						<?php $metabox->the_field('watsapp_no'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Website</label>
						<?php $metabox->the_field('website'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Caption Line</label>
						<?php $metabox->the_field('caption_line'); ?>
						<textarea name="<?php $metabox->the_name(); ?>"><?php $metabox->the_value(); ?></textarea>
					</div>
					<div class="col-sm-12">
						<label>Promotional Code</label>
						<?php $metabox->the_field('promotional_code'); ?>
						<p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
					</div>
					<div class="col-sm-12">
						<label>Upload Video</label>
						<?php $metabox->the_field('video_upload'); ?>
						<?php $wpalchemy_media_access->setGroupName('section_video_link' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
						<p class="media-input">
							<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
							<?php echo $wpalchemy_media_access->getButton(); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--Section 1 End-->
<?php } ?>


<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('#postdivrich').css('display', 'none');
	});
</script>

