<?php
/*
Template Name: Viewer
*/
get_header();
?>
<?php
//echo do_shortcode('[wppb-register]');
//echo do_shortcode('[wppb-login]');
?>
<div class="container register-viewer p-v-80">
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
					<h2 id="modal_title">Create user profile</h2>
					<h6 class="m-0">All fields are required</h6>
				</div>
           </div>
            <hr class="hidden-xs col-sm-12">
            <form name="registerform" action="" method="post" class="form-horizontal mini-label">
               <div class="col-sm-offset-1 col-sm-10">
					<div class="row">
						<div class="form-group has-success has-feedback">
							<label class="col-sm-5">First name</label>
							<div class="col-sm-7 m-b-sm-10">
								 <input type="text" class="form-control" name="first_name" id="first_name" value="">
								<span class="glyphicon glyphicon-ok form-control-feedback"></span>
							</div>
						</div>
						<div class="form-group has-error has-feedback">
							<label class="col-sm-5">Last name</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="last_name" id="last_name" value="">
								<span class="glyphicon glyphicon-remove form-control-feedback"></span>
								<span class="text-danger">Last name too short</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5">Email address</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="user_email" id="user_email" value="">
								 <h6>You will use this email to sign in to your profile after registration </h6>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5">Confirm email address</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="email">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5">Choose password</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="password" id="password" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5">Confirm password</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="c_password" id="c_password" value="">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">Address 1</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text" class="form-control" name="address_1" id="address_1" value="">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">Address 2</label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="address_2" id="address_2" value="">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">Country</label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="country" id="country" value="">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">City</label>
							<div class="col-sm-7 m-b-sm-10">
          					   <input type="text" class="form-control" name="city" id="city" value="">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5">Pin Code</label>
							<div class="col-sm-7 m-b-sm-10">
          					  <input type="text" class="form-control" name="pin_code" id="pin_code" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5">Phone number</label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="text">
							</div>
						</div>
                        <div class="form-group">
							<label class="col-sm-5"></label>
							<div class="col-sm-7 m-b-sm-10">
								<input type="checkbox"> I Agree with  <a href="javascript:void(0)">Terms and Conditions</a>
							</div>
						</div>
					</div>
				</div>
            <hr class="hidden-xs col-sm-12">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        <input type="hidden" id="model_hid_id" name="" value="0"/>
                        <button type="submit" class="btn btn-block btn-primary register">Create user profile</button>
                    </div>
                </div>
            </form>
        </div>
		</div>
    </div>
<?php
get_footer();
?>
