<?php

/**
 * Template Name: full-width Template
 * @package WordPress
 * @subpackage Idle Rocks
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>

<h1><? the_title();?></h1>
<div class="social-icons">
	<a href="http://twitter.com/theidlerocks" title="Follow us on twitter" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Link to our twitter profile" /></a>
	<a href="https://www.facebook.com/theidlerocks" title="Follow us on Facebook" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/fb.png" alt="Link to our Facebook profile" /></a>
</div>
<div class="hundred-percent top-line ">

	
		<? the_content();?>		
		
</div>

<div class="clear"></div>

<?php endwhile;   ?>





<?php get_footer(); ?>
