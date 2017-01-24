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