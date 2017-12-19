<?php 
/**
 * @package Aissaian Partners
 * @version 1.0
 */
/*
Plugin Name: Aissaian Partners
Plugin URI: 
Description: 
Author: WiseSource
Version: 1.0
Author URI: https://wisesource.net
*/
function register_partnerss() {

  register_post_type('partners', array( 'label' => 'Partners','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('with_front' => false, 'slug' => 'partners'),'menu_position' => 5,'menu_icon'     => 'dashicons-groups','query_var' => true,'exclude_from_search' => false,'has_archive' => true,'supports' => array('title','editor','thumbnail'),'labels' => array (
    'name' => 'Partners',
    'singular_name' => 'Partner',
    'menu_name' => 'Partners',
    'add_new' => 'Add Partner',
    'add_new_item' => 'Add New Partner',
    'edit' => 'Edit',
    'edit_item' => 'Edit Partner',
    'new_item' => 'New Partner',
    'view' => 'View Partners',
    'view_item' => 'View Partner',
    'search_items' => 'Search Partners',
    'not_found' => 'No Partners Found',
    'not_found_in_trash' => 'No Partners Found in Trash',
    'parent' => 'Parent Partners',
  ),) );

}

add_action( 'init', 'register_partnerss' );



//Setup Custom Fields Start
add_action("admin_init", "admin_init_partners");
         
function admin_init_partners(){
    add_meta_box("partnerslink_meta", "Partner Details", "partnerslink", "partners", "normal", "low");

}
    
function partnerslink() {
    global $post;
    $custom = get_post_custom($post->ID);
    if(isset($custom["_partnerslink"][0])){ $partnerslink = $custom["_partnerslink"][0]; }
    

    if(isset($custom["_partnerwebsite"][0])){ $partnerwebsite = $custom["_partnerwebsite"][0]; }         
   
?>
    <p class="description">Type your link below.  If you are linking to an external website address, please include http:// before www.</p>
    <table class="form-table">
        <tr>
            <th style="width:30%">
                <label for="partnerslink"><?php _e( 'Catalog Link:', 'northcote_partners' ); ?></label>
            </th>
            <td>


    <input style="width: calc(70% - 4px); display: inline-block;" id="pdfUploadFile" type="text" size="100" name="partnerslink" value="<?php if (!empty($partnerslink)) { echo $partnerslink; } ?>" />

            <button class="button "  style=" display: inline-block;"  id="pdfUploadSettings" type="button" value="Upload Media" /><span style="display: inline-block; margin-top: 3px; " class="dashicons dashicons-upload"></span> Upload Media</button>

            </td>
        </tr>
        
        <tr>
            <th style="width:30%">
                <label for="partnerwebsite"><?php _e( 'Website:', 'northcote_partners' ); ?></label>
            </th>
            <td>
                <input name="partnerwebsite" id="partnerwebsite" value="<?php if (!empty($partnerwebsite)) { echo $partnerwebsite; } ?>" size="80" style="width:97%" />
            </td>
        </tr>                

    </table>
<?php
}

//Save
add_action('save_post', 'save_details_partnerslink');
    
function save_details_partnerslink(){


    //if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX || (defined('DOING_CRON') && DOING_CRON) )
    return $post_id;
    global $post;
    if(isset($_POST["partnerslink"])){ update_post_meta($post->ID, "_partnerslink", $_POST["partnerslink"]); }

    if(isset($_POST["partnerwebsite"])){ update_post_meta($post->ID, "_partnerwebsite", $_POST["partnerwebsite"]); }         
    
}

//Add scripts for pdf upload, this is for media window, must be js in the /custom-theme/js/image-upload.js
function add_admin_scripts_menus( $hook ) {
    global $post;


    // General settings pdf
    if ( $hook == 'post.php' || $hook == 'post-new.php' ) {
        wp_enqueue_script(  'myscript', plugin_dir_url(__FILE__).'image-upload.js' );
    } 

}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts_menus', 10, 1 );

//Setup Custom Fields End

