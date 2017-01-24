jQuery(document).ready(function(){

	jQuery('#select_all_state').click(function() {
		jQuery('#select_md option').attr('selected', true);
	});


	jQuery('#unselect_all_state').click(function() {
	    jQuery('#select_md option').attr('selected', false);
	});
});
