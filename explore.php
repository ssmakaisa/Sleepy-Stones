<?php

/**
 * Template Name: Explore Template
 * @package WordPress
 * @subpackage Idle Rocks
 */

get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>

<h1><?=getParentTitle(get_the_ID());?></h1>
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
               		<div id="w_special">
               			<!-- THIS IS WHERE THE SPECIAL GOES -->
               		</div> 
               	</div>
            </div>
<div class="hundred-percent top-line ">

	<div class="twenty-percent right-margin mobileSwitch navigationDesktop" id="col-subnav">
	<? $parentID = getParentID(get_the_ID()); 
	if($parentID){?>
	<ul class="sub-menu">
	<? foreach ( get_pages("child_of=".$parentID."&sort_column=menu_order") as $subpage) { ?>
		<li <? if ($subpage->ID==get_the_ID()) { ?> class="sub-selected"<? } ?> ><a href="<?=get_permalink($subpage->ID);?>"><?=$subpage->post_title;?></a></li>
	<? } ?>
	</ul>
	<? } ?>
	</div>

	<div class="sixty-percent right-margin mobileSwitch main-content" id="col-main">
	<h2><? the_title();?></h2>
		<? the_content();?>		
		<? if(get_the_ID()==115) { //events page?>
			<? $i=0;foreach (getEvents(15) as $event) { ?>
			<div class="hundred-percent right-margin eventListing">
			<a href="<?=get_permalink($event->ID);?>"><?=getImage("thumbnail",$event);?></a>
			<h3><a href="<?=get_permalink($event->ID);?>"><?=$event->post_title;?></a></h3>
				<p><em><span class="eventDate"><?=date("l jS \of F Y",strtotime(get_field("event_date",$event->ID)));?></span></em><br>
				<?=get_field("event_summary",$event->ID);?></p>
			</div>
			<div class="clear"></div>
			<?  } ?>
			<? 
			if(isset($_GET['older'])){
			$page = intval($_GET['older']);
			} else {
			$page = 0;
			}
			$pastEvents = getPastEvents($page);
			if( $pastEvents && count( $pastEvents) > 0){?>
			
			<hr />
			<h2>Past Events</h2>
			<? $i=0;
			
			foreach ($pastEvents as $event) { 
			if($i<10){ 
			?>
			<div class="hundred-percent right-margin eventListing">
			<a href="<?=get_permalink($event->ID);?>"><?=getImage("thumbnail",$event);?></a>
			<h3><a href="<?=get_permalink($event->ID);?>"><?=$event->post_title;?></a></h3>
				<p><em><span class="eventDate"><?=date("l jS \of F Y",strtotime(get_field("event_date",$event->ID)));?></span></em><br>
				<?=get_field("event_summary",$event->ID);?></p>
			</div>
			<div class="clear"></div>
			<? $i++;  } ?>
			<?  } ?>
			<?  } ?>
			<? if(count($pastEvents)>$i) { $page++; ?><a href="?older=<?=$page;?>">&lt;&lt; Older</a><? } ?>
		<? } ?>
	</div>
	
	<div class="twenty-percent mobileSwitch" id="col-sidebar">
	<div class="tideInfo">
	<h4>Today's Tides</h4>
    			<div id="frame">
					<ul id="buoy">
						<li></li>
					</ul>
					<ul id="water">
						<li id="water-back"></li>
						<li id="water-front"></li>
					</ul>
				</div>
		<div id="tideTimes">
		<? foreach (getTideTimes() as $entry) {?>
		<div class="tideEntry"><?=htmlspecialchars($entry);?>
        </div>	
		<? } ?>
		</div>
		<div class="clear"></div>
	</div>	
	
	<?=get_field("sidebar_text");?>

</div>
</div>

<div class="clear"></div>
	<a id="sub-menu"></a>
	<div class=" mobileSwitch mobileShow">
	<? $parentID = getParentID(get_the_ID()); 
	if($parentID){?>
	<h4>Sub Menu</h4>
			<a href="#sub-menu-link" id="sub-menu-jump2">Top &#8593;</a>		
	<ul class="sub-menu">
	<? foreach ( get_pages("child_of=".$parentID."&sort_column=menu_order") as $subpage) { ?>
		<li <? if ($subpage->ID==get_the_ID()) { ?> class="sub-selected"<? } ?> ><a href="<?=get_permalink($subpage->ID);?>"><?=$subpage->post_title;?></a></li>
	<? } ?>
	</ul>
	<? } ?>
	</div>
	
<?php endwhile;   ?>





<?php get_footer(); ?>
