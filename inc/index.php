<?php
/**
 * The template for displaying mobile site
 *
 * This is the template that displays all mobile pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Employee
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Define mobile site class
 * @only_for_admin
 * @wordpress_hooks
 *
 * */
if(!class_exists('WpAmpWebite')):
class WpAmpWebite
{
    /**
     * Start up
     */
    public function __construct()
    {
		//define action for create new meta boxes
		add_action( 'admin_init',  array( $this,'wpampweb_register_nav_menu'),0 );
		
		//define action for create new meta boxes
		add_action( 'add_meta_boxes',  array( $this,'add_wpampweb_mobile_meta_box') );
		//Define action for save to "Blog" Meta Box fields Value
		add_action( 'save_post',  array( $this,'save_wpampweb_mobile_meta_box') );
    }
/*-------------------------------------------------
 Start Team Meta Boxes
 ------------------------------------------------- */
   // sanitize fields
	public function wpampweb_sanitize_fields($type='',$val='')
	{
		
		switch ($type) {
		  case "editor":
			$val = balanceTags($val);
			break;
		  case "textarea":
			$val = sanitize_textarea_field($val);
			break;
		  case "text":
			$val = sanitize_text_field($val);
			break;
		  default:
			$val;
		 }
		return $val;
	}
	public function add_wpampweb_mobile_meta_box()
	{
		$screens = get_option('wpampweb_m_post_type') ? get_option('wpampweb_m_post_type') : array(); // get all checked post type
		foreach ( $screens as $screen ) {
			add_meta_box(
				'aio-serving-meta-box',
				__( 'Mobile Site Section', 'allinone' ),
				array($this,'show_wpampweb_mobile_meta_box'),
				$screen
			);
		}

	}
	
 /*-------------------------------------------------
 Start Team Meta Fileds Array 
 ------------------------------------------------- */
	public function return_wpampweb_mobile_meta_fileds()
	{
	//Define meta box fields
	  global $wpampweb_mobile_meta_box;
	  $prefix='_wpampweb_mobile_';
	  $wpampweb_mobile_meta_box = array(
			'id'      => 'aio-serving-meta-box',
			'title'   => ' Mobile Site Section',
			'page'    => '',
			'context' => 'normal',
			'priority'=> 'high',
			'fields'  => 
					  array(
					    array(
							'title' => 'Has mobile version?',
							'desc' => '',
							'id'   => $prefix.'mobile_version',
							'name'   => $prefix.'mobile_version',
							'type' => 'checkbox',
							'std'  => 1
							),
							array(
							'title' => 'Mobile Content',
							'desc' => '',
							'id'   => $prefix.'content',
							'name'   => $prefix.'content',
							'type' => 'editor',
							'tinymce' => true,
							'media_buttons' => true,
							'std'  => ''
							),
							array(
							'title' => 'CSS/Script',
							'desc' => '',
							'id'   => $prefix.'css',
							'name'   => $prefix.'css',
							'type' => 'editor',
							'tinymce' => false,
							'media_buttons' => false,
							'std'  => ''
							)
							
							
			)
		);
      return $wpampweb_mobile_meta_box;
	}
  
//Display Adds Blog Meta Box

