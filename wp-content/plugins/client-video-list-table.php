<?php
/*
Plugin Name: My List Table Example
*/



if( ! class_exists( 'WP_List_Table' ) ) {
    
	require_once( ABSPATH . 'wp-admin/includes/class-wp-screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/screen.php' );
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
    require_once( ABSPATH . 'wp-admin/includes/template.php' );
	
}
	
class My_List_Table extends WP_List_Table {
	
	var $example_data = '';
	
	public function __construct(){
		
		parent::__construct(array(
			'singular'		=> 'wp_list_text_link', //Singular label
			'plural' 		=> 'wp_list_test_links', //plural label, also this well be one of the table css class
			'ajax'   		=> false //We won't support Ajax for this table
		));
	}
	
	function get_data($search = NULL){
		//include_once WP_CONTENT_DIR . '/wpalchemy/MetaBox.php';
		//include_once WP_CONTENT_DIR . '/wpalchemy/MediaAccess.php';
		global $content_item_meta;
		
		global $wpdb;
		
		$querystr = "SELECT wp_posts.*,wp_users.*,wp_posts.ID as video_id,payments.* FROM wp_posts, wp_users,payments WHERE 1=1 AND payments.itemid=wp_posts.ID AND (((wp_posts.post_title LIKE '%".$search."%') OR (wp_posts.post_excerpt LIKE '%".$search."%') OR (wp_posts.post_content LIKE '%".$search."%') OR (wp_users.display_name LIKE '%".$search."%'))) AND wp_posts.post_type = 'videos' AND (wp_posts.post_status = 'publish' OR wp_posts.post_status = 'future' OR wp_posts.post_status = 'draft' OR wp_posts.post_status = 'pending' OR wp_posts.post_status = 'private') AND wp_posts.post_author = wp_users.ID  ORDER BY wp_posts.post_date DESC";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
		//$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'_posts p,'.$wpdb->prefix.'_users u WHERE u.user_id = p.post_author;'));

		
		
		

		//echo "<pre>";
		//print_r($pageposts);
		//echo "</pre>";
		
		$data = array();
		//echo WP_CONTENT_DIR;
		
		//GET METABOX DATA FOR CURRENT POST
		
		/*if($search != NULL){
			$query = new WP_Query(array(
				'post_type' 		=> 'videos',
				'posts_per_page'	=>-1,
				's' 				=> $search
			));
			//echo "Preparing Search";
		}
		else{
			$query = new WP_Query(array(
				'post_type' 		=> 'videos',
				'posts_per_page'	=>-1,
			));
		}*/
		
		
		//$posts = $query->posts;
		
		//echo "<pre>";
		//print_r($pageposts);
		//echo "</pre>";
		//echo $custom_metabox->get_the_id();
		
		foreach($pageposts as $post) {
			
			$meta = get_post_meta($post->ID, $content_item_meta->get_the_id(), true);
			
			
			$expiry_date = strtotime("+7 day", strtotime($post->post_date));
			$exp_date = date("d-m-Y H:i:s", $expiry_date);
			$exp_stat = '';
			if($expiry_date < strtotime(date("Y-m-d H:i:s"))){
				$exp_stat = "Expired";
			}
			else{
				$exp_stat = "Active";
			}
			
			$disable_invoice = '';
			$commission_status = '';
			if($post->commission_status){
				$commission_status = 'Yes';
				$disable_invoice = 'disabled="disabled"';
			}
			else{
				$commission_status = 'No';
			}
			$commission_due = '';
			if($post->commission_status){
				$commission_due = 'No';
			}
			else{
				$commission_due = 'Yes';
			}
			
		//echo "<pre>";
		//print_r($meta);
		//echo "</pre>";
			//echo "<pre>";
			//print_r(get_post_meta($post->ID,  , true));
			$user_data = get_user_by(  "ID", $post->post_author )->data;
			//print_r($user_data);
			//echo "</pre>";
			$invoice_to_client = '<input type="checkbox" '.$disable_invoice.' data-expdate="'.$exp_date.'" data-videocode="VID_'.$post->video_id.'" data-clientcode="'.$post->client_code.'" data-clientname="'.$user_data->display_name.'" class="invoice_to_client" id="invoice_to_client'.$post->ID.'" value="'.$post->video_id.'"';
			//$reminder_to_client = '<input type="checkbox" class="reminder_to_client" id="reminder_to_client"'.$post->ID.'" value="'.$post->ID.'"';
			$reminder_to_client = '<input type="checkbox" '.$disable_invoice.' data-expdate="'.$exp_date.'" data-videocode="VID_'.$post->video_id.'" data-clientcode="'.$post->client_code.'" data-clientname="'.$user_data->display_name.'" class="reminder_to_client" id="reminder_to_client'.$post->ID.'" value="'.$post->video_id.'"';
			
			
			// Do your stuff, e.g.
			$new_data = '';
			$new_data = array(
				'clientname' 			=> $user_data->display_name,
				'clientcode'    		=> $post->client_code,
				'videocode'      		=> 'VID_'.$post->video_id,
				'expdate'				=> $exp_date,
				'expstatus'      		=> $exp_stat,
				'commissionreceived'    => $commission_status,
				'commissiondue'      	=> $commission_due,
				'invoicetoclient'      	=> $invoice_to_client,
				'remindertoclient'		=> $reminder_to_client,
			);
			array_push($data, $new_data);
		}
		return $data;
	}
	
