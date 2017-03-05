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
	
	
	
	jQuery("#send-invoice").click(function(){
		
		var data_to_send = {};
		var i=0;
		jQuery(".invoice_to_client").each(function(){
			if(jQuery(this).is(":checked")){
				//I have nothign to do here this is just a condition.
				var video_details = {
					'video_id' 		: jQuery(this).val(),
					'exp_date'		: jQuery(this).data('expdate'),
					'video_code'	: jQuery(this).data('videocode'),
					'clientcode'	: jQuery(this).data('clientcode'),
					'clientname'	: jQuery(this).data('clientname'),
				};
				data_to_send[i] = video_details;
				i = i +1;
			}
			else{
				
			}
		});
		//var serialized_data = JSON.stringify(data_to_send);
		//data_to_send.serialize();
		//console.log(BASE_URL);
		jQuery.ajax({

			url : BASE_URL+"/wp-admin/admin-ajax.php",
			type : 'POST',
			dataType: 'json',
			data : {
				"invoice_data"	: data_to_send,
				'action' 		: 'sendInvoice'
			},
			success : function( response ) {
				//console.log(response);
				//on success function append response object elements to the places where it should append.
				//$(".hero-banner-image").css("background-image", "url('"+response.image_url+"')");
				//$(".hero_title").html(response.title);
				//$(".text-description").html(response.description);
				//$(".form-header").html(response.form_description);
				//$(".form_footer").html(response.form_footer);
				if(response == 1){
					jQuery(".wrap").before("<div class='update-nag notice-success block-alert'>Invoice sent to administration<span class='is-dismissable'></span></div>");
					setTimeout(function(){
					     window.location.reload();
					}, 5000);
				} else if (response == 0) {
					jQuery(".wrap").before("<div class='update-nag notice-error block-alert'>An error occured.<span class='is-dismissable'></span></div>");
					setTimeout(function(){
					     window.location.reload();
					}, 5000);
				}
			}
		});
	});

	jQuery("#send-reminder").click(function(){
		
		var data_to_remind = {};
		var i=0;
		jQuery(".reminder_to_client").each(function(){
			if(jQuery(this).is(":checked")){
				//I have nothign to do here this is just a condition.
				var video_details = {
					'video_id' 		: jQuery(this).val(),
					'exp_date'		: jQuery(this).data('expdate'),
					'video_code'	: jQuery(this).data('videocode'),
					'clientcode'	: jQuery(this).data('clientcode'),
					'clientname'	: jQuery(this).data('clientname'),
					'posteddate'	: jQuery(this).data('posteddate'),
					'email'			: jQuery(this).data('email'),
				};
				data_to_remind[i] = video_details;
				i = i +1;
			}
			else{
				
			}
		});
		//var serialized_data = JSON.stringify(data_to_send);
		//data_to_send.serialize();
		//console.log(BASE_URL);
		jQuery.ajax({

			url : BASE_URL+"/wp-admin/admin-ajax.php",
			type : 'POST',
			dataType: 'json',
			data : {
				"reminder_data"	: data_to_remind,
				'action' 		: 'sendReminder'
			},
			success : function( response ) {
				//console.log(response);
				//on success function append response object elements to the places where it should append.
				//$(".hero-banner-image").css("background-image", "url('"+response.image_url+"')");
				//$(".hero_title").html(response.title);
				//$(".text-description").html(response.description);
				//$(".form-header").html(response.form_description);
				//$(".form_footer").html(response.form_footer);
				if(response == 1){
					jQuery(".wrap").before("<div class='update-nag notice-success block-alert'>Reminder sent to client<span class='is-dismissable'></span></div>");
					setTimeout(function(){
					     window.location.reload();
					}, 5000);
				} else if (response == 0) {
					jQuery(".wrap").before("<div class='update-nag notice-error block-alert'>An error occured.<span class='is-dismissable'></span></div>");
					setTimeout(function(){
					     window.location.reload();
					}, 5000);
				}
			}
		});
	});
	

	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});
