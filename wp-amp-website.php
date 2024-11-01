<?php
/*
Plugin Name: WP AMP Website
Description: Create AMP pages while writing less JavaScript/CSS. 
Author: WP-EXPERTS.IN Team
Author URI: http://www.wp-experts.in
Version: 1.5
License GPL2
Copyright 2019-2021  WP.Experts.In  (email:raghunath.0087@gmail.com)

This program is free software; you can redistribute it andor modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*  Create new option page for theme */
add_action('admin_menu', 'wpampweb_register_ref_page');

/**
 * Adds a submenu page under top admin menu bar
 */
if(!function_exists('toolbar_link_to_waw')):	
		function toolbar_link_to_waw( $wp_admin_bar ) {
			$args = array(
				'id'    => 'waw_menu_bar',
				'title' => 'WP AMP Site',
				'href'  => admin_url('themes.php?page=wpampweb-options'),
				'meta'  => array( 'class' => 'waw-toolbar-page' )
			);
			$wp_admin_bar->add_node( $args );
			//second lavel
			$wp_admin_bar->add_node( array(
				'id'    => 'waw-second-sub-item',
				'parent' => 'waw_menu_bar',
				'title' => 'Settings',
				'href'  => admin_url('themes.php?page=wpampweb-options'),
				'meta'  => array(
					'title' => __('Settings'),
					'target' => '_self',
					'class' => 'waw_menu_item_class'
				),
			));
		}
endif;

/**
	*  add Plugin Settings Links
	*/
add_filter( "plugin_action_links_".plugin_basename( __FILE__ ), 'waw_add_settings_link');
if(!function_exists('waw_add_settings_link')):
 function waw_add_settings_link( $links ) 
    {
            $settings_link = '<a href="themes.php?page=wpampweb-options">' . __( 'Settings', 'wpexpertsin' ) . '</a>';
            array_unshift( $links, $settings_link );
            return $links;
   }
 endif;
/**
 * Adds a submenu page under a custom post type parent.
 */
if(!function_exists('wpampweb_register_ref_page')):
function wpampweb_register_ref_page() {
    add_submenu_page(
        'themes.php',
        __( 'AMP Website', 'wpexpertsin' ),
        __( 'AMP Website', 'wpexpertsin' ),
        'manage_options',
        'wpampweb-options',
        'wpampweb_ref_page_callback'
    );
}
endif;
/** Define Action for register Options */
add_action('admin_init','wpampweb_register_settings_init');
if(!function_exists('wpampweb_register_settings_init')):
	function wpampweb_register_settings_init(){
	 register_setting('wpampweb_options','wpampweb_m_copyright');
	 register_setting('wpampweb_options','wpampweb_m_head'); 
	 register_setting('wpampweb_options','wpampweb_m_header'); 	 
	 register_setting('wpampweb_options','wpampweb_m_footer'); 	 
	 register_setting('wpampweb_options','wpampweb_m_post_type');
	 register_setting('wpampweb_options','wpampweb_m_logo');
	 register_setting('wpampweb_options','wpampweb_m_favicon');
	 register_setting('wpampweb_options','wpampweb_m_enable');
	 register_setting('wpampweb_options','wpampweb_m_homeamp');
	 register_setting('wpampweb_options','wpampweb_m_archiveamp');
	 register_setting('wpampweb_options','wpampweb_m_title');
	 register_setting('wpampweb_options','wpampweb_m_keywords');
	 register_setting('wpampweb_options','wpampweb_m_description');
	 register_setting('wpampweb_options','wpampweb_m_canonical');
	}
endif;

/**
 * Display callback for the submenu page.
 */
