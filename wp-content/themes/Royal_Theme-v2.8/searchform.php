<?php
/**
 * The template for displaying search forms 
 *
 */
?>

<form action="<?php echo home_url( '/' ); ?>" id="searchform" class="hide-input" method="get"> 
	<div class="form-horizontal modal-form">
		<div class="form-group has-border">
			<label>Category : </label>
			<div class="col-xs-10">
				<?php 
					$post_type = 'videos';
					$categorytax = 'videos_category';
					$tax_categoryterms = get_terms($categorytax);
				?>
				<select name="ctgry" id="ctgry">
					<option>Select</option>
					<?php foreach($tax_categoryterms as $catgry){?>
					<option value="<?php echo $catgry->name;?>"><?php echo $catgry->name;?></option>
					<?php } ?>
				</select>
				<!-- <input type="text" name="ctgry" id="ctgry" class="form-control" placeholder="<?php //esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" /> -->
			</div>
		</div>
		<div class="form-group has-border">
			<label>Sub Category : </label>
			<div class="col-xs-10">
				<?php 
					$post_type = 'videos';
					$scategorytax = 'videos_subcategory';
					$tax_subcategoryterms = get_terms($scategorytax);
				?>
				<select name="sctgry" id="sctgry">
					<option>Select</option>
					<?php foreach($tax_subcategoryterms as $scatgry){?>
					<option value="<?php echo $scatgry->name;?>"><?php echo $scatgry->name;?></option>
					<?php } ?>
				</select>
				<!-- <input type="text" name="sctgry" id="sctgry" class="form-control" placeholder="<?php //esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" /> -->
			</div>
		</div>
		<div class="form-group has-border">
			<label>Country : </label>
			<div class="col-xs-10">
				<input type="text" name="cntry" id="cntry" class="form-control" placeholder="<?php esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" />
			</div>
		</div>
		<div class="form-group has-border">
			<label>State : </label>
			<div class="col-xs-10">
				<input type="text" name="stat" id="stat" class="form-control" placeholder="<?php esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" />
			</div>
		</div>
		<div class="form-group has-border">
			<label>City : </label>
			<div class="col-xs-10">
				<input type="text" name="cty" id="cty" class="form-control" placeholder="<?php esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" />
			</div>
		</div>
		<div class="form-group has-border">
			<label>Pincode : </label>
			<div class="col-xs-10">
				<input type="text" name="pncde" id="pncde" class="form-control" placeholder="<?php esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" />
			</div>
		</div>
		<div class="form-group has-border">
			<label>Keywords : </label>
			<div class="col-xs-10">
				<input type="text" name="kywrds" id="kywrds" class="form-control" placeholder="<?php esc_attr_e( 'Search...', ETHEME_DOMAIN ); ?>" />
			</div>
		</div>

		<input type="hidden" name="post_type" value="videos" />
		<div class="form-group form-button">
			<button type="submit" class="btn medium-btn btn-black"><?php esc_attr_e( 'Search', ETHEME_DOMAIN ); ?></button>
		</div>
	</div>
</form>