	public function show_wpampweb_mobile_meta_box()
	{ 
	  global $post;
	  $wpampweb_mobile_meta_box = $this->return_wpampweb_mobile_meta_fileds();
		wp_nonce_field( 'wpampweb_mobile_box_field', 'wpampweb_mobile_box_meta_box_once' );
		echo '<table class="form-table"><tbody>';
		$jk=0;
		foreach ($wpampweb_mobile_meta_box['fields'] as $field) {
			
			// get current post meta data
		if($field['type'] != 'heading') {
			$meta = get_post_meta($post->ID, $field['name'], true);
			echo '<tr>',
			'<td><label for="', $field['id'], '">', $field['title'], '</label>','</td>';
			switch ($field['type']) {
			case 'text':
				echo '<td><input type="text" name="', $field['name'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="80%" />', '<br />', $field['desc'],'</td>';
				break;
			case 'arry_text':
				echo '<td><input type="text" name="', $field['name'], '" id="', $field['id'], '" value="', $meta ? $meta[$jk] : $field['std'], '" size="30" />', '<br />', $field['desc'],$jk,'</td>';
				$jk++;
				break;
			case 'checkbox':
				echo '<td><input type="checkbox" name="', $field['name'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'],'"', checked( $meta, 1 ),' size="30" />', '<br />', $field['desc'],'</td>';
				break;
			case 'image':
				echo '<td><input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30"/><input type="button" id="meta-image-button" class="button" value="Choose or Upload an Image" />', '<br />', $field['desc'],'</td>';
				break;
			case 'editor':
				echo '<td>',wp_editor($meta ? $meta : $field['std'], $field['name'],array('wpautop'=>false,'textarea_rows' => '10','tinymce' => $field['tinymce'],'media_buttons' => $field['media_buttons'])), '<br />', $field['desc'],'</td>';
				break;
			case 'textarea':
				echo '<td><textarea name="', $field['name'], '" id="', $field['id'], '" rows="10" cols="100">', $meta ? $meta : $field['std'],'</textarea>', '<br />', $field['desc'],'</td>';
				break;
			case 'selectmulti':
				echo '<td><select name="', $field['name'], '[]" id="', $field['id'], '" multiple>';
				$optionVal=$field['options'];
				$meta = explode(',',$meta);
				foreach($optionVal as $key => $optVal):
				if(in_array($key,$meta)){
				$valseleted =' selected="selected"';}else {
					 $valseleted ='';
					}
				echo '<option value="', $key, '" ',$valseleted,' id="', $field['id'], '">', $optVal,'</option>';
			endforeach;
			echo '</select>','<br />',$field['desc'],'</td>';
			break;
			case 'select':
				echo '<td><select name="', $field['name'], '" id="', $field['id'], '" >';
				$optionVal=$field['options'];
				foreach($optionVal as $key => $optVal):
				if($meta==$key){
				$valseleted =' selected="selected"';}else {
					 $valseleted ='';
					}
				echo '<option value="', $key, '" ',$valseleted,' id="', $field['id'], '">', $optVal, '</option>';
			endforeach;
			echo '</select>','<br />',$field['desc'],'</td>';
			break;
		}
		
		}
		
		if($field['type'] == 'heading')
		{
			echo '<td colspan="2"><h2 class="hndle ui-sortable-handle"><strong>'.$field['title'].'</strong></h2></td>';
			}
		
		echo '</tr>';
		
		}
	echo '</tbody></table>';
	}

   public function save_wpampweb_mobile_meta_box($post_id) {
		$wpampweb_mobile_meta_box = $this->return_wpampweb_mobile_meta_fileds();
		// Check if our nonce is set.
		 if ( ! isset( $_POST['wpampweb_mobile_box_meta_box_once'] ) ) {
				return;
			}
			
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
		}

		// check permissions
		if ('page' == $_POST['post_type']) 
		{
			if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} 
		elseif(!current_user_can('edit_post', $post_id)){
		return $post_id;
		}
		
		foreach ($wpampweb_mobile_meta_box['fields'] as $field) 
		{
			$fldname = $field['name'];
			$old = get_post_meta($post_id, $fldname, true);
			$newval = $this->wpampweb_sanitize_fields($field['type'],$_POST[$fldname]);
			
			if(is_array($newval))
			{
				$new = implode(',',$newval);
				}else
				{
			$new = $newval;
		    }
			if ($new && $new != $old){
			 update_post_meta($post_id, $fldname, $new);
			} 
			elseif ('' == $new && $old) {
			delete_post_meta($post_id, $fldname, $old);
			}
		}
	}
	
    public function wpampweb_register_nav_menu(){
       register_nav_menus( array(
            'wpampweb_amp_top_menu' => __( 'WP AMP Main Menu', 'wpampweb' ),
            'wpampweb_amp_footer_menu'  => __( 'WP AMP Footer Menu', 'wpampweb' ),
        ) );
    }

}
endif;
//initilsize mobile site class only for admin section
if( is_admin() ){
    $WpAmpWebite = new WpAmpWebite();
}
//include front-end files
require_once dirname(__FILE__).'/waw-m-class.php'; // include library file
