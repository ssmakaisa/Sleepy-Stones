<?php
/**
 * @package WordPress
 * @subpackage Idle Rocks
 */


?>
<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 	 ]>    <html class="ie" lang="en"> <![endif]-->

<html>
<head>
<script type="text/javascript" src="//use.typekit.net/krt1dro.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/redmond/jquery-ui.css" />
<link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">

<title><?php wp_title( '-', true, 'right' ); ?><?php  echo bloginfo( 'name' );?></title>
<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<? wp_head(); ?>
<? if($_SERVER['REQUEST_URI']=="/"){?>
<link rel="canonical" href="/" />
<? } ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41020086-1', 'idlerocks.com');
  ga('send', 'pageview');

</script>
</head>

<?
    $quoteText   = get_field("quote");
    $currentPost = get_post(get_the_ID());
    $subPage     = false;

    // this pertains to the 'Set as a sub page' option
    // on the post admin form. It has nothing to do with the
    // 'subPage' boolean variable above. The value here determines
    // whether the Instagram photo wall will be rendered or not.
    $isSubPage = get_post_meta(get_the_ID(), 'sub_heading', true);

    $detect    = new Mobile_Detect();
    $show_wall = ((!$detect->isMobile() || $detect->isIpad()) && !$isSubPage && !is_single() && !is_category() && !is_date());
	$mobile = ($detect->isMobile() && !$detect->isIpad());


    if($currentPost->post_type=="post" || is_archive())
    {
        $subPage  = true;
        $topImage = get_field("news_sub_page_image","options");
    }
?>

<body <?php if(isset($class)){   body_class($class); } ?>>
<a id="sub-menu-link"></a>
<? if($show_wall): ?>
	<div id="photo_wall">
  		<div id="photo_wall_photos">
    		<? echo do_shortcode('[alpine-phototile-for-instagram user="idlerocks" src="user_recent" imgl="fancybox" style="wall" row="6" size="M" num="36" shadow="1" align="center" max="100" nocredit="1"]'); ?>
  		</div>
  	</div>
  	<a href="#photo_wall" id="photo_wall_toggle">
    	<span class="handle"></span>
    	<span class="handle_text">Wish you were here?</span>
  	</a>
<? endif ?>

<? $topImage = get_field('top_image') ?> 

<div class="wrapper">

<div class="content">

  <div class="headerWrapper">

  <? if($currentPost->post_type=="post" || is_archive())
    {
        $subPage  = true;
        $topImage = get_field("news_sub_page_image","options");
    } ?>

  <? if(get_field("sub_heading")==true  || $subPage == true) { ?> 

  		<? if (!$mobile) { ?> 									   
    		<div class="headerImage">
      			<img src="<?=$topImage;?>" />
     		</div>
		<? } else { ?>
    		<div class="headerImage">
				<img src="<?php echo get_template_directory_uri(); ?>/images/idlerocks-mobile-header.jpg" alt="Idle Rocks logo" />
			</div>
		<? } ?>

  <? } else { ?>
  
  		<? if( !is_front_page() ) { ?>
      	
      		<div class="headerImageSlideshow">
		        <? if (!$mobile) { ?>
		        	<div class="headerImage">
	       				<? $bigImage = get_field('top_slideshow'); ?>
        				<img src="<?=$bigImage;?>" />
        				<div class="clear"></div>  			      
	    	    	</div>  
	    	    <? } else { ?>
	    	    	<div class="headerImage">
						<img src="<?php echo get_template_directory_uri(); ?>/images/idlerocks-mobile-header.jpg" />
						<div class="clear"></div>
					</div>
	    	    <? } ?>	    	      
	    	</div>
	    	
		<? } else { ?>	        
			<? if (!$mobile) { ?>
	        	<div class="fullheaderImage">
	        	</div>
	        <? } else { ?>
	        		<div class="headerImage">
						<img src="<?php echo get_template_directory_uri(); ?>/images/idlerocks-mobile-header.jpg" />
						<div class="clear"></div>
					</div>
			<? } ?>
   			<div class="navigation">
   				<div class="navigationWrapper navigationDesktop">
   					<?php wp_nav_menu( array('menu' => 'main' )); ?>
					<div class="clear"></div>
			    </div>
				<div class="navigationMobile">
					<div class="mobileButton">
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/mobile-button.png" width="60" height="38"></a>
					</div>
				</div>
			</div>		        
	   <? } ?>        
      	
  	
  <? } ?>
  	</div> <!-- end of headerWrapper -->

	<? if(!$mobile) { ?>   
 		<div class="logo">
    		<div class="logoWrapper">
      			<a href="/"> <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" width="194" height="113" alt="Idle Rocks logo" /></a>
      		</div>
    	</div>
	<? } ?>    
    	<? if( !is_front_page() ) { ?> 
   			<div class="navigation">
   				<div class="navigationWrapper navigationDesktop">
   					<?php wp_nav_menu( array('menu' => 'main' )); ?>
					<div class="clear"></div>
				</div>
				<div class="navigationMobile">
					<div class="mobileButton">
						<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/mobile-button.png" alt="Button that activates mobile menu" width="60" height="38"></a>
					</div>
				</div>
		<? } ?>
   </div>
   <div class="clear"></div>
	<div class="mobileMenu" >
    	<?php wp_nav_menu( array('menu' => 'main' )); ?>
	</div>
<div class="contentBody" >



