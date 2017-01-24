<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
require_once( get_template_directory() . '/framework/init.php' );

include_once 'metaboxes/setup.php';
include_once 'metaboxes/VIDEO-spec.php';
include_once 'metaboxes/PAGE-spec.php';

//Add custom admin styles css
function admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin/css/custom-override.css');
	wp_enqueue_script( 'my_custom_script', get_template_directory_uri().'/js_admin/admin_scripts.js' );
	//wp_enqueue_script( 'my_custom_script', get_template_directory_uri().'/admin/js/test.js' );
	//wp_enqueue_style('bootstrap', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css");
	wp_enqueue_style('font-awsome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css");
}
add_action('admin_enqueue_scripts', 'admin_style');

//Restrict users to their own posts
function posts_for_current_author($query) {
    global $pagenow;
	if( 'edit.php' != $pagenow || !$query->is_admin )
	    return $query;

	if( !current_user_can( 'edit_others_posts' ) ) {
		global $user_ID;
		$query->set('author', $user_ID );
	}
	// if( !current_user_can( 'edit_others_posts' ) ) {
	// 	global $user_ID;
	// 	$query->set('editor', $user_ID );
	// }
	return $query;
}
add_filter('pre_get_posts', 'posts_for_current_author');

//hide all count on listing screen
add_filter( 'views_edit-post', 'wpse149143_edit_posts_views' );

function wpse149143_edit_posts_views( $views ) {
    foreach ( $views as $index => $view ) {
        $views[ $index ] = preg_replace( '/ <span class="count">\([0-9]+\)<\/span>/', '', $view );
    }

    return $views;
}

//Adding Custom fields in the add/edit user screen
function custom_user_profile_fields($user){
    if(is_object($user)) {
        $company = esc_attr( get_the_author_meta( 'company', $user->ID ) );
    	$username = get_the_author_meta( 'select_md', $user->ID );
    } else {
        $company = null;
    	$username = null;
    }
    ?>
    <h3>Choose Clients</h3>
    <table class="form-table">
        <tr>
            <th><label for="company">Select Your clients</label></th>
            <td>
        		<?php
                    $is_selected = '';
        			$users = get_users( 'role=author' );
        		?>
            	<select name="select_md[]" multiple="multiple" id="select_md">
                    <?php if(isset($users) && !empty($users)) {?>
                        <?php foreach($users as $user) {
                            $selected = (in_array($user->ID, $username)) ? 'selected="selected"' : '' ;
                            echo "<option value='".$user->ID."' ".$selected.">".$user->user_login."</option>";
                            }
                        ?>
                    <?php } else { ?>
                        <option value="">--Select--</option>
                    <?php } ?>
            	</select>
            	<input type="button" id="select_all_state" class="btn btn-bricky" name="select_all_state" value="Select All Items">
				<input type="button" id="unselect_all_state" class="btn btn-bricky" name="unselect_all_state" value="Unselect All Items">
            </td>
        </tr>
    </table>
<?php
}
add_action( 'show_user_profile', 'custom_user_profile_fields' );
add_action( 'edit_user_profile', 'custom_user_profile_fields' );
add_action( "user_new_form", "custom_user_profile_fields" );

//Saving the data from custom fields
function save_custom_user_profile_fields($user_id){
    # again do this only if you can
    if(!current_user_can('manage_options'))
        return false;
 
    # save my custom field
    update_user_meta($user_id, 'company', $_POST['company']);
    update_user_meta($user_id, 'select_md', $_POST['select_md']);
}
add_action('user_register', 'save_custom_user_profile_fields');
add_action('profile_update', 'save_custom_user_profile_fields');

//fetch all the posts added by editor(Promoter) and its selected author(Clients) 
add_action( 'pre_get_posts', 'wpcf_filter_author_posts' );
function wpcf_filter_author_posts( $query ){
    global $post_type, $pagenow;
    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php' && $post_type == 'videos' && current_user_can('editor')){
        global $user_ID;
        $meta = get_user_meta( $user_ID );
        $selected_author_id = unserialize($meta['select_md'][0]);
        if(isset($selected_author_id) && !empty($selected_author_id)){
            $count = count($selected_author_id);
            $selected_author_id[$count] = $user_ID;
            $query->query_vars['author__in'] = $selected_author_id;
        } else {
            $query->query_vars['author'] = $user_ID;
            
        }
    }
}

