<div class="my_meta_control">
	<?php while($mb->have_fields_and_multi('cb_ex4')): ?>
	<?php $mb->the_group_open(); ?>

		<a href="#" class="dodelete button" style="float:right;">Remove</a>

		<?php $mb->the_field('cb_ex4_name'); ?>
		<input type="file" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>"/>

	<?php $mb->the_group_close(); ?>
	<?php endwhile; ?>

	<p><a href="#" class="docopy-cb_ex4 button">Add</a></p>

	<input type="submit" class="button-primary" name="save" value="Save">

</div>