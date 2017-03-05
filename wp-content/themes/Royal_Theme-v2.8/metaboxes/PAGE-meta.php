<div class="my_meta_control metabox">
<?php 
	global $content_page_meta;
?>
<?php if(get_the_ID()=='22879'){ ?>
	<div class="postbox section-background">
		<button type="button" class="handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">Toggle panel: Page Layout</span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>
		<h2 class="hndle ui-sortable-handle">
			<span>Column Section</span>
		</h2>
		<div class="inside">
			<div class="my_meta_control metabox parent-link-type">
				
				<label>Section Title</label>
			    <?php $metabox->the_field('section_title'); ?>
			    <p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
				
				<label>Section Description</label>
			    <?php $metabox->the_field('section_description'); ?>
			    <p><textarea name="<?php $metabox->the_name(); ?>"><?php $metabox->the_value(); ?></textarea></p>
				
				<?php while($metabox->have_fields_and_multi('reference_callout')): ?>
					<?php $metabox->the_group_open(); ?>
				<!--Section 2 call out start 2-->
			    <div class="postbox">
					<button type="button" class="handlediv button-link" aria-expanded="true">
						<span class="screen-reader-text">Toggle panel: Page Layout</span>
						<span class="toggle-indicator" aria-hidden="true"></span>
					</button>
					<a href="javascript:void(0);" class="dodelete"></a>
					<h2 class="hndle ui-sortable-handle">
						<span>Column</span>
					</h2>
					<div class="inside">
						<div class="my_meta_control metabox">
							<div class="row">
								<div class="col-sm-12">
									<label>Image</label>
									<?php $metabox->the_field('section_image'); ?>
									<?php $wpalchemy_media_access->setGroupName('section_image' . $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
									<p class="media-input">
										<?php echo $wpalchemy_media_access->getField(array('name' => $mb->get_the_name(), 'value' => $mb->get_the_value())); ?>
										<?php echo $wpalchemy_media_access->getButton(); ?>
									</p>
				
								</div>
								<div class="col-sm-12">
									<label>Title</label>
								    <?php $metabox->the_field('link_text'); ?>
								    <p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
								</div>
								<div class="col-sm-12">
									<label>Description</label>
									<?php $metabox->the_field('description'); ?>
									<textarea name="<?php $metabox->the_name(); ?>"><?php $metabox->the_value(); ?></textarea>
								</div>
								<!-- <div class="col-sm-1"><label> &nbsp;</label><p><a href="javascript:void(0);" class="dodelete no-after button button-primary">Delete</a></p></div> -->
							</div>
						</div>
					</div>
				</div>
				<!--./Section 2 callout end 2-->
					<?php $metabox->the_group_close(); ?>
				<?php endwhile; ?>
				<p><a href="javascript:void(0);" class="docopy-reference_callout button button-primary"><i class="fa fa-plus"></i> Add More</a></p>
				
				
				
				
				
				
				
				
				
				
				
				
			</div>
		</div>
	</div>

	<div class="postbox section-background">
		<button type="button" class="handlediv button-link" aria-expanded="true">
			<span class="screen-reader-text">Toggle panel: Page Layout</span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>
		<h2 class="hndle ui-sortable-handle">
			<span>Video Section</span>
		</h2>
		<div class="inside">
			<div class="my_meta_control metabox parent-link-type">
				
				<label>Title</label>
			    <?php $metabox->the_field('video_section_title'); ?>
			    <p><input type="text" name="<?php $metabox->the_name(); ?>" value="<?php $metabox->the_value(); ?>"/></p>
				
				<label>Description</label>
			    <?php $metabox->the_field('video_section_description'); ?>
			    <p><textarea name="<?php $metabox->the_name(); ?>"><?php $metabox->the_value(); ?></textarea></p>
			</div>
		</div>
	</div>
<?php } ?>


<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('#postdivrich').css('display', 'none');
	});
</script>
</div>
