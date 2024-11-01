<?php
global $post;
/**********************************************
	Header Part
**********************************************/
$WpAmpWebFrontPage->wpampweb_mob_header();

/**********************************************
	Content Part
**********************************************/
echo '<div class="top-heading text-center"><h1>'.( get_option( 'page_for_posts' ) ? get_the_title(get_option( 'page_for_posts' )) : get_bloginfo('name')).'</h1></div>';

if ( have_posts() ) : 
    echo '<div class="loop-container">';
    while ( have_posts() ) : the_post(); 
    echo '<div class="post-loop shadow">';
        $maincontent = get_post_meta($post->ID,'_wpampweb_mobile_content',true) ? do_shortcode(get_post_meta($post->ID,'_wpampweb_mobile_content',true)) : '';

if($maincontent=='')
{
	$maincontent = strip_tags(get_the_excerpt(),'<p><a><strong><br><span><i><ul><li><pre><code>');
	
}
// filter shortcode if not working
echo '<div class="my-5 content"><h2><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>'.$maincontent.'</div>';
echo '</div>';
    endwhile; 
echo '</div>';
endif; 
the_posts_pagination( array(
    'screen_reader_text' => ' ',
    'mid_size'  => 2,
) );

/**********************************************
	Footer Part
**********************************************/
$WpAmpWebFrontPage->wpampweb_mob_footer();
