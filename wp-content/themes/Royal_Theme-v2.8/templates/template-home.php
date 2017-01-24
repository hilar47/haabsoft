<?php 
/*
Template Name: Home
*/

get_header();
?>

<section class="banner" role="banner">
	<div class="container">
		<div class="row">
			<div class="col m4">
				<a href="space">
					<img src="<?php echo get_template_directory_uri();?>/images/space-header.jpg" class="responsive-img"/>
					<h1>space</h1>
				</a>
			</div>
			<div class="col m4">
				<a href="family">
					<img src="<?php echo get_template_directory_uri();?>/images/family-header.jpg" class="responsive-img"/>
					<h1>family</h1>
				</a>
			</div>
			<div class="col m4">
				<a href="celebration">
					<img src="<?php echo get_template_directory_uri();?>/images/celebration-header.jpg" class="responsive-img"/>
					<h1>celebration</h1>
				</a>
			</div>
		</div>
	</div>
</section>

<section class="content">
	<div class="container">
		<div class="row center-align">
			<h1>For a feeling called <span>HOME.</span></h1>
			<p>Mohidin Properties & Holdings- A division of the renowned Mohidin Group has always believed that the living space is an extension of one’s own inner life. To materialize your dreams, we give attention to every detail of the interior and exterior space.
		We emphasize on changing living into an experience.</p>
			<hr/>
		</div>
		<div class="row custom-height">
			<div class="col s12 m6">
				<img src="<?php echo get_template_directory_uri();?>/images/home-project.jpg" class="responsive-img"/>
			</div>
			<div class="col s12 m6">
				<h2>projects</h2>
				<p>We have a dedicated team of architects and interior designers to merge your needs with the plan, furniture, floor, kitchen space etc. By applying our minds and energy, we turn ordinary living spaces into modern, contemporary and innovative spaces. </p>
				<a class="btn btn-flat blue-btn" href="#">view projects</a>
			</div>
		</div>
		
	</div>
</section>

<section class="custom-content center-align">
	<div class="container">
		<h1 class="">Nestled in paradise</h1>
		<p>Located in the panaromic state of Goa incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore </p>
		<!--<a href="javascript:void(0);" class="btn border-only-btn">view all project locations</a>-->
	</div>
</section>


<!--<section class="home-testimonials">
	<?php echo do_shortcode( '[sp_testimonials_slider design="design-1" slides_column="3"]' ); ?>
	<div class="view-all"><a href="testimonials">View all testimonials</a></div>
</section>-->



<?php get_footer(); ?>
