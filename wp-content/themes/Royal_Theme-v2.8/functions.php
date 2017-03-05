<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
require_once( get_template_directory() . '/framework/init.php' );

include_once 'metaboxes/setup.php';
include_once 'metaboxes/VIDEO-spec.php';
include_once 'metaboxes/PAGE-spec.php';

//Add custom admin styles css
function admin_style() {
    global $post_type;
    // wp_enqueue_script( 'my_custom_script', 'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js' );
    wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin/css/custom-override.css');
    wp_enqueue_script( 'my_custom_script', get_template_directory_uri().'/js_admin/admin_scripts.js' );
    // wp_enqueue_script( 'data', 'https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js' );
    // wp_enqueue_script( 'datatb', 'https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js' );
    //wp_enqueue_script( 'my_custom_script', get_template_directory_uri().'/admin/js/test.js' );
    //wp_enqueue_style('bootstrap', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css");
    wp_enqueue_style('font-awsome', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css");
    //wp_enqueue_style('boot', "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");
    // wp_enqueue_style('datatables', "https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css");
    if( 'videos' == $post_type ){
        wp_enqueue_style('bootstrap-css',  get_template_directory_uri().'/css/bootstrap.min.css');
        wp_enqueue_script( 'bootstrap-js', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js" );
        wp_enqueue_script( 'videos-admin-script', get_stylesheet_directory_uri() . '/js_admin/video-js.js' );
        
    }
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
        $company = get_the_author_meta( 'company', $user->ID );
    	$username = get_the_author_meta( 'select_md', $user->ID );
        echo "<pre>----".$user->ID;
        print_r($company);
        print_r($username);
        echo "</pre>";
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
                    <?php if(isset($users) && !empty($users)) {

                        ?>
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

//Sending email once post is published
// add_action( 'transition_post_status', 'send_mails_on_publish', 10, 3 );

// function send_mails_on_publish( $new_status, $old_status, $post )
// {
//     if ( 'publish' !== $new_status or 'publish' === $old_status
//         or 'videos' !== get_post_type( $post ) )
//         return;

//     //$subscribers = get_users( array ( 'role' => 'editor' ) );
//     //$meta = get_users( $post->post_author );
//     $meta = get_user_by( 'ID', $post->post_author );
    
//     $email = $meta->data->user_email;
//     $body = sprintf( 'Hey there is a new entry!
//         See <%s>',
//         get_permalink( $post )
//     );


//     wp_mail( $email, 'New entry!', $body );
// }

// add_filter( 'gettext', 'change_publish_button', 10, 2 );

function change_publish_button( $translation, $text ) {
    if(current_user_can('author')){
        if ( $text == 'Publish' )
            return 'Pay';
    }

    return $translation;
}

/*Saving post as draft before payment*/
add_action('publish_videos', 'check_user_publish', 10, 2);

function check_user_publish ($post_id, $post) {
    $postDate = strtotime( $post->post_date );
    $modifiedDate = strtotime( $post->post_modified );
    if($postDate == $modifiedDate){
        if(current_user_can('author')){
            $user_details = wp_get_current_user();
            $email = $user_details->data->user_email;
            if($post->post_type == 'videos'){
                $query = array(
                    'ID' => $post_id,
                    'post_status' => 'draft',
                );
                $post_id = wp_update_post( $query, true );
                
                if ( is_wp_error( $post_id ) ) {
                     echo $post_id->get_error_message();
                }
                else {
                    $url = site_url()."/pay-form?id=".$post_id."&price=0.1&post_name=".$post->post_title."&payer_email=".$email;
                     wp_redirect($url);
                     exit();
                }
            }
        }
    }
}

/* Redirect the user logging in to a Video Section. */
function new_dashboard_home($username, $user){
    if(array_key_exists('administrator', $user->caps) || array_key_exists('editor', $user->caps) || array_key_exists('subscriber', $user->caps) || array_key_exists('author', $user->caps)){
        wp_redirect(admin_url('edit.php?post_type=videos', 'http'), 301);
        exit;
    }
}
add_action('wp_login', 'new_dashboard_home', 10, 2);

//Adding thumbnails to the admin section
add_filter('manage_videos_posts_columns', 'ST4_columns_head_only_videos', 10);
add_action('manage_videos_posts_custom_column', 'ST4_columns_content_only_videos', 10, 2);

//Add column to the Videos
function ST4_columns_head_only_videos($defaults) {
    $defaults['videos'] = 'Videos';
    return $defaults;
}

//Fetch data to the Videos newly added column
function ST4_columns_content_only_videos($column_name, $post_ID) {
    if($column_name == 'videos') {
        global $content_item_meta;
        $meta = get_post_meta($post_ID);
        $video_upload = (isset($meta['video_upload'][0]) && !empty($meta['video_upload'][0]) ? $meta['video_upload'][0] : '');
        echo "<video controls style='width:200px;'><source src='".$video_upload."' type='video/mp4'></video>";
    }
}

// ADD NEW COLUMN IN CUSTOM POST
function videos_columns_head($defaults) {
     
    $defaults['renew'] = 'Renew';
    $defaults['feedback'] = 'Feedback';
    return $defaults;
}

add_filter('manage_videos_posts_columns', 'videos_columns_head');
add_action('manage_videos_posts_custom_column', 'ST4_columns_content', 10, 2);

// function ST4_get_featured_image($post_ID) {
//     return 'link';
// }

function ST4_columns_head($defaults) {
    $defaults['renew_link'] = 'Renew link';
    $defaults['feedback_link'] = 'Renew link';
    return $defaults;
}
 
// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID) {
    if ($column_name == 'renew') {
        echo '<a href="javascript:void(0);">Renew</a>';
    } else if($column_name == 'feedback') {
        echo '<a href="javascript:void(0);">Feedback</a>';
    }
}


// Add Login/Logout menu item in top bar
function add_login_logout_navitem($items, $args ) {
 if ( !(is_user_logged_in()) ) {
   $login_item = '<li id="menu-item-login" class="menu-item menu-item-type-post_type menu-item-object-page"><a href="'.site_url().'/wp-login.php">Login</a></li>';
 
 }else {
     $login_item = '<li id="menu-item-logout" class="menu-item menu-item-type-post_type menu-item-object-page">'.wp_loginout($_SERVER['REQUEST_URI'], false).'</li>
';
 }
 $items .= $login_item;
 return $items;
}
add_filter('wp_nav_menu_items', 'add_login_logout_navitem', 10, 2);
add_action('wp_logout','go_home');
function go_home(){
  wp_redirect( site_url() );
  exit();
}


//Function to get the title and other attributes of promo page

//wp_enqueue_script('jquery');
function sendInvoice(){
	
	if($_POST){
		
		if(!empty($_POST['invoice_data'])){
			//$decoded = json_decode($_POST['invoice_data']);
			//echo $_POST['invoice_data'];
			//$tempData = html_entity_decode($_POST['invoice_data']);
			$cleanData = json_decode($tempData);
			echo "<pre>";
			print_r($_POST['invoice_data']);
			echo "</pre>";
			
			$message = 'Hi Admin,<br>Please send me the commission for the below mentioned videos.<br/><br/><table><thead><tr><th>Video Id</th><th>Expiry Date</th><th>Video Code</th><th>Client Code</th><th>Client Name</th></tr> ';
			
			if(!empty($_POST['invoice_data']) && isset($_POST['invoice_data'])){
				
				foreach($_POST['invoice_data'] as $invoice){
					
					$message .= '<tr><td>'.$invoice['video_id'].'</td><td>'.$invoice['exp_date'].'</td><td>'.$invoice['video_code'].'</td><td>'.$invoice['clientcode'].'</td><td>'.$invoice['clientname'].'</td><tr>';
				}
			}
			$message .= '</table>';
			
			$return_op = "<br><br>Regards,<br>Haab Soft";
			//echo get_administrator_email();
			$to = get_administrator_email();
			$subject = 'Deposit Comission of promoter';
			$body = $message;
			//echo $message;
			$headers = array('Content-Type: text/html; charset=UTF-8');

			$result = wp_mail( $to, $subject, $body, $headers );
			
			//echo "here";
			echo json_encode($result);
		}
	}
	else{
		echo json_encode(false);
	}
	die();
}
add_action('wp_ajax_sendInvoice', 'sendInvoice');
add_action('wp_ajax_nopriv_sendInvoice', 'sendInvoice');
function get_administrator_email(){
	$email = '';
	$blogusers = get_users('role=Administrator');
	//print_r($blogusers);
	foreach ($blogusers as $user) {
		$email = $user->user_email;
	}
	return $email;
}