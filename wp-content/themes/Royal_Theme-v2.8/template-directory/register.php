<?php 
$link = new mysqli('localhost', 'root', '', 'haabsoft');
if ($link->connect_error) {
	die('Could not connect: ' . mysql_error());
}

if(isset($_POST['model_hid_id'])){
	if($_POST['model_hid_id'] == '0'){
		$serialise_array['subscriber'] = '1';
	} else if($_POST['model_hid_id'] == '2') {
		$serialise_array['author'] = '1';
	} else if($_POST['model_hid_id'] == '7') {
		$serialise_array['editor'] = '1';
	}
}
if(isset($_POST['password']) && !empty($_POST['password'])) {
	$pass = md5($_POST['password']);
}
if(isset($_POST['first_name']) && !empty($_POST['first_name'])) {
	$display_name = $_POST['first_name'].' '.$_POST['last_name'];
}
if(isset($_POST['p_code']) && !empty($_POST['p_code'])) {
	$p_code = $_POST['p_code'];
} else {
	$p_code = '';
}
if(isset($_POST['state']) && !empty($_POST['state'])) {
	$state = $_POST['state'];
} else {
	$state = '';
}
// if(isset($_POST['address_1']) && !empty($_POST['address_1'])) {
// 	$address = $_POST['address_1'].' '.$_POST['address_2'];
// }
$current_date_time = date('Y-m-d h:i:s');
if(isset($_POST['user_email']) && !empty($_POST['user_email'])){
	$sql = "SELECT * FROM wp_users where user_email='".$_POST['user_email']."'";
	$result = $link->query($sql);
	if ($result->num_rows == 0) {
	    $sql = "INSERT INTO wp_users (user_login, user_pass, user_nicename, user_email, user_url, user_registered,user_activation_key,user_status,display_name,country,state,city,area_town,pincode,phone,promoter_code)
VALUES ('".$_POST['first_name']."', '".$pass."','".$_POST['first_name']."','".$_POST['user_email']."','','".$current_date_time."','','','".$display_name."','".$_POST['country']."','".$state."','".$_POST['city']."','".$_POST['area_town']."','".$_POST['pin_code']."','".$_POST['phone']."','".$p_code."')";

		if ($link->query($sql) === TRUE) {
			$last_id = $link->insert_id;
		    $sql1 = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value)
VALUES ('".$last_id."', 'nickname','".$_POST['first_name']."'),('".$last_id."', 'first_name','".$_POST['first_name']."'),('".$last_id."', 'last_name','".$_POST['last_name']."'),('".$last_id."', 'description',''),('".$last_id."', 'rich_editing','true'),('".$last_id."', 'comment_shortcuts','false'),('".$last_id."', 'admin_color','fresh'),('".$last_id."', 'use_ssl','0'),('".$last_id."', 'show_admin_bar_front','true'),('".$last_id."', 'locale',''),('".$last_id."', 'wp_capabilities','".serialize($serialise_array)."'),('".$last_id."', 'wp_user_level','".$_POST['model_hid_id']."'),('".$last_id."', 'company',''),('".$last_id."', 'select_md',''),('".$last_id."', 'dismissed_wp_pointers','')";
			if ($link->query($sql1) === TRUE) {
				echo 'success';
			} else {
				echo "error";
			}
		} else {
		    echo "error";
		}
	} else {
	    echo 'user-exists';
	}
}
?>