if(!function_exists('wpampweb_ref_page_callback')):
function wpampweb_ref_page_callback() {
	  if ( !current_user_can( 'manage_options' ) )  {
        wp_die( 'You do not have sufficient permissions to access this page.' );
        }
	// get register all post type 
	$post_types = $customType = get_post_types(array('public' => true,'_builtin' => false),'names','and'); 
	array_push($post_types,'post');array_push($post_types,'page');
    ?>
    
    <div class="wrap">
    <h2><?php _e( 'WP AMP Website Settings', 'wpexpertsin' ); ?></h2>
	<div id="waw-tab-menu"><a id="waw-general" class="waw-tab-links active" >General</a> <a  id="waw-support" class="waw-tab-links">Support</a> <a  id="waw-other" class="waw-tab-links">Our Other Plugins</a></div>
    <form method="post" action="options.php" id="waw-option-form"> 
        <div class="waw-setting">
			<!-- General Setting -->	
			<div class="first waw-tab" id="div-waw-general">
				<h2>General Settings </h2>
	            <i>Given below settings will apply only on mobile pages</i>
				<hr>
				<p>
				<input type="checkbox" name="wpampweb_m_enable" id="wpampweb_m_enable" value="1" <?php checked(get_option('wpampweb_m_enable'),1);?>> Enable
				</p>
				<p>Enable AMP section on custom post type: <br>
				<select name="wpampweb_m_post_type[]" id="wpampweb_m_post_type" multiple>
				<option value="">None</option>
				<?php 
				$selectedTypesidebar= get_option('wpampweb_m_post_type') ? get_option('wpampweb_m_post_type') : array('page');  
				$post_types = array('page' => 'page','post'=>'post');
				$args = array('public'   => true,'_builtin' => false);
				$all_post_types = get_post_types( $args, 'names', 'and' ); 
				$post_types = array_merge($post_types,$all_post_types);
				foreach ( $post_types  as $post_type ) {
					echo '<option value="'.$post_type.'" '.selected(in_array($post_type, $selectedTypesidebar)).'>'.str_replace('_',' ',$post_type).'</option>';
				}
				?>
				</select></p>
				<p>Logo Path <br> <input name="wpampweb_m_logo" id="wpampweb_m_logo" size="60" value="<?php echo get_option('wpampweb_m_logo'); ?>"></p>
				<p>Favicon Path <br> <input name="wpampweb_m_favicon" id="wpampweb_m_favicon" size="60" value="<?php echo get_option('wpampweb_m_favicon'); ?>"></p>
				<p>Mobile Head<br> <textarea name="wpampweb_m_head" id="wpampweb_m_head" rows="10" cols="80"><?php echo get_option('wpampweb_m_head'); ?></textarea><br><i>(Content will display between &lt;head&gt;&lt;/head&gt; tag)</i></p>
				<p>Mobile Header<br> <textarea name="wpampweb_m_header" id="wpampweb_m_header" rows="10" cols="80"><?php echo get_option('wpampweb_m_header'); ?></textarea></p>
				<p>Mobile Footer<br> <textarea name="wpampweb_m_footer" id="wpampweb_m_footer" rows="10" cols="80"><?php echo get_option('wpampweb_m_footer'); ?></textarea></p>
				<p><input type="checkbox" name="wpampweb_m_homeamp" id="wpampweb_m_homeamp" value="1" <?php checked(get_option('wpampweb_m_homeamp'),1); ?> /> Enable AMP for Blog Page</p>
				<p><input type="checkbox" name="wpampweb_m_archiveamp" id="wpampweb_m_archiveamp" value="1" <?php checked(get_option('wpampweb_m_archiveamp'),1); ?> /> Enable AMP for Archive</p>

				<p>Copyright Message<br> <textarea name="wpampweb_m_copyright" id="wpampweb_m_copyright" rows="10" cols="80"><?php echo get_option('wpampweb_m_copyright'); ?></textarea></p>
				<hr>
				<h3>SEO Meta Keys</h3>
				<p>Meta Title Key:<br><input name="wpampweb_m_title" id="wpampweb_m_title" size="60" value="<?php echo get_option('wpampweb_m_title'); ?>"></p>
				<p>Meta Keywords Key:<br><input name="wpampweb_m_keywords" id="wpampweb_m_keywords" size="60" value="<?php echo get_option('wpampweb_m_keywords'); ?>"></p>
				<p>Meta Description Key:<br><input name="wpampweb_m_description" id="wpampweb_m_description" size="60" value="<?php echo get_option('wpampweb_m_description'); ?>"></p>
				<p>Meta Canonical Key:<br><input name="wpampweb_m_canonical" id="wpampweb_m_canonical" size="60" value="<?php echo get_option('wpampweb_m_canonical'); ?>"></p>
				<p><span class="submit-btn"><?php echo get_submit_button('Save Settings','button-primary','submit','','');?></span>
                <?php settings_fields('wpampweb_options'); ?></p>
			</div>
			<div class="waw-tab" id="div-waw-support"> <h2>Support</h2> 
				<p><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=ZEMSYQUZRUK6A" target="_blank" style="font-size: 17px; font-weight: bold;"><img src="<?php echo  plugins_url( 'images/btn_donate_LG.gif' , __FILE__ );?>" title="Donate for this plugin"></a></p>
				<p><strong>Plugin Author:</strong><br><a href="https://www.wp-experts.in/contact-us" target="_blank">WP Experts Team</a></p>
				<p><a href="mailto:raghunath.0087@gmail.com" target="_blank" class="contact-author">Contact Author</a></p>
			</div>
			<div class="last waw-tab" id="div-waw-other">
				<h2>Our Other plugins</h2>
                 <p>
				  <ol>
					<li><a href="https://wordpress.org/plugins/custom-share-buttons-with-floating-sidebar" target="_blank">Custom Share Buttons With Floating Sidebar</a></li>
							<li><a href="https://wordpress.org/plugins/protect-wp-admin/" target="_blank">Protect WP-Admin</a></li>
							<li><a href="https://wordpress.org/plugins/wc-sales-count-manager/" target="_blank">WooCommerce Sales Count Manager</a></li>
							<li><a href="https://wordpress.org/plugins/wp-protect-content/" target="_blank">WP Protect Content</a></li>
							<li><a href="https://wordpress.org/plugins/wp-categories-widget/" target="_blank">WP Categories Widget</a></li>
							<li><a href="https://wordpress.org/plugins/wp-importer" target="_blank">WP Importer</a></li>
							<li><a href="https://wordpress.org/plugins/wp-youtube-gallery/" target="_blank">WP Youtube Gallery</a></li>
							<li><a href="https://wordpress.org/plugins/wp-amp-website/" target="_blank">WP AMP Website</a></li>
							<li><a href="https://wordpress.org/plugins/wp-social-buttons/" target="_blank">WP Social Buttons</a></li>
							<li><a href="https://wordpress.org/plugins/seo-manager/" target="_blank">SEO Manager</a></li>
							<li><a href="https://wordpress.org/plugins/otp-login/" target="_blank">OTP Login</a></li>
							<li><a href="https://wordpress.org/plugins/wp-version-remover/" target="_blank">WP Version Remover</a></li>
							<li><a href="https://wordpress.org/plugins/wp-tracking-manager/" target="_blank">WP Tracking Manager</a></li>
							<li><a href="https://wordpress.org/plugins/wp-posts-widget/" target="_blank">WP Post Widget</a></li>
							<li><a href="https://wordpress.org/plugins/optimize-wp-website/" target="_blank">Optimize WP Website</a></li>
							<li><a href="https://wordpress.org/plugins/wp-testimonial/" target="_blank">WP Testimonial</a></li>
							<li><a href="https://wordpress.org/plugins/wp-sales-notifier/" target="_blank">WP Sales Notifier</a></li>
							<li><a href="https://wordpress.org/plugins/cf7-advance-security" target="_blank">Contact Form 7 Advance Security WP-Admin</a></li>
							<li><a href="https://wordpress.org/plugins/wp-easy-recipe/" target="_blank">WP Easy Recipe</a></li>
					</ol>
				</p>
			</div>
		</div>
    </form>
</div>
<?php
}
endif;

