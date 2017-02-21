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
<div class="container">
    <div class="outer">
        <a href="<?php echo site_url() . '/viewer'; ?>">Sign up as Viewer</a>
        <a href="<?php echo site_url() . '/client'; ?>">Sign up as Client</a>
        <a href="<?php echo site_url() . '/promoter   '; ?>">Sign up as Promoter</a>
    </div>

</div>
<?php
get_footer();
?>
