<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
require_once( get_template_directory() . '/framework/init.php' );

include_once 'metaboxes/setup.php';
include_once 'metaboxes/VIDEO-spec.php';

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

//hide all count
add_filter( 'views_edit-post', 'wpse149143_edit_posts_views' );

function wpse149143_edit_posts_views( $views ) {
    foreach ( $views as $index => $view ) {
        $views[ $index ] = preg_replace( '/ <span class="count">\([0-9]+\)<\/span>/', '', $view );
    }

    return $views;
}

function custom_user_profile_fields($user){
    if(is_object($user)) {
        $company = esc_attr( get_the_author_meta( 'company', $user->ID ) );
    	$username = esc_attr( get_the_author_meta( 'select_md', $user->ID ) );
    } else {
        $company = null;
    	$username = null;
    }
    ?>
    <h3>Choose Moderator</h3>
    <?php 
    // echo "<pre>";
    // print_r(wp_get_current_user());
    // echo "</pre>";
    ?>
    <table class="form-table">
        <tr>
            <th><label for="company">Company Name</label></th>
            <td>
                <input type="text" class="regular-text" name="company" value="<?php echo $company; ?>" id="company" /><br />
                <span class="description">Where are you?</span>
            </td>
        </tr>
        <tr>
            <th><label for="company">Moderator Options</label></th>
            <td>
        		<?php
        			$users = get_users( 'role=author' );
        		?>
            	<select name="select_md" id="select_md">
                    <option value="">--Select--</option>
            		<?php foreach($users as $user) {?>
            			<option value="<?php echo $user->ID;?>" <?php if($username == $user->ID) { echo "selected='selected'"; } ?>><?php echo $user->user_login;?></option>
            		<?php } ?>
            	</select>
            	<!--<input type="button" id="select_all_state" class="btn btn-bricky" name="select_all_state" value="Select All Items">
				<input type="button" id="unselect_all_state" class="btn btn-bricky" name="unselect_all_state" value="Unselect All Items">-->
            </td>
        </tr>
    </table>
<?php
}
add_action( 'show_user_profile', 'custom_user_profile_fields' );
add_action( 'edit_user_profile', 'custom_user_profile_fields' );
add_action( "user_new_form", "custom_user_profile_fields" );

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

//Adding the filter
// function rudr_filter_by_the_author() {
// 	$params = array(
// 		'name' => 'author',
// 		'show_option_all' => 'All authors'
// 	);
 
// 	if ( isset($_GET['user']) )
// 		$params['selected'] = $_GET['user']; // choose selected user by $_GET variable
 
// 	wp_dropdown_users( $params ); // print the ready author list
// }
 
//add_action('restrict_manage_posts', 'rudr_filter_by_the_author');

add_action( 'pre_get_posts', 'wpcf_filter_author_posts' );
   function wpcf_filter_author_posts( $query ){
    global $post_type, $pagenow;
    //if we are currently on the edit screen of the post type listings
    if($pagenow == 'edit.php' && $post_type == 'post' && current_user_can('editor')){
        global $user_ID;
        $meta = get_user_meta( $user_ID );
        $selected_author_id = $meta['select_md'][0];
        
        //if the author is not 0 (meaning all)
        if($selected_author_id != ''){
            // echo "<pre>";
            // print_r($query);
            // echo "</pre>";
            // exit();
            //$query->query_vars['author'] = $selected_author_id;
            //$query->query_vars['author'] = $user_ID;
            $query->query_vars['author__in'] = array($selected_author_id,$user_ID);
            // $query->set('authors__in', array(2,8) );
            // return;
        } else {
            $query->query_vars['author'] = $user_ID;
            
        }
    }
   }
