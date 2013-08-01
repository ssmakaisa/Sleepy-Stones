<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Grandvisual
 */

get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>

<h1>News</h1>
<div class="social-icons">
	<a href="http://twitter.com/theidlerocks" title="Follow us on twitter" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Link to our twitter profile" /></a>
	<a href="https://www.facebook.com/theidlerocks" title="Follow us on Facebook" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/fb.png" alt="Link to our Facebook profile" /></a>
</div>
<a href="#sub-menu" id="sub-menu-jump">Sub Menu &#8595;</a>
<div class="hundred-percent top-line ">



	<div class="twenty-percent right-margin mobileSwitch navigationDesktop"  id="col-subnav">


	<ul class="sub-menu">
<? wp_list_categories(array("title_li"=>""));?>
	</ul>
	
	</div>
	
		<div class="sixty-percent right-margin mobileSwitch main-content"  id="col-main">
		<h2><? the_title();?></h2>
		
		<? the_content(); ?>
		
		<p class="newsDate"><em>Posted on <?=date("l jS \of F Y",strtotime(get_the_date()));?></em></p>
		
		<div class="pageNav">
<?php
$next_post = get_previous_post();
if (!empty( $next_post )): ?>
<span class="prev">
  <a href="<?php echo get_permalink( $next_post->ID ); ?>">&#171; previous story</a>
</span>
  <?php endif; ?>
<?php
$next_post = get_next_post();
if (!empty( $next_post )): ?>
<span class="next">
  <a href="<?php echo get_permalink( $next_post->ID ); ?>">next story &#187;</a>
</span>
  <?php endif; ?>

</div>	

		</div>
		
		        <div class="twenty-percent mobileSwitch"  id="col-sidebar">
              		<div class="archives">
   			           	<h4>Archives</h4>
   			           	<ul>	
							<? wp_get_archives();?>
						</ul>
					</div>
				</div>
            </div>
            <div class="clear"></div>

<?php endwhile;   ?>

	<div class="mobileSwitch mobileShow">


	<ul class="sub-menu">
		<a id="sub-menu"></a>
			<h4>Sub Menu</h4>
			<a href="#sub-menu-link" id="sub-menu-jump2">Top &#8593;</a>			
<? wp_list_categories(array("title_li"=>""));?>
	</ul>
	
	</div>
<?php get_footer(); ?>