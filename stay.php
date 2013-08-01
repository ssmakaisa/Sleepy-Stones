<?php

/**
 * Template Name: Stay homepage Template
 * @package WordPress
 * @subpackage Idle Rocks
 */

get_header();

if(sanitize_key($_GET['action'])=="go"){
	$roomDetails = searchAccommodation(sanitize_key($_GET['fromDate']),sanitize_key($_GET['toDate']));
}
?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
	<h1>Stay</h1>
		<div id="date-widget"> 
			<form method="GET" id="availabilityForm">
				<p><span class="widget-title">Your days by the sea:</span>
				<span class="loading"><img src="<?php echo get_template_directory_uri(); ?>/images/loading1.gif" height="16" width="16" class="loadingIcon" /></span>
				<input id="fromDate" placeholder="Arrive" type="text" readonly="true" name="fromDate" class="datePicker" value="<?=sanitize_key($_GET['fromDate']);?>">
				<input id="toDate" placeholder="Leave" type="text" readonly="true" name="toDate" class="datePicker" value="<?=sanitize_key($_GET['toDate']);?>">
				<input type="submit" value="check" >
				<input type="hidden" value="go" name="action" /></p>
			</form>
		</div>
		<div class="clear"></div>
	<div class="hundred-percent top-line"></div>	
		<? $i=0;foreach (get_posts("post_type=accommodation&sort_column=menu_order") as $subpage) { ?>
		<div class="accomodation-entry<? if ($i % 2 == 0) {?>-margin<?}?> mobileSwitch">
			<div class="accomodation-summary">
				<h3><a class="accomodation-link-<?=get_field("custom_code",$subpage->ID);?>" data-link="<?=get_permalink($subpage->ID);?>?action=go" href="<?=get_permalink($subpage->ID);?><? if(sanitize_key($_GET['action'])=="go"){?>?fromDate=<?=sanitize_key($_GET['fromDate']);?>&toDate=<?=sanitize_key($_GET['toDate']);?><?}?>"><?=$subpage->post_title;?></a></h3>
				<p class="description"><?=get_field("summary",$subpage->ID);?></p>
				<? if($roomDetails){
					if(isset($roomDetails[get_field("custom_code",$subpage->ID)])){ ?>
						<p class="rate-check room-available" id="rate-<?=get_field("custom_code",$subpage->ID);?>"><?=$roomDetails[get_field("custom_code",$subpage->ID)]['available'];?> room(s) available, total cost &pound;<?=$roomDetails[get_field("custom_code",$subpage->ID)]['total'];?></p>
					<? } else { ?>
						<p class="rate-check room-unavailable" id="rate-<?=get_field("custom_code",$subpage->ID);?>">No rooms available on these dates</p>
					<? } ?>
				<? } else { ?>
					<p class="rate-check" data-key="<?=get_field("custom_code",$subpage->ID);?>" id="rate-<?=get_field("custom_code",$subpage->ID);?>">From &pound;<?=get_field("from_price",$subpage->ID);?> per night</p>
				<? } ?>
				<div class="booking-proceed" id="proceed-<?=get_field("custom_code",$subpage->ID);?>">
					<a class="accomodation-link-<?=get_field("custom_code",$subpage->ID);?>" data-link="<?=get_permalink($subpage->ID);?>?action=go" href="<?=get_permalink($subpage->ID);?><? if(sanitize_key($_GET['action'])=="go"){?>?fromDate=<?=sanitize_key($_GET['fromDate']);?>&toDate=<?=sanitize_key($_GET['toDate']);?><?}?>">See details and book &#8594;</a>
				</div>
			</div>
			<div class="accomodation-image">
				<a class="accomodation-link-<?=get_field("custom_code",$subpage->ID);?>" data-link="<?=get_permalink($subpage->ID);?>" href="<?=get_permalink($subpage->ID);?><? if(sanitize_key($_GET['action'])=="go"){?>?fromDate=<?=sanitize_key($_GET['fromDate']);?>&toDate=<?=sanitize_key($_GET['toDate']);?><?}?>"><?=getImage("thumbnail",$subpage);?></a>
			</div>
			<div class="clear mobileShow"></div>
		</div>
		<div class="clear mobileShow"></div>
		<? $i++;} ?>

		<div class="accomodation-entry<? if ($i % 2 == 0) {?>-margin<?}?> mobileSwitch end-block">
			<?=get_field("end_block_text");?>
		</div>

	
	
<div class="clear"></div>

<?php endwhile;   ?>





<?php get_footer(); ?>
