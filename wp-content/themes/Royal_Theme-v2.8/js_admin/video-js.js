jQuery(document).ready(function(){
	"use strict";
	
	jQuery("#the-list tr .renew a").click(function(){
		
		jQuery('#modal-renew').modal('show');
	});
	jQuery("#the-list tr .feedback a").click(function(){
		
		jQuery('#modal-feedback').modal('show');
	});
	//var toggle = false;
	jQuery("#show-settings-link").click(function(){
		var toggle = jQuery(this).attr("aria-expanded");
		if(toggle === false){
			toggle = true;
			jQuery("#screen-meta #contextual-help-wrap").removeClass("hidden");
			jQuery("#screen-meta #screen-options-wrap").removeClass("hidden");
		}
		else{
			toggle = false;
			jQuery("#screen-meta #contextual-help-wrap").addClass("hidden");
			jQuery("#screen-meta #screen-options-wrap").addClass("hidden");
		}
	});
	
	jQuery(".invoice_to_client").click(function(){
		var is_checked = false;
		jQuery(".invoice_to_client").each(function(){
			if(jQuery(this).is(":checked")){
				is_checked = true;
			}
		});
		
		if(is_checked === true){
			jQuery("#send-invoice").removeAttr("disabled");
		}
		else{
			jQuery("#send-invoice").attr("disabled", "disabled");
		}
	});
	
	jQuery(".reminder_to_client").click(function(){
		var is_checked = false;
		jQuery(".reminder_to_client").each(function(){
			if(jQuery(this).is(":checked")){
				is_checked = true;
			}
		});
		
		if(is_checked === true){
			jQuery("#send-reminder").removeAttr("disabled");
		}
		else{
			jQuery("#send-reminder").attr("disabled", "disabled");
		}
	});
	
});
