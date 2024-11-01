<?php
/**
 * Define mobile site class
 * @only_for_front_end
 * @wordpress_hooks
 *
 **/
if(!class_exists('WpAmpWebWebsiteFrontend')):
class WpAmpWebWebsiteFrontend
{
	/**
     * Start up
     */
    public function __construct()
    {
		//call mobile template
		add_filter( 'template_include', array(&$this,'wpampweb_mobile_template_func' ));
		//add shortcode plugin url
		add_shortcode( 'm_base_url', array($this,'wpampweb_m_base_func' ));
		// add ?amp in AMP page URL
		add_action( 'wp_head', array($this,'wpampweb_amp_head_func' ));
		
    }
    /**
	 * @function 
	 * wpampweb_amp_head_func to add ?amp in AMP pages url.
	 * @Hooks
	 * 
	 * */
	 function wpampweb_amp_head_func()
	 {
		 global $post,$wp;
		 $suffixamp = empty(get_option('permalink_structure')) ? add_query_arg( $wp->query_vars, home_url( $wp->request ) ).'&amp' : home_url( $wp->request ).'?amp';
		 
		 if(isset($post))
		 {
		     $amp_for_home = get_option('wpampweb_m_homeamp') ? get_option('wpampweb_m_homeamp') : 0;
		     $amp_for_archive = get_option('wpampweb_m_archiveamp') ? get_option('wpampweb_m_archiveamp') : 0;
			 $haveMobileVer = get_post_meta($post->ID,'_wpampweb_mobile_mobile_version',true); // has mobile version or not	
			 if(!isset($_REQUEST['amp']) && $haveMobileVer && is_singular($post->post_tpe))
			 {
			 //$metaCanonical = get_permalink($post->ID);
			 echo '<link rel="amphtml" href="'.$suffixamp.'">';
		     }
		     // amp for blog page
		     if(!isset($_REQUEST['amp']) && $amp_for_home && is_home()){
		         //$blogurl = !empty(get_option( 'page_for_posts' )) ? (get_permalink(get_option( 'page_for_posts' ))) : ( home_url( '/' ) );
		         echo '<link rel="amphtml" href="'.$suffixamp.'">';
		     }
		     // amp for archive page
		     if(!isset($_REQUEST['amp']) && $amp_for_archive && is_archive()){
		        
		         //$archiveurl = empty(get_option('permalink_structure')) ? add_query_arg( $wp->query_vars, home_url( $wp->request ) ) : home_url( $wp->request );
		         echo '<link rel="amphtml" href="'.$suffixamp.'">';
		     }
	      }
		 
		 }
     /**
	 * Shortcode [m_base_url]
	 * @Hooks
	 * @return mobile base url
	 * */
	 function wpampweb_m_base_func($attr)
	 {
		 return get_template_directory_uri().'/mobile-site/';
		 
		 }
	/**
	 * Function set template for mobile devices
	 * @Hooks
	 * 
	 * */
	public function wpampweb_mobile_template_func( $template ) {
			 global $post;
			 require_once dirname(__FILE__).'/waw-m_detect.php'; // include library file
			 $detect = new WawMobileDetect;
			 $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
			 $amp_for_home = get_option('wpampweb_m_homeamp') ? get_option('wpampweb_m_homeamp') : 0;
		     $amp_for_archive = get_option('wpampweb_m_archiveamp') ? get_option('wpampweb_m_archiveamp') : 0;
			 if(isset($post) && ($deviceType == 'phone' || isset($_REQUEST['amp']))):
			     
			     if (is_singular($post->post_tpe)){
				 $mobileContent = get_post_meta($post->ID,'_wpampweb_mobile_content',true) ? get_post_meta($post->ID,'_wpampweb_mobile_content',true) : ''; // mobile content
				 $haveMobileVer = get_post_meta($post->ID,'_wpampweb_mobile_mobile_version',true) ? get_post_meta($post->ID,'_wpampweb_mobile_mobile_version',true) : 0; // has mobile version or not
		
				  if ($haveMobileVer) {
					$new_template = dirname( __FILE__ ) . '/templates/mobile-page-template.php';
					if ( '' != $new_template )
					    return $new_template;
					}
			     }
					
			// amp template for blog page
		     if($amp_for_home && is_home()){
		           $new_template = dirname( __FILE__ ) . '/templates/mobile-home-template.php';
					if ( '' != $new_template )
					    return $new_template;
					}
		     // amp template for archive page
		     if($amp_for_archive && is_archive()){
		           $new_template = dirname( __FILE__ ) . '/templates/mobile-archive-template.php';
					if ( '' != $new_template )
					    return $new_template;
					}
					
					
					
					
					
			 endif;
		return $template;
	   }
/*
 * HEADER
 * */	 
 public function wpampweb_mob_header()
 {
	 include_once(dirname( __FILE__ ) . '/templates/header.php');
	 
	 }  
/*
 * Footer
 * */	 
 public function wpampweb_mob_footer()
 {
	 include_once(dirname( __FILE__ ) . '/templates/footer.php');
	 
	 }  

}
endif;// End class VeMobileSiteFrontend;

//initilsize mobile site class only for admin section
$enable = get_option('wpampweb_m_enable') ? get_option('wpampweb_m_enable') : 0;

if( !is_admin() && $enable)
    $WpAmpWebFrontPage = new WpAmpWebWebsiteFrontend();


