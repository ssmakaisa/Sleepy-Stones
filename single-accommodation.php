<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Grandvisual
 */

get_header();

if(isset($_GET['check_in_date'])){
	$fromDateArray = explode("/",$_GET['check_in_date']);
	$toDateArray = explode("/",$_GET['check_out_date']);
	$roomDetails = searchAccommodation($fromDateArray[2]."-".$fromDateArray[1]."-".$fromDateArray[0],$toDateArray[2]."-".$toDateArray[1]."-".$toDateArray[0]); }
?>

	<? $allRooms = get_posts("post_type=accommodation&sort_column=menu_order");
		$i=1;foreach ($allRooms as $key=>$subpage) {
		if($subpage->ID == get_the_ID()) {
			$currentIndex = $i;
			if($key==0){
				//first page
				$prevPage = get_permalink($allRooms[count($allRooms)-1]->ID);
			} else {
				$prevPage = get_permalink($allRooms[$key-1]->ID);
			}
			if($key==count($allRooms)-1){
				//last page
				$nextPage = get_permalink($allRooms[0]->ID);
			} else {
				$nextPage = get_permalink($allRooms[$key+1]->ID);
			}

		}

		$i++; } ?>
		
		<? 	
			$detect    = new Mobile_Detect();
			$mobile = ($detect->isMobile() && !$detect->isIpad());
		?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
	<h1>Stay</h1>		
		<div id="date-widget">
		<form method="GET" id="availabilityForm">
			<p><span class="widget-title">Your days by the sea:</span>
			<span class="loading"><img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" class="loadingIcon" /></span>
			<input id="fromDate" placeholder="Arrive" type="text" readonly="true" value="<?=htmlentities($_GET['check_in_date']);?>" name="fromDate" class="datePicker">
			<input id="toDate" placeholder="Leave" type="text" readonly="true" name="toDate" value="<?=htmlentities($_GET['check_out_date']);?>" class="datePicker">
			<input type="submit" value="check" >
			<input type="hidden" value="go" name="action" />
		</form>
		</div>
		<div class="clear"></div>
	<div class="hundred-percent top-line">
		<h2><? the_title();?></h2>
	<? if(!$mobile) { ?> 	
		<div class="fifty-percent accomodation-pictures mobileSwitch">
			<? $gallery  = get_field("gallery");
			if($gallery!=""){?>
				<div class="accommodation-gallery">
					<? foreach ($gallery as $item) { ?>
						<div>
							<a href="<?=$item['sizes']['room-large'];?>" rel="gallery" class="lightbox"><img src="<?=$item['sizes']['room-thumb'];?>"  data-retina="<?=$item['sizes']['room-large'];?>" /></a> <!--  width="<?=$item['sizes']['room-thumb-width'];?>" height="<?=$item['sizes']['room-thumb-height'];?>" -->
							<div class="clear"></div>
						</div>
					<? } ?>
				</div>
			<? } ?>
			<div class="clear"></div>
		</div>
	<? } ?>
	<div class="fifty-percent accomodation-details mobileSwitch">
		<h4 style="text-transform:title;"><a id=prevPage data-original="<?=$prevPage;?>" href="<?=$prevPage;?><? if(htmlentities($_GET['check_in_date'])!=""){?>?check_in_date=<?=htmlentities($_GET['check_in_date']);?>&check_out_date=<?=htmlentities($_GET['check_out_date']);?><?}?>">&#8592; </a> Change room view (<?=$currentIndex;?> <span style="text-transform:lowercase;">of</span> <?=count($allRooms);?>) <a id=nextPage data-original="<?=$nextPage;?>" href="<?=$nextPage;?><? if(htmlentities($_GET['check_in_date'])!=""){?>?check_in_date=<?=htmlentities($_GET['check_in_date']);?>&check_out_date=<?=htmlentities($_GET['check_out_date']);?><?}?>"> &#8594;</a></h4>
		


		<? if($roomDetails) {
			if(isset($roomDetails[get_field("custom_code")])){?>
				<p class="rate-check room-available" id="rate-<?=get_field("custom_code");?>"><?=$roomDetails[get_field("custom_code")]['available'];?> rooms to choose, &pound;<?=$roomDetails[get_field("custom_code")]['total'];?> per room for the duration of your stay.</p>
			<? } else { $noRooms = true; ?>
				<p class="rate-check room-unavailable" id="rate-<?=get_field("custom_code");?>">No rooms available on these dates</p>
			<? }
		}  else { ?>
			<p class="rate-check" id="rate-<?=get_field("custom_code");?>">From &pound;<?=get_field("from_price");?> per night</p>
		<? }?>	

		<? if($roomDetails) {
			if(isset($roomDetails[get_field("custom_code")])){?>
				<div class="booking-proceed proceed-show"><a href="<?php echo get_template_directory_uri(); ?>/book.php?id=<?=get_field("custom_code");?>&check_in_date=<?=htmlentities($_GET['check_in_date']);?>&check_out_date=<?=htmlentities($_GET['check_out_date']);?>"  data-link="<?php echo get_template_directory_uri(); ?>/book.php?id=<?=get_field("custom_code");?>" class="accomodation-link-<?=get_field("custom_code");?>" target="_blank">Proceed with booking &#8594;</a>
			<? } else { ?>
				<div class="booking-proceed" id="proceed-<?=get_field("custom_code");?>"><a href="<?php echo get_template_directory_uri(); ?>/book.php?id=<?=get_field("custom_code");?>"  data-link="<?php echo get_template_directory_uri(); ?>/book.php?id=<?=get_field("custom_code");?>" class="accomodation-link-<?=get_field("custom_code");?>" target="_blank">Proceed with booking &#8594;</a></div>
			<? } 
		} else { ?>
			<div class="booking-proceed" id="proceed-<?=get_field("custom_code");?>"><a href="<?php echo get_template_directory_uri(); ?>/book.php?id=<?=get_field("custom_code");?>"  data-link="<?php echo get_template_directory_uri(); ?>/book.php?id=<?=get_field("custom_code");?>" class="accomodation-link-<?=get_field("custom_code");?>" target="_blank">Proceed with booking &#8594;</a>
		<? } ?>
		
		
		 
	</div>
	<div style="margin-top:2em;"><?=get_field("description");?></div>
</div>

<div class="clear">
</div> 


	<? if($mobile) { ?> 	
		<div class="fifty-percent accomodation-pictures mobileSwitch">
			<? $gallery  = get_field("gallery");
			if($gallery!=""){?>
				<div class="accommodation-gallery">
					<? foreach ($gallery as $item) { ?>
						<div>
							<img src="<?=$item['sizes']['room-thumb'];?>" class="slides" data-retina="<?=$item['sizes']['room-large'];?>" />  <!-- width="<?=$item['sizes']['room-thumb-width'];?>" height="<?=$item['sizes']['room-thumb-height'];?>"  -->
							<div class="clear"></div>
						</div>
					<? } ?>
				</div>
			<? } ?>
		</div>
	<? } ?>

<div class="clear">
<?php endwhile;   ?>
</div><?php if(!$noRooms) {?></div> <?php } ?>
<?php get_footer(); ?>