	function get_columns(){

		$columns = array(
			'clientname' 			=> 'Client Name',
			'clientcode'    		=> 'Client Code',
			'videocode'      		=> 'Video Code',
			'expdate'				=> 'Exp. Date',
			'expstatus'      		=> 'Exp. Status',
			'commissionreceived'    => 'Commission Received',
			'commissiondue'      	=> 'Commission Due',
			'invoicetoclient'      	=> 'Invoice to Admin',
			'remindertoclient'		=> 'Reminder to Client',
		);
		return $columns;
	}

	function prepare_items($search = NULL){
		
		$this->example_data = $this->get_data($search);

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		usort( $this->example_data, array( &$this, 'usort_reorder' ) );

		$per_page = 5;
		$current_page = $this->get_pagenum();
		$total_items = count($this->example_data);

		$this->example_data = array_slice($this->example_data,(($current_page-1)*$per_page),$per_page);

		$this->set_pagination_args(array(
			'total_items' => $total_items,                  //WE have to calculate the total number of items
			'per_page'    => $per_page                     //WE have to determine how many items to show on a page
		));
		$this->items = $this->example_data;

		/*
		//Working code with some warning messages
		$columns = $this->get_columns();
		$hidden = $this->get_hidden_columns();
		$sortable = $this->get_sortable_columns();

		$data = $this->get_data();
		usort( $data, array( &$this, 'sort_data' ) );

		$perPage = 10;
		$currentPage = $this->get_pagenum();
		$totalItems = count($data);
		$this->set_pagination_args( array(
			'total_items' => $totalItems,
			'per_page'    => $perPage
		) );
		$data = array_slice($data,(($currentPage-1)*$perPage),$perPage);
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $data;*/
	}
	
	
	
	function column_default( $item, $column_name ) {
		switch( $column_name ) {
			case 'clientname':
			case 'clientcode':
			case 'videocode':
			case 'expdate':
			case 'expstatus':
			case 'commissionreceived':
			case 'commissiondue':
			case 'invoicetoclient':
			case 'remindertoclient':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
		}
	}
	
	function get_sortable_columns() {
		$sortable_columns = array(
			'clientname'			=> array('clientname',false),
			'clientcode' 			=> array('clientcode',false),
			'videocode'   			=> array('videocode',false),
			'expdate'   			=> array('expdate',false),
			'expstatus'   			=> array('expstatus',false),
			'commissionreceived'   	=> array('commissionreceived',false),
			'commissiondue'   		=> array('commissiondue',false),
			'invoicetoclient'   	=> array('invoicetoclient',false),
			'remindertoclient'   	=> array('remindertoclient',false)
		);
		return $sortable_columns;
	}
	
	function usort_reorder( $a, $b ) {
		// If no sort, default to title
		$orderby = ( ! empty( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'clientname';
		// If no order, default to asc
		$order = ( ! empty($_GET['order'] ) ) ? $_GET['order'] : 'asc';
		// Determine sort order
		$result = strcmp( $a[$orderby], $b[$orderby] );
		// Send final sort direction to usort
		return ( $order === 'asc' ) ? $result : -$result;
	}
	/*
	function column_booktitle($item) {
		//$delete_var = wp_nonce_url( get_admin_url(), 'post.php?post='.$item['ID'].'action="trash"', _wpnonces );
		$delete_url = get_delete_post_link( $item['ID'], $deprecated, false );
		
		$actions = array(
			'edit'      => sprintf('
			<a href="'.get_admin_url().'post.php?post=%s&action=%s">Edit</a>',$item['ID'],'edit'),
			'delete'    => '<a href="'.$delete_url.'">Trash</a>',
		);

		return sprintf('%1$s %2$s', $item['booktitle'], $this->row_actions($actions) );
	}*/
	/*
	function get_bulk_actions() {
		$actions = array(
			'trash'    => 'Trash'
		);
		return $actions;
	}*/
	
	/*function column_cb($item) {
		return sprintf(
		'<input type="checkbox" name="videos[]" value="%s" />', $item['ID']
		);    
	}*/
}//Close the class

function my_add_menu_items(){
    //add_menu_page( 'Completed Post', 'Completed Post', 'activate_plugins', 'my_list_test', 'my_render_list_page' );
	add_submenu_page(
		'edit.php?post_type=videos',
		'All Client Video List',
		'All Client Video List',
		'edit_pages',
		'all_client_video_list',
		'my_render_list_page',
		'dashicons-tickets',
		6
	);
}
add_action( 'admin_menu', 'my_add_menu_items' );

/*Add plugin specific scripts*/
add_action('admin_enqueue_scripts', 'video_plugin_js');
function video_plugin_js() {
	//wp_enqueue_style('bootstrap-css',  get_template_directory_uri().'/css/bootstrap.min.css');
	wp_enqueue_script( 'videos-admin-script', get_stylesheet_directory_uri() . '/js_admin/video-js.js' );
}

function my_render_list_page(){
	$myListTable = new My_List_Table();
	echo '<div class="wrap"><h2> All Client Video List </h2>';
	
	//Fetch, prepare, sort, and filter our data...
	if( isset($_POST['s']) ){
			//echo "inhere";
		$myListTable->prepare_items($_POST['s']);
	} 
	else {
		$myListTable->prepare_items();
	}
	
	//$myListTable->prepare_items();
	
	
	echo '<form method="post">
  	<input type="hidden" name="page" value="all_client_video_list" />';
  	echo $myListTable->search_box('search', 'search_id'); 
	echo '</form>';
	$myListTable->display();
	echo '<div class="btn_container">
		<input type="submit" id="send-invoice" class="button" value="Send Invoice" disabled="disabled">
		<input type="submit" id="send-reminder" class="button" value="Send Reminder" disabled="disabled">
		</div>';
	echo '</div>';
	echo '<script>var BASE_URL = "'.get_site_url().'";</script>'; 
}