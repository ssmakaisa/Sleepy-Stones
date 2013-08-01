<?php

/**
 * Template Name: news homepage Template
 * @package WordPress
 * @subpackage Idle Rocks
 */


get_header();

?>


<h1>News</h1>
<div class="social-icons">
	<a href="http://twitter.com/theidlerocks" title="Follow us on twitter" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt="Link to our twitter profile" /></a>
	<a href="https://www.facebook.com/theidlerocks" title="Follow us on Facebook" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/fb.png" alt="Link to our Facebook profile" /></a>
</div>
<a href="#sub-menu" id="sub-menu-jump">Sub Menu &#8595;</a>
<div class="hundred-percent top-line ">
	<div class="twenty-percent right-margin mobileSwitch navigationDesktop" id="col-subnav">
		<ul class="sub-menu">
			<? wp_list_categories(array("title_li"=>""));?>
		</ul>
	</div>
	
	<div class="sixty-percent right-margin mobileSwitch main-content" id="col-main">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
			<? if($archiveMode){ ?>
				<? if(get_query_var("cat") && !isset($shownCat)) {?>
					<h2><?=get_the_category_by_ID(get_query_var("cat")); $shownCat = true;?></h2>
				<? } ?>
				<? if(get_query_var("year") && !isset($shownCat)) {?>
					<h2><?=date("F",strtotime(get_query_var("year")."-".get_query_var("monthnum")."-1"));?> <?=get_query_var("year"); $shownCat = true;?></h2>
				<? } ?>
				
				<div class="newsItem">
					<div class="newsContent">
						<h3><a href="<?=get_permalink();?>"><? the_title();?></a></h3>
						<p class="newsDate">Posted on <?=date("l jS \of F Y",strtotime(get_the_date()));?></p>
						<? the_excerpt();?>
					</div>
				</div>
			<? } ?>
		<?php endwhile; ?>
		
		<? if(!$archiveMode){?>
			<h2>All News</h2>
		<?php 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts('posts_per_page=10&paged=' . $paged); 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>          
        	<div class="newsItem">
				<div class="newsContent">
					<h3><a href="<?=get_permalink();?>"><?=get_the_title();?></a></h3>
					<p class="newsDate"><em>Posted on <?=date("l jS \of F Y",strtotime(get_the_date()));?></em></p>
					<? the_excerpt();?>
				</div>
			</div>          
        	<? endwhile; ?>
            
        	<div class="pagination">
				<span class="prevLink"><?php next_posts_link('&laquo; older stories') ?></span>
           		<span class="nextLink"><?php previous_posts_link('newer stories &raquo;') ?></span>
			</div>            
    	<?php endif; ?>
    	<? } ?>
	</div>
	
	<div class="twenty-percent mobileSwitch" id="col-sidebar">
    	<div class="archives">
   			<h4>Archives</h4>
   			<ul><? wp_get_archives();?></ul>
		</div>
    </div>
    <div class="clear"></div>

	<div class="mobileSwitch mobileShow">
		<ul class="sub-menu">
			<a id="sub-menu"></a>
			<h4>Sub Menu</h4>
			<a href="#sub-menu-link" id="sub-menu-jump2">Top &#8593;</a>
			<? wp_list_categories(array("title_li"=>""));?>
		</ul>	
	</div>
</div>
<?php get_footer(); ?>
