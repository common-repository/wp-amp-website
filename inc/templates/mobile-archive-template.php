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
    
    the_archive_title( '<h1 class="top-heading page-title text-center">', '</h1>' );
	the_archive_description( '<div class="taxonomy-description">', '</div>' );
    
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
