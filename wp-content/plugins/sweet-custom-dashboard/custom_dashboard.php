<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">
<?php 
	$user = wp_get_current_user();
?>
	<h3>Welcome <?php echo ucfirst($user->data->user_login);?>, your code is : <?php if($user->roles[0] == 'author' ) { echo $user->data->client_code; } else if($user->roles[0] == 'editor') { echo $user->data->promoter_code; }?></h3>
	
	<!-- <div class="container">
		<table id="table_id" class="display" cellspacing="0" width="100%">
		        <thead>
		            <tr>
		                <th>Name</th>
		                <th>Position</th>
		                <th>Office</th>
		                <th>Age</th>
		                <th>Start date</th>
		                <th>Salary</th>
		            </tr>
		        </thead>
		        <tbody>
		            <tr>
		                <td>Tiger Nixon</td>
		                <td>System Architect</td>
		                <td>Edinburgh</td>
		                <td>61</td>
		                <td>2011/04/25</td>
		                <td>$320,800</td>
		            </tr>
		            <tr>
		                <td>Garrett Winters</td>
		                <td>Accountant</td>
		                <td>Tokyo</td>
		                <td>63</td>
		                <td>2011/07/25</td>
		                <td>$170,750</td>
		            </tr>
		            <tr>
		                <td>Ashton Cox</td>
		                <td>Junior Technical Author</td>
		                <td>San Francisco</td>
		                <td>66</td>
		                <td>2009/01/12</td>
		                <td>$86,000</td>
		            </tr>
		            <tr>
		                <td>Cedric Kelly</td>
		                <td>Senior Javascript Developer</td>
		                <td>Edinburgh</td>
		                <td>22</td>
		                <td>2012/03/29</td>
		                <td>$433,060</td>
		            </tr>
		            <tr>
		                <td>Airi Satou</td>
		                <td>Accountant</td>
		                <td>Tokyo</td>
		                <td>33</td>
		                <td>2008/11/28</td>
		                <td>$162,700</td>
		            </tr>
		        </tbody>
		</table>
	</div> -->
	

</div>
<?php include( ABSPATH . 'wp-admin/admin-footer.php' );
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
	    jQuery('#table_id').DataTable();
	} );
</script>