/* 
*Delete the options during disable the plugins 
*/
if( function_exists('register_uninstall_hook') )
register_uninstall_hook(__FILE__,'wpampweb_uninstall');   
//Delete all Custom Tweets options after delete the plugin from admin
function wpampweb_uninstall(){
	delete_option('wpampweb_active');	
} 

/** register_deactivation_hook */
/** Delete exits options during deactivation the plugins */
if( function_exists('register_deactivation_hook') ){
   register_deactivation_hook(__FILE__,'init_deactivation_wpampweb_plugins');   
}

//Delete all options after uninstall the plugin
function init_deactivation_wpampweb_plugins(){
	delete_option('wpampweb_active');
}

/** register_activation_hook */
/** Delete exits options during activation the plugins */
if( function_exists('register_activation_hook') ){
   register_activation_hook(__FILE__,'init_activation_wpampweb_plugins');   
}

//Disable free version after activate the plugin
function init_activation_wpampweb_plugins(){
 // silent
}
/** add js into admin footer */
add_action('admin_footer','init_waw_admin_scripts');
if(!function_exists('init_waw_admin_scripts')):
function init_waw_admin_scripts()
{
wp_register_style( 'waw_admin_style', plugins_url( 'css/waw-admin.css',__FILE__ ) );
wp_enqueue_style( 'waw_admin_style' );
echo $script='<script type="text/javascript">
	/* WP AMP Website admin */
	jQuery(document).ready(function(){
		jQuery(".waw-tab").hide();
		jQuery("#div-waw-general").show();
	    jQuery(".waw-tab-links").click(function(){
		var divid=jQuery(this).attr("id");
		jQuery(".waw-tab-links").removeClass("active");
		jQuery(".waw-tab").hide();
		jQuery("#"+divid).addClass("active");
		jQuery("#div-"+divid).fadeIn();
		})
		})
	</script>';

	}	
endif;	

/* include lib file */
require dirname(__FILE__).'/inc/index.php';
