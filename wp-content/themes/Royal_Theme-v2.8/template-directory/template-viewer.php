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
<div class="container">
    <div class="outer">
        <div id="success" class="alert alert-success" style="display:none;">
            <strong>You are registered Successfully!</strong> Please <a href="<?php echo site_url() . '/wp-admin'; ?>">click
                here</a> to login.
        </div>
        <div id="error" class="alert alert-danger" style="display:none;">
            <strong>Error Occured!!!</strong> Please submit the form again to register.
        </div>
    </div>
    <h4 class="modal-title" id="modal_title">Sign up as Viewer</h4>
    <form name="registerform" action="" method="post">
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">First Name</label>
            <div class="col-10">
                <input type="text" class="form-control" name="first_name" id="first_name" value="">
            </div>
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="">
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">E-mail</label>
            <input type="text" class="form-control" name="user_email" id="user_email" value="">
            <span id="user_email_errmsg"></span>
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Confirm E-mail</label>
            <input type="text" class="form-control" name="confirm_user_email" id="confirm_user_email" value="">
            <span id="confirm_user_email_errmsg"></span>
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Password</label>
            <input type="text" class="form-control" name="password" id="password" value="">
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Confirm Password</label>
            <input type="text" class="form-control" name="c_password" id="c_password" value="">
        </div>
        <!-- <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Address 1</label>
            <input type="text" class="form-control" name="address_1" id="address_1" value="">
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Address 2</label>
            <input type="text" class="form-control" name="address_2" id="address_2" value="">
        </div> -->
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Country</label>
            <input type="text" class="form-control" name="country" id="country" value="">
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">City</label>
            <input type="text" class="form-control" name="city" id="city" value="">
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Area/Town</label>
            <input type="text" class="form-control" name="area_town" id="area_town" value="">
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Post Code</label>
            <input type="text" class="form-control" name="pin_code" id="pin_code" value="">
            <span id="pin_code_errmsg"></span>
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Cell Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" value="" maxlength="10">
            <span id="phone_errmsg"></span>
            <span class="help-block"></span>
        </div>
        <div class="form-group">
            <label for="example-text-input" class="col-2 col-form-label">Accept Terms/Conditions</label>
            <input type="checkbox" class="form-control" name="terms_conditions" id="terms_conditions" value="1">
            <span id="terms_conditions_errmsg"></span>
            <span class="help-block"></span>
        </div>
        <input type="hidden" id="model_hid_id" name="" value="0"/>
        <button type="button" class="btn btn-info register">Register</button>
    </form>

</div>
<?php
get_footer();
?>
