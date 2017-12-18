<?php 
/**
 * @package Aissaian Branches
 * @version 1.0 Beta
 */
/*
Plugin Name: Aissaian Branches
Plugin URI: 
Description: 
Author: WiseSource LLC
Version: 1.0
Author URI: https://wisesource.net
*/

// add a new custom post type (Branches)

    function wsrc_company_branches() {

        $branch_labels = array(

            'name'               => _x( 'Aissaian Branches', 'post type general name' ),

            'singular_name'      => _x( 'Branch', 'post type singular name' ),

            'add_new'            => _x( 'Add New', 'branch' ),

            'add_new_item'       => __( 'Add New branch' ),

            'edit_item'          => __( 'Edit branch' ),

            'new_item'           => __( 'New branch' ),

            'all_items'          => __( 'All branches' ),

            'view_item'          => __( 'View branch' ),

            'search_items'       => __( 'Search branches' ),

            'not_found'          => __( 'No branches found' ),

            'not_found_in_trash' => __( 'No branch found in the Trash' ), 

            'parent_item_colon'  => '',

            'menu_name'          => 'Branches'

        );



        $branch_args = array(

            'labels'        => $branch_labels,

            'description'   => 'Holds our Branches and Branch specific data',

            'public'        => true,

            'menu_position' => 5,

            'supports'      => array( 'title', 'thumbnail', 'custom-fields'),

            'has_archive'   => true,

        );

        register_post_type( 'branch', $branch_args );  

    }

    add_action( 'init', 'wsrc_company_branches' );

	
$new_meta_boxes =
    array(		
    "type" => array(
        "name" => "type",
        "std" => "",
		"type"=>"input",
        "title" => "Country"),	
		
	"address" => array(
        "name" => "address",
        "std" => "",
		"type"=>"textarea",
        "title" => "Address"),	 
		
	"phone" => array(
        "name" => "phone",
        "std" => "",
		"type"=>"input",
        "title" => "Phone"),	
    "email" => array(
        "name" => "email",
        "std" => "",
		"type"=>"input",
        "title" => "E-Mail"),
    "work-hours" => array(
        "name" => "work-hours",
        "std" => "",
		"type"=>"textarea",
        "title" => "Working Hours"),
    "loc-lat" => array(
        "name" => "loc-lat",
        "std" => "",
		"type"=>"input",
        "title" => "Latitude for Location Map"),
    "loc-lng" => array(
        "name" => "loc-lng",
        "std" => "",
		"type"=>"input",
        "title" => "Longitude for Location Map")
	
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;
	
    foreach ($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
		
        if($meta_box_value == "") {
            $meta_box_value = $meta_box['std']; 
		}
		if(isset($meta_box['type']) && $meta_box['type'] == 'textarea')
		{
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<table width="100%"><tbody>';
			echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
			echo'<td><textarea style="width:100%;height:100px;border:1px solid black" name="'.$meta_box['name'].'">'.$meta_box_value.'</textarea></td></tr>';
			echo'</tbody></table>';
			echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';		
		}
		else if(isset($meta_box['type']) && $meta_box['type'] == 'input')
		{
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<table width="100%"><tbody>';
			echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
			echo'<td><input type="text/number" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" style="width: 100%;" /></td></tr>';
			echo'</tbody></table>';
			echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';
		}
		else if(isset($meta_box['type']) && $meta_box['type'] == 'checkbox')
		{
			$checked = ($meta_box_value) ? 'checked="checked"' : "" ;
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<table width="100%"><tbody>';
			echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
			echo'<td><input type="checkbox" name="'.$meta_box['name'].'" value="1" '. $checked .' /></td></tr>';
			echo'</tbody></table>';
			echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';		
		}
		else if(isset($meta_box['type']) && $meta_box['type'] == 'dropdown')
		{
			$dropdown = "<select name='{$meta_box[name]}'>";
			foreach($meta_box['values'] as $mbvalue)
			{
				$selected = ($meta_box_value == $mbvalue) ? 'selected="selected"' : "" ;
				$dropdown .= "<option {$selected}>{$mbvalue}</option>";
			}
			$dropdown .= '</select>';
			echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
			echo'<table width="100%"><tbody>';
			echo'<tr><td align="right" style="width: 184px;"><strong>'.$meta_box['title'].' - </strong></td>';
			echo'<td>'.$dropdown.'</td></tr>';
			echo'</tbody></table>';
			echo'<label for="'.$meta_box['name'].'">'.$meta_box['description'].'</label>';		
		}		
    }
}
 
function create_meta_box() {
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', 'Details', 'new_meta_boxes', 'branch', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;
 
	foreach($new_meta_boxes as $meta_box) 
	{
		// Verify
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
		}
 
        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
				return $post_id;
            } else {
				if ( !current_user_can( 'edit_post', $post_id ))
				return $post_id;
            }
 
            $data = $_POST[$meta_box['name']];
 
            if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
            elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
            elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
	}
}
 
add_action('admin_menu', 'create_meta_box');

add_action('save_post', 'save_postdata');