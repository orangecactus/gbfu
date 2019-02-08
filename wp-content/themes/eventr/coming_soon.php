<?php 
/** Template Name: Coming Soon Template  */

get_header('coming_soon');
	while(have_posts()): the_post();           
		the_content();
    endwhile;
get_footer('coming_soon');