//Display only clients in the authors dropdown list while creating new Video
add_action('pre_user_query','ap_pre_user_query');
function ap_pre_user_query($user_search) {
  $user = wp_get_current_user();
  if ($user->ID!=1) { // Is not administrator, remove administrator (you can add any user-ID)
    global $wpdb;
    global $user_ID;
    $meta = get_user_meta( $user_ID );
    $selected_author_id = unserialize($meta['select_md'][0]);
    $count = count($selected_author_id);
    $selected_author_id[$count] = $user_ID;
    $store_ids = '';
    foreach($selected_author_id as $ids){
        $store_ids .= $ids.',';
    }
    $final_ids = rtrim($store_ids,',');
    $user_search->query_where = str_replace('WHERE 1=1',"WHERE 1=1 AND {$wpdb->users}.ID<>1 AND {$wpdb->users}.ID IN (".$final_ids.")",$user_search->query_where);
  }
}

// user registration login form
function pippin_registration_form() {
 
    // only show the registration form to non-logged-in members
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        // check to make sure user registration is enabled
        $registration_enabled = get_option('users_can_register');
 
        // only show the registration form if allowed
        if($registration_enabled) {
            $output = pippin_registration_form_fields();
        } else {
            $output = __('User registration is not enabled');
        }
        return $output;
    }
}
add_shortcode('register_form', 'pippin_registration_form');

// user login form
function pippin_login_form() {
 
    if(!is_user_logged_in()) {
 
        global $pippin_load_css;
 
        // set this to true so the CSS is loaded
        $pippin_load_css = true;
 
        $output = pippin_login_form_fields();
    } else {
        // could show some logged in user info here
        // $output = 'user info here';
    }
    return $output;
}
add_shortcode('login_form', 'pippin_login_form');

// registration form fields
function pippin_registration_form_fields() {
 
    ob_start(); ?>  
        <h3 class="pippin_header"><?php _e('Register New Account'); ?></h3>
 
        <?php 
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
 
        <form id="pippin_registration_form" class="pippin_form" action="" method="POST">
            <fieldset>
                <p>
                    <label for="pippin_user_Login"><?php _e('Username'); ?></label>
                    <input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
                </p>
                <p>
                    <label for="pippin_user_email"><?php _e('Email'); ?></label>
                    <input name="pippin_user_email" id="pippin_user_email" class="required" type="email"/>
                </p>
                <p>
                    <label for="pippin_user_first"><?php _e('First Name'); ?></label>
                    <input name="pippin_user_first" id="pippin_user_first" type="text"/>
                </p>
                <p>
                    <label for="pippin_user_last"><?php _e('Last Name'); ?></label>
                    <input name="pippin_user_last" id="pippin_user_last" type="text"/>
                </p>
                <p>
                    <label for="password"><?php _e('Password'); ?></label>
                    <input name="pippin_user_pass" id="password" class="required" type="password"/>
                </p>
                <p>
                    <label for="password_again"><?php _e('Password Again'); ?></label>
                    <input name="pippin_user_pass_confirm" id="password_again" class="required" type="password"/>
                </p>
                <p>
                    <input type="hidden" name="pippin_register_nonce" value="<?php echo wp_create_nonce('pippin-register-nonce'); ?>"/>
                    <input type="submit" value="<?php _e('Register Your Account'); ?>"/>
                </p>
            </fieldset>
        </form>
    <?php
    return ob_get_clean();
}

// login form fields
function pippin_login_form_fields() {
 
    ob_start(); ?>
        <h3 class="pippin_header"><?php _e('Login'); ?></h3>
 
        <?php
        // show any error messages after form submission
        pippin_show_error_messages(); ?>
 
        <form id="pippin_login_form"  class="pippin_form"action="" method="post">
            <fieldset>
                <p>
                    <label for="pippin_user_Login">Username</label>
                    <input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
                </p>
                <p>
                    <label for="pippin_user_pass">Password</label>
                    <input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
                </p>
                <p>
                    <input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
                    <input id="pippin_login_submit" type="submit" value="Login"/>
                </p>
            </fieldset>
        </form>
    <?php
    return ob_get_clean();
}

