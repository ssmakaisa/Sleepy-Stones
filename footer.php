</div><!-- end contentBody -->
<?php if( !is_front_page() ): ?>
<footer>
	<section>
		<div class="hundred-percent top-line top-pad ">
			<div class="eighty-percent footerMobile">
				<p>&copy; The Idle Rocks Hotel <?=date("Y");?>. <a href="/cookies/">Cookies</a>. <a href="/terms-conditions/">Terms &amp; Conditions</a>.</p>
			</div>
			<div class="twenty-percent footerMobile">
				<p>Website by <a href="http://tribuscreative.com" target="_blank">Tribus</a>.</p>
			</div>
		</div>
		<div class="clear"></div>
	</section>
</footer>
<?php endif ?>
</div><!-- end content -->
</div><!-- end wrapper -->

<script  type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script  type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
var baseURL='<?php echo get_template_directory_uri(); ?>';
<? 
$scrollStop = get_field('scroll_stop');
if($scrollStop ==""){
	$scrollStop = 0;
} 
?>

<? if(get_field('sub_heading')==false){ ?>
var initialDisplayPercent = 50;
var hideTitle = false;
var percentStop = <?=$scrollStop;?>;
<?  } else { ?>
var initialDisplayPercent = 20;
var percentStop = 0;
var hideTitle = true;
<? } ?>
var slideshow_delay = <?=get_field('slideshow_delay',"option");?>;
var slideshow_transition_speed = <?=get_field('slideshow_transition_speed',"option");?>;
</script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/plugins.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/main.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/photo_wall.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/jquery.backstretch.min.js"></script>
<?php if( is_front_page() ): ?>
<?  $bigImage = get_field('top_slideshow');?>
<script>
    $(".fullheaderImage").backstretch("<?=$bigImage;?>");
</script>
<?php endif ?>
<? wp_footer(); ?>
</body>
</html>