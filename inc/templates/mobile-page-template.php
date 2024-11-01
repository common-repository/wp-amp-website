<?php
global $post;
/**********************************************
	Header Part
**********************************************/
$WpAmpWebFrontPage->wpampweb_mob_header();

/**********************************************
	Content Part
**********************************************/
if ( have_posts() ) : 
    while ( have_posts() ) : the_post(); 
$maincontent = get_post_meta($post->ID,'_wpampweb_mobile_content',true) ? do_shortcode(get_post_meta($post->ID,'_wpampweb_mobile_content',true)) : '';

if($maincontent=='')
{
	$maincontent = strip_tags(get_the_content(),'<p><a><strong><br><span><i><ul><li><pre><code>');
	
}

echo '<div class="title-bar"><h1>'.get_the_title().'</h1></div>';

// filter shortcode if not working
echo '<div class="my-5 content">'.$maincontent.'</div>'; 
    endwhile; 
endif; 
posts_nav_link();

/**********************************************
	Footer Part
**********************************************/
$WpAmpWebFrontPage->wpampweb_mob_footer();
