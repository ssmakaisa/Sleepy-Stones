<?php

/**
 * @package WordPress
 * @subpackage Idle Rocks
 */

get_header();

?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post();  ?>
<div class="fifty-percent">
<? the_content();?>
</div>
<div class="clear"></div>
<div class="eighty-percent top-line right-margin top-pad">
<div class="fifty-percent">
<h3>News</h3>
	<a href="#">The Idle Rocks opens its doors to the public</a><br>
	<a href="#">New summer menu starts on June 12</a><br>
	<a href="#">Special offers on mid-week breaks</a><br>
</div>

<div class="fifty-percent">
<h3>Events</h3>
	<a href="#">21/09/13 - Event TItle 1</a><br>
	<a href="#">12/10/13 - Event Title 2</a><br>
	<a href="#">06/11/13 - Event Title 3</a><br>
</div>
<div class="clear"></div>

</div> 
<div class="twenty-percent top-pad">
<h3>RESTAURANT</h3>
<p>To reserve a table call: <?=get_field('phone_number', 'option');?> or email: <a href="mailto:<?=get_field('email_address', 'option');?>"><?=get_field('email_address', 'option');?></a></p>
</div>
<?php endwhile;   ?>





<?php get_footer(); ?>
