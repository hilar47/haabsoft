<?php
global $etheme_responsive;
$fd = etheme_get_option('footer_demo');
$fbg = etheme_get_option('footer_bg');
$fcolor = etheme_get_option('footer_text_color');
$ft = '';
$ft = apply_filters('custom_footer_filter', $ft);
$custom_footer = etheme_get_custom_field('custom_footer', et_get_page_id());
?>

<?php if ($custom_footer != 'without'): ?>
    <?php if ((is_active_sidebar('footer1') || $fd) && empty($custom_footer)): ?>
        <div class="footer-top footer-top-<?php echo esc_attr($ft); ?>">
            <div class="container">
                <?php if (!is_active_sidebar('footer1')) : ?>
                    <?php if ($fd) etheme_footer_demo('footer1'); ?>
                <?php else: ?>
                    <?php dynamic_sidebar('footer1'); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>


    <?php if ((is_active_sidebar('footer2') || $fd) && empty($custom_footer)): ?>
        <div class="footer-top footer-top-<?php echo esc_attr($ft); ?>">
            <div class="container">
                <?php if (!is_active_sidebar('footer1')) : ?>
                    <?php if ($fd) etheme_footer_demo('footer1'); ?>
                <?php else: ?>
                    <?php dynamic_sidebar('footer1'); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!empty($custom_footer)): ?>
        <div class="footer-top footer-top-<?php echo esc_attr($ft); ?>">
            <div class="container">
                <?php if (!is_active_sidebar('footer1')) : ?>
                    <?php if ($fd) etheme_footer_demo('footer1'); ?>
                <?php else: ?>
                    <?php dynamic_sidebar('footer1'); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if ((is_active_sidebar('footer9') || is_active_sidebar('footer10') || $fd) && empty($custom_footer)): ?>
        <div class="copyright copyright-<?php echo esc_attr($ft); ?> text-color-<?php echo $fcolor; ?>"
             <?php if ($fbg != ''): ?>style="background-color:<?php echo $fbg; ?>"<?php endif; ?>>
            <div class="container">
                <div class="row-copyrights">
                        <?php if (is_active_sidebar('footer9')): ?>
                            <?php dynamic_sidebar('footer9'); ?>
                        <?php else: ?>
                            <?php if ($fd) etheme_footer_demo('footer9'); ?>
                        <?php endif; ?>
                    <div class="clearfix visible-xs"></div>
                    <div class="copyright-payment pull-right">
                        <?php if (is_active_sidebar('footer10')): ?>
                            <?php dynamic_sidebar('footer10'); ?>
                        <?php else: ?>
                            <?php if ($fd) etheme_footer_demo('footer10'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

</div> <!-- page wrapper -->
</div> <!-- st-content-inner -->
</div>
</div>
<?php do_action('after_page_wrapper'); ?>
</div> <!-- st-container -->


<?php if (etheme_get_option('loader')): ?>
    <script type="text/javascript">
        if (jQuery(window).width() > 1200) {
            jQuery("body").queryLoader2({
                barColor: "#111",
                backgroundColor: "#fff",
                percentage: true,
                barHeight: 2,
                completeAnimation: "grow",
                minimumTime: 500,
                onLoadComplete: function () {
                    jQuery('body').addClass('page-loaded');
                }
            });
        }
    </script>
<?php endif; ?>

<?php if (etheme_get_option('to_top')): ?>
    <div id="back-top"
         class="back-top <?php if (!etheme_get_option('to_top_mobile')): ?>visible-lg<?php endif; ?> bounceOut">
        <a href="#top">
            <span></span>
        </a>
    </div>
<?php endif ?>
<script type="text/javascript">
    function isValidEmailAddress(emailAddress) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(emailAddress);
    }
    ;
    jQuery('#first_name, #last_name, #country, #city').keydown(function (e) {
        if (e.shiftKey || e.ctrlKey || e.altKey) {
            e.preventDefault();
        } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
                e.preventDefault();
            }
        }
    });
    jQuery("#pin_code").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            jQuery("#pin_code_errmsg").html("Enter Digits Only").css('color', 'red').show().fadeOut("slow");
            return false;
        }
    });
    jQuery("#phone").keypress(function (e) {
        //if the letter is not digit then display error and don't type anything
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            jQuery("#phone_errmsg").html("Enter Digits Only").css('color', 'red').show().fadeOut("slow");
            return false;
        }
    });

    jQuery("#first_name,#last_name,#user_email,#password,#c_password,#address_1,#address_2,#country,#city,#pin_code,#phone").keyup(function (e) {
        jQuery(this).css('border-color', '#d5d5d5');
        jQuery(this).next('span').html('');
    });
    jQuery('.btn-lg').click(function (e) {
        var user_role = jQuery(this).data('id');
        if (user_role == '0') {
            jQuery('#modal_title').html('Sign up as Viewer');
        } else if (user_role == '2') {
            jQuery('#modal_title').html('Sign up as Client');
        } else if (user_role == '7') {
            jQuery('#modal_title').html('Sign up as Promoter');
        }
        jQuery('#model_hid_id').val(user_role);
        jQuery('#myModal').modal('show');

    });
    function randomString(length, chars, val) {
        if(val == 1){
            var result = '';
            for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
            return 'PROMO_'+result;
        } else {
            var result = '';
            for (var i = length; i > 0; --i) result += chars[Math.round(Math.random() * (chars.length - 1))];
            return 'CLI_'+result;
        }
    }
    jQuery('#user_email_errmsg')
    jQuery('.register').click(function () {
        var p_code = jQuery('#promoter_code').val();
        var first_name = jQuery('#first_name').val();
        var last_name = jQuery('#last_name').val();
        var user_email = jQuery('#user_email').val();
        var confirm_user_email = jQuery('#confirm_user_email').val();
        var password = jQuery('#password').val();
        var c_password = jQuery('#c_password').val();
        // var address_1 = jQuery('#address_1').val();
        // var address_2 = jQuery('#address_2').val();
        var country = jQuery('#country').val();
        var city = jQuery('#city').val();
        var area_town = jQuery('#area_town').val();
        var pin_code = jQuery('#pin_code').val();
        var phone = jQuery('#phone').val();
        var terms_conditions = jQuery('#terms_conditions').val();
        var model_hid_id = jQuery('#model_hid_id').val();
        var checked = jQuery('input[name=terms_conditions]:checked').val();
        //console.log(first_name+' '+last_name+' '+user_email+' '+password+' '+c_password+' '+address_1+' '+address_2+' '+country+' '+city+' '+pin_code+' '+model_hid_id);
        if (jQuery.trim(first_name).length != 0) {
            if (jQuery.trim(last_name).length != 0) {
                if (jQuery.trim(user_email).length != 0) {
                    if (isValidEmailAddress(user_email)) {
                        if (jQuery.trim(confirm_user_email).length != 0) {
                            if (isValidEmailAddress(confirm_user_email)) {
                                if(user_email == confirm_user_email) {
                                    if (jQuery.trim(password).length != 0) {
                                        if (jQuery.trim(c_password).length != 0) {
                                            if (password == c_password) {
                                                //if (jQuery.trim(address_1).length != 0) {
                                                    if (jQuery.trim(country).length != 0) {
                                                        if (jQuery.trim(city).length != 0) {
                                                            if (jQuery.trim(pin_code).length != 0) {
                                                                if (jQuery.trim(phone).length != 0) {
                                                                    if (phone.length >= 10) {
                                                                        if(checked == 1){
                                                                            var path = '<?php echo get_template_directory_uri();?>';
                                                                            var url = path + '/template-directory/register.php';
                                                                            jQuery.ajax({
                                                                                url: url,
                                                                                type: "POST",
                                                                                data: {
                                                                                    first_name: first_name,
                                                                                    last_name: last_name,
                                                                                    user_email: user_email,
                                                                                    confirm_user_email: confirm_user_email,
                                                                                    password: password,
                                                                                    c_password: c_password,
                                                                                    country: country,
                                                                                    city: city,
                                                                                    area_town: area_town,
                                                                                    pin_code: pin_code,
                                                                                    phone: phone,
                                                                                    p_code: p_code,
                                                                                    model_hid_id: model_hid_id
                                                                                },
                                                                                success: function (msg) {
                                                                                    console.log(msg);
                                                                                    if (msg == 'success') {
                                                                                        jQuery('#error').css('display', 'none');
                                                                                        jQuery('#myModal').modal('hide');
                                                                                        jQuery('#success').show().css('display', 'block');
                                                                                        setTimeout(function () {
                                                                                            window.location.href = "http://localhost/haabsoft/register/";
                                                                                        }, 5000);
                                                                                    } else if (msg == 'error') {
                                                                                        jQuery('#myModal').modal('hide');
                                                                                        jQuery('#error').show().css('display', 'block');
                                                                                        // $('#error').html('Error Occured').show().css('color','red').delay(2000).fadeOut('slow');
                                                                                    } else if (msg == 'user-exists') {
                                                                                        //$('#myModal').modal('hide');
                                                                                        jQuery('#user_exist').css('display', 'block');
                                                                                    }
                                                                                }
                                                                            });
                                                                        } else {
                                                                            
                                                                            jQuery('#terms_conditions_errmsg').html("Accept the terms and conditions").addClass('has-error');
                                                                        }
                                                                    } else {
                                                                        jQuery('#phone_errmsg').html("Enter Valid Number").addClass('has-error');
                                                                    }
                                                                } else {
                                                                    jQuery('#phone').addClass('has-error');
                                                                }
                                                            } else {
                                                                jQuery('#pin_code').addClass('has-error');
                                                            }
                                                        } else {
                                                            jQuery('#city').addClass('has-error');
                                                        }
                                                    } else {
                                                        jQuery('#country').addClass('has-error');
                                                    }
                                                // } else {
                                                //     jQuery('#address_1').css('border-color', 'red');
                                                // }
                                            } else {
                                                jQuery('#c_password').addClass('has-error');
                                            }
                                        } else {
                                            jQuery('#c_password').addClass('has-error');
                                        }
                                    } else {
                                        jQuery('#password').addClass('has-error');
                                    }
                                } else {
                                    jQuery('#confirm_user_email_errmsg').html("Email does not match").addClass('has-error');
                                }
                            } else {
                                jQuery('#confirm_user_email_errmsg').html("Invalid Email").addClass('has-error');
                            }
                        } else {
                            jQuery('#confirm_user_email').addClass('has-error');
                        }
                    } else {
                        jQuery('#user_email_errmsg').html("Invalid Email").addClass('has-error');
                    }
                } else {
                    jQuery('#user_email').addClass('has-error');
                }
            } else {
                jQuery('#last_name').addClass('has-error');
            }
        } else {
            jQuery('#first_name').addClass('has-error');
			jQuery('#first_name_errmsg').html("empty");
        }
    });

    jQuery('.client').click(function () {
        var c_code = jQuery('#client_code').val();
        var first_name = jQuery('#first_name').val();
        var last_name = jQuery('#last_name').val();
        var user_email = jQuery('#user_email').val();
        var confirm_user_email = jQuery('#confirm_user_email').val();
        var password = jQuery('#password').val();
        var c_password = jQuery('#c_password').val();
        var address_1 = jQuery('#address_1').val();
        var address_2 = jQuery('#address_2').val();
        var country = jQuery('#country').val();
        var city = jQuery('#city').val();
        var state = jQuery('#state').val();
        var pin_code = jQuery('#pin_code').val();
        var phone = jQuery('#phone').val();
        var landline = jQuery('#landline').val();
        var agent_code = jQuery('#agent_code').val();
        var terms_conditions = jQuery('#terms_conditions').val();
        var model_hid_id = jQuery('#model_hid_id').val();
        var checked = jQuery('input[name=terms_conditions]:checked').val();
        //console.log(first_name+' '+last_name+' '+user_email+' '+password+' '+c_password+' '+address_1+' '+address_2+' '+country+' '+city+' '+pin_code+' '+model_hid_id);
        if (jQuery.trim(first_name).length != 0) {
            if (jQuery.trim(last_name).length != 0) {
                if (jQuery.trim(user_email).length != 0) {
                    if (isValidEmailAddress(user_email)) {
                        if (jQuery.trim(confirm_user_email).length != 0) {
                            if (isValidEmailAddress(confirm_user_email)) {
                                if(user_email == confirm_user_email) {
                                    if (jQuery.trim(password).length != 0) {
                                        if (jQuery.trim(c_password).length != 0) {
                                            if (password == c_password) {
                                                if (jQuery.trim(address_1).length != 0) {
                                                    if (jQuery.trim(country).length != 0) {
                                                        if (jQuery.trim(city).length != 0) {
                                                            if (jQuery.trim(pin_code).length != 0) {
                                                                if (jQuery.trim(phone).length != 0) {
                                                                    if (phone.length >= 10) {
                                                                        //if(jQuery.trim(agent_code).length != 0){
                                                                            if(checked == 1){
                                                                                var path = '<?php echo get_template_directory_uri();?>';
                                                                                var url = path + '/template-directory/register_client.php';
                                                                                jQuery.ajax({
                                                                                    url: url,
                                                                                    type: "POST",
                                                                                    data: {
                                                                                        first_name: first_name,
                                                                                        last_name: last_name,
                                                                                        user_email: user_email,
                                                                                        confirm_user_email: confirm_user_email,
                                                                                        password: password,
                                                                                        c_password: c_password,
                                                                                        address_1: address_1,
                                                                                        address_2: address_2,
                                                                                        country: country,
                                                                                        city: city,
                                                                                        state: state,
                                                                                        pin_code: pin_code,
                                                                                        landline: landline,
                                                                                        agent_code: agent_code,
                                                                                        phone: phone,
                                                                                        model_hid_id: model_hid_id,
                                                                                        c_code: c_code,
                                                                                    },
                                                                                    success: function (msg) {
                                                                                        console.log(msg);
                                                                                        if (msg == 'success') {
                                                                                            jQuery('#error').css('display', 'none');
                                                                                            jQuery('#myModal').modal('hide');
                                                                                            jQuery('#success').show().css('display', 'block');
                                                                                            setTimeout(function () {
                                                                                                window.location.href = "http://localhost/haabsoft/register/";
                                                                                            }, 5000);
                                                                                        } else if (msg == 'error') {
                                                                                            jQuery('#myModal').modal('hide');
                                                                                            jQuery('#error').show().css('display', 'block');
                                                                                            // $('#error').html('Error Occured').show().css('color','red').delay(2000).fadeOut('slow');
                                                                                        } else if (msg == 'user-exists') {
                                                                                            //$('#myModal').modal('hide');
                                                                                            jQuery('#user_exist').css('display', 'block');
                                                                                        } else if (msg == 'invalid-code') {
                                                                                                jQuery('#agent_code_errmsg').html("invalid code").css('color', 'red');
                                                                                        }
                                                                                    }
                                                                                });
                                                                            } else {
                                                                                
                                                                                jQuery('#terms_conditions_errmsg').html("Accept the terms and conditions").css('color', 'red');
                                                                            }
                                                                        // } else {
                                                                        //     jQuery('#agent_code_errmsg').html("Enter code").css('color', 'red');
                                                                        // }
                                                                    } else {
                                                                        jQuery('#phone_errmsg').html("Enter Valid Number").css('color', 'red');
                                                                    }
                                                                } else {
                                                                    jQuery('#phone').css('border-color', 'red');
                                                                }
                                                            } else {
                                                                jQuery('#pin_code').css('border-color', 'red');
                                                            }
                                                        } else {
                                                            jQuery('#city').css('border-color', 'red');
                                                        }
                                                    } else {
                                                        jQuery('#country').css('border-color', 'red');
                                                    }
                                                } else {
                                                    jQuery('#address_1').css('border-color', 'red');
                                                }
                                            } else {
                                                jQuery('#c_password').css('border-color', 'red');
                                            }
                                        } else {
                                            jQuery('#c_password').css('border-color', 'red');
                                        }
                                    } else {
                                        jQuery('#password').css('border-color', 'red');
                                    }
                                } else {
                                    jQuery('#confirm_user_email_errmsg').html("Email does not match").css('color', 'red');
                                }
                            } else {
                                jQuery('#confirm_user_email_errmsg').html("Invalid Email").css('color', 'red');
                            }
                        } else {
                            jQuery('#confirm_user_email').css('border-color', 'red');
                        }
                    } else {
                        jQuery('#user_email_errmsg').html("Invalid Email").css('color', 'red');
                    }
                } else {
                    jQuery('#user_email').css('border-color', 'red');
                }
            } else {
                jQuery('#last_name').css('border-color', 'red');
            }
        } else {
            jQuery('#first_name').css('border-color', 'red');
        }
    });

    jQuery(document).ready(function () {
        jQuery.getJSON("http://freegeoip.net/json/", function (data) {
            var country = data.country_name;
            var ip = data.ip;
            localStorage.setItem('country', country);
            var storedData = localStorage.getItem('country');
            console.log(storedData);
            if (storedData != '') {
                jQuery('#cntryId').val(storedData);
            }
        });
        jQuery('#promoter_code').val(randomString(5, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 1));
        jQuery('#client_code').val(randomString(5, '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 2));
    })

    jQuery('.video-search').click(function () {
        var id = jQuery(this).data('id');
        jQuery('#myModal_'+id).modal('show');
    });
</script>

<?php
/* Always have wp_footer() just before the closing </body>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to reference JavaScript files.
 */

wp_footer();
?>
</body>

</html>