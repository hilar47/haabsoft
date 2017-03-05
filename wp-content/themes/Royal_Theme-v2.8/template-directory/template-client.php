<?php 
/*
Template Name: Client
*/
get_header();
?>
<?php
//echo do_shortcode('[wppb-register]');
//echo do_shortcode('[wppb-login]');
?>
<div class="container register-global p-b-80">
<div class="outer">
        <div id="success" class="alert alert-success" style="display:none;">
            <strong>You are registered Successfully!</strong> Please <a href="<?php echo site_url() . '/wp-admin'; ?>">click
                here</a> to login.
        </div>
        <div id="error" class="alert alert-danger" style="display:none;">
            <strong>Error Occured!!!</strong> Please submit the form again to register.
        </div>
    </div>
       	<div class="row">
       	 <div class="col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8">
            <div class="col-sm-offset-1 col-sm-10">
				<div class="row">
					<h2 id="modal_title">Create client profile</h2>
					<h6 class="m-0">All <span class="text-red">*</span> fields are required</h6>
				</div>
           </div>
            <hr class="hidden-xs col-sm-12">
            <form name="registerform" action="" method="post" class="form-horizontal mini-label">
               <div class="col-sm-offset-1 col-sm-10">
					<div class="row">
						<div class="form-group has-feedback">
							<label for="example-text-input" class="col-sm-5">First name<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								 <input type="text" class="form-control" name="first_name" id="first_name" value="">
                                 <h6>You will use this Username to sign in to your profile after registration </h6>
                                 <span class="text-danger" id="first_name_errmsg"></span>
								<?php /*?><span class="glyphicon glyphicon-ok form-control-feedback"></span><?php */?>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label for="example-text-input" class="col-sm-5">Last name<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="last_name" id="last_name" value="">
                                <span class="text-danger" id="last_name_errmsg"></span>
								<?php /*?><span class="glyphicon glyphicon-remove form-control-feedback"></span><?php */?>
							</div>
						</div>
						<div class="form-group">
							<label for="example-text-input" class="col-sm-5">Email address<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="user_email" id="user_email" value="">
                                <span class="text-danger" id="user_email_errmsg"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="example-text-input" class="col-sm-5">Confirm email address<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="confirm_user_email" id="confirm_user_email" value="">
                                <span class="text-danger" id="confirm_user_email_errmsg"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="example-text-input" class="col-sm-5">Choose password<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="password" class="form-control" name="password" id="password" value="">
                                <span class="text-danger" id="password_errmsg"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="example-text-input" class="col-sm-5">Confirm password<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="password" class="form-control" name="c_password" id="c_password" value="">
                                <span class="text-danger" id="c_password_errmsg"></span>
							</div>
						</div>
                        <div class="form-group">
							<label for="example-text-input" class="col-sm-5">Country<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="country" id="country" value="">
                               <span class="text-danger" id="country_errmsg"></span>
							</div>
						</div>
                        <div class="form-group">
							<label for="example-text-input" class="col-sm-5">State<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="state" id="state" value="">
                               <span class="text-danger" id="state_errmsg"></span>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">Address 1<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="address_1" id="address_1" value="">
                                <span class="text-danger" id="address_1_errmsg"></span>
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">Address 2<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="address_2" id="address_2" value="">
							</div>
						</div>
                        <div class="form-group">
							<label for="example-text-input" class="col-sm-5">City<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="city" id="city" value="">
                               <span class="text-danger" id="city_errmsg"></span>
							</div>
						</div>
                        <!-- <div class="form-group">
							<label for="example-text-input" class="col-sm-5">Area/Town<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="area_town" id="area_town" value="">
                               <span class="text-danger" id="area_town_errmsg"></span>
							</div>
						</div> -->
                        <div class="form-group">
							<label for="example-text-input" class="col-sm-5">Post Code<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
          					  <input type="text" class="form-control" name="pin_code" id="pin_code" value="">
                              <span class="text-danger" id="pin_code_errmsg"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="example-text-input" class="col-sm-5">Phone number<span class="text-red">*</span></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="phone" id="phone" value="" maxlength="10">
                                <span class="text-danger" id="phone_errmsg"></span>
                                <span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group">
                            <label for="example-text-input" class="col-sm-5">Landline<span class="text-red">*</span></label>
                            <div class="col-sm-7 m-b-sm-10">
                                <input type="text" class="form-control" name="landline" id="landline" value="" maxlength="10">
                                <span class="text-danger" id="landline_errmsg"></span>
                                <span class="help-block"></span>
                            </div>
        				</div>
                        <div class="form-group">
                            <label for="example-text-input" class="col-sm-5">Agent Code<span class="text-red">*</span></label>
                            <div class="col-sm-7 m-b-sm-10">
                                <input type="text" class="form-control" name="agent_code" id="agent_code" value="">
                                <span class="text-danger" id="agent_code_errmsg"></span>
                                <span class="help-block"></span>
                             </div>
                        </div>
                        <div class="form-group">
							<label class="col-sm-5"></label>
							<div class="col-sm-7 m-b-sm-10">
                                <input type="checkbox" class="form-control" name="terms_conditions" id="terms_conditions" value="1">
                                I Agree with  <a href="javascript:void(0)">Terms and Conditions</a><br />
            <span id="terms_conditions_errmsg"></span>
            <span class="help-block"></span>
							</div>
						</div>
					</div>
				</div>
            <hr class="hidden-xs col-sm-12">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input type="hidden" id="model_hid_id" name="" value="2"/>
        				<input type="hidden" name="client_code" id="client_code" value=""/>
                        <button type="button" class="btn btn-block btn-primary client">Create client profile</button>
                    </div>
                </div>
            </form>
        </div>
		</div>
    </div>
<?php 
get_footer();
?>