// logs a member in after submitting a form
function pippin_login_member() {
 
    if(isset($_POST['pippin_user_login']) && wp_verify_nonce($_POST['pippin_login_nonce'], 'pippin-login-nonce')) {
 
        // this returns the user ID and other info from the user name
        $user = get_userdatabylogin($_POST['pippin_user_login']);
 
        if(!$user) {
            // if the user name doesn't exist
            pippin_errors()->add('empty_username', __('Invalid username'));
        }
 
        if(!isset($_POST['pippin_user_pass']) || $_POST['pippin_user_pass'] == '') {
            // if no password was entered
            pippin_errors()->add('empty_password', __('Please enter a password'));
        }
 
        // check the user's login with their password
        if(!wp_check_password($_POST['pippin_user_pass'], $user->user_pass, $user->ID)) {
            // if the password is incorrect for the specified user
            pippin_errors()->add('empty_password', __('Incorrect password'));
        }
 
        // retrieve all error messages
        $errors = pippin_errors()->get_error_messages();
 
        // only log the user in if there are no errors
        if(empty($errors)) {
 
            wp_setcookie($_POST['pippin_user_login'], $_POST['pippin_user_pass'], true);
            wp_set_current_user($user->ID, $_POST['pippin_user_login']);    
            do_action('wp_login', $_POST['pippin_user_login']);
 
            wp_redirect(home_url()); exit;
        }
    }
}
add_action('init', 'pippin_login_member');

// register a new user
function pippin_add_new_member() {
    if (isset( $_POST["pippin_user_login"] ) && wp_verify_nonce($_POST['pippin_register_nonce'], 'pippin-register-nonce')) {
        $user_login     = $_POST["pippin_user_login"];  
        $user_email     = $_POST["pippin_user_email"];
        $user_first     = $_POST["pippin_user_first"];
        $user_last      = $_POST["pippin_user_last"];
        $user_pass      = $_POST["pippin_user_pass"];
        $pass_confirm   = $_POST["pippin_user_pass_confirm"];
 
        // this is required for username checks
        require_once(ABSPATH . WPINC . '/registration.php');
 
        if(username_exists($user_login)) {
            // Username already registered
            pippin_errors()->add('username_unavailable', __('Username already taken'));
        }
        if(!validate_username($user_login)) {
            // invalid username
            pippin_errors()->add('username_invalid', __('Invalid username'));
        }
        if($user_login == '') {
            // empty username
            pippin_errors()->add('username_empty', __('Please enter a username'));
        }
        if(!is_email($user_email)) {
            //invalid email
            pippin_errors()->add('email_invalid', __('Invalid email'));
        }
        if(email_exists($user_email)) {
            //Email address already registered
            pippin_errors()->add('email_used', __('Email already registered'));
        }
        if($user_pass == '') {
            // passwords do not match
            pippin_errors()->add('password_empty', __('Please enter a password'));
        }
        if($user_pass != $pass_confirm) {
            // passwords do not match
            pippin_errors()->add('password_mismatch', __('Passwords do not match'));
        }
 
        $errors = pippin_errors()->get_error_messages();
 
        // only create the user in if there are no errors
        if(empty($errors)) {
 
            $new_user_id = wp_insert_user(array(
                    'user_login'        => $user_login,
                    'user_pass'         => $user_pass,
                    'user_email'        => $user_email,
                    'first_name'        => $user_first,
                    'last_name'         => $user_last,
                    'user_registered'   => date('Y-m-d H:i:s'),
                    'role'              => 'subscriber'
                )
            );
            if($new_user_id) {
                // send an email to the admin alerting them of the registration
                wp_new_user_notification($new_user_id);
 
                // log the new user in
                wp_setcookie($user_login, $user_pass, true);
                wp_set_current_user($new_user_id, $user_login); 
                do_action('wp_login', $user_login);
 
                // send the newly created user to the home page after logging them in
                wp_redirect(home_url()); exit;
            }
 
        }
 
    }
}
add_action('init', 'pippin_add_new_member');

// used for tracking error messages
function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}

// displays error messages from form submissions
function pippin_show_error_messages() {
    if($codes = pippin_errors()->get_error_codes()) {
        echo '<div class="pippin_errors">';
            // Loop error codes and display errors
           foreach($codes as $code){
                $message = pippin_errors()->get_error_message($code);
                echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
            }
        echo '</div>';
    }   
}