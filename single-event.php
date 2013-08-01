<?php

/**
 * Template Name: single event Template
 * @package WordPress
 * @subpackage Idle Rocks
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>

<h1>Explore</h1>
<a href="#sub-menu" id="sub-menu-jump">Sub Menu &#8595;</a>
			<div class="hero-unit">
                <!--<h4>Today's Weather</h4>                -->
               	<div id="weather-container"> 
               		<div id="w_iconimage">
               			<!-- THIS IS WHERE THE ICON GOES -->
               		</div>
               		<div id="w_temp">
               			<!-- THIS IS WHERE THE TEMP GOES -->
               		</div>               		
               		<div id="w_summary">
               			<!-- THIS IS WHERE THE SUMMARY GOES -->
               		</div>
               		<!--<div id="w_special">
               			 THIS IS WHERE THE SPECIAL GOES
               		</div> -->
               	</div>
            </div>

<div class="hundred-percent top-line ">

	<div class="twenty-percent right-margin mobileSwitch navigationDesktop" id="col-subnav">
	<ul class="sub-menu">
	<? foreach ( get_pages("child_of=103&sort_column=menu_order") as $subpage) { ?>
		<li <? if ($subpage->ID==115) { ?> class="sub-selected"<? } ?> ><a href="<?=get_permalink($subpage->ID);?>"><?=$subpage->post_title;?></a></li>
	<? } ?>
	</ul>
	</div>

	<div class="sixty-percent event right-margin mobileSwitch" id="col-main">
		<h2><? the_title();?></h2>		
		<?=get_field("event_description");?>
		<p>When: <em><span class="eventDate"><?=date("l jS \of F Y",strtotime(get_field("event_date")));?></span></em><br>
		Where: <em><?=get_field('location');?></em></p>
		<div class="eventBackLink">
		<a href="/explore/events/">&lt;&lt; More Events</a>
		</div>
	</div>
	
	<div class="twenty-percent mobileSwitch" id="col-sidebar">

<iframe height="100%" width="100%" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=<?=urlencode(get_field('postcode'));?>&z=15&iwloc=near&output=embed"></iframe>	
</div>
</div>

<div class="clear"></div>
	<a id="sub-menu"></a>
	<div class=" mobileSwitch mobileShow">

	<h4>Sub Menu</h4>	
				<a href="#sub-menu-link" id="sub-menu-jump2">Top &#8593;</a>
	<ul class="sub-menu">
	<? foreach ( get_pages("child_of=103&sort_column=menu_order") as $subpage) { ?>
		<li <? if ($subpage->ID==115) { ?> class="sub-selected"<? } ?> ><a href="<?=get_permalink($subpage->ID);?>"><?=$subpage->post_title;?></a></li>
	<? } ?>
	</ul>
	</div>
<?php endwhile;   ?>





<?php get_footer(); ?>
