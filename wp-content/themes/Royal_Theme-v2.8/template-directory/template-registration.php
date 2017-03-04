<?php
/*
Template Name: Registration
*/
get_header();
?>
<?php
//echo do_shortcode('[wppb-register]');
//echo do_shortcode('[wppb-login]');
?>
<div class="container register p-v-80">
	<h1 class="text-center">Your Headline Here</h1>
	<p class="text-center">Lorem ipsum dolor sit amet,<br />consectetur adipiscing elit sed do eiusmod.</p>
    <div class="col-sm-offset-1 col-sm-10 m-t-40">
        <div class="row">
            <div class="col-sm-4">
            	<div class="panel">
                    <img src="<?php echo site_url() . '/wp-content/themes/Royal_Theme-v2.8/images/custom-assets/icon-new-user.png'; ?>" alt="Sign up as viwer" class="center-block" />
                    <h2 class="text-center">New User</h2>
                    <p class="text-center">Lorem ipsum dolor sit amet, consecte adipisicing elit, sed do eiusmod  incididunt ut</p>
                     <a href="<?php echo site_url() . '/viewer'; ?>"><button type="submit" class="btn btn-block btn-primary">Create user profile</button> </a>
                 </div>    
            </div>
            <div class="col-sm-4">
            	<div class="panel">
                    <img src="<?php echo site_url() . '/wp-content/themes/Royal_Theme-v2.8/images/custom-assets/icon-new-client.png'; ?>" alt="Sign up as Client" class="center-block" />
                    <h2 class="text-center">Client</h2>
                    <p class="text-center">Lorem ipsum dolor sit amet, consecte adipisicing elit, sed do eiusmod  incididunt ut</p>
                     <a href="<?php echo site_url() . '/client'; ?>"><button type="submit" class="btn btn-block btn-primary">Create client profile</button> </a>
                 </div>
            </div>
            <div class="col-sm-4">
            	<div class="panel">
                    <img src="<?php echo site_url() . '/wp-content/themes/Royal_Theme-v2.8/images/custom-assets/icon-new-promoter.png'; ?>" alt="Sign up as Promoter" class="center-block" />
                    <h2 class="text-center">Promoter</h2>
                    <p class="text-center">Lorem ipsum dolor sit amet, consecte adipisicing elit, sed do eiusmod  incididunt ut</p>
                     <a href="<?php echo site_url() . '/promoter'; ?>"><button type="submit" class="btn btn-block btn-primary">Create promoter profile</button> </a>
                 </div>    
            </div>
        </div>
	</div>
</div>
<?php
get_footer();
?>
