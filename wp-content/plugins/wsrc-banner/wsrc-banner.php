<?php 
/**
 * @package WiseSource Sliding Banner
 * @version 1.0
 */
/*
Plugin Name: Aissaian Home Banner
Plugin URI: 
Description: 
Author: WiseSource
Version: 1.0
Author URI: https://wisesource.net
*/
// add a new custom post type (Slider)

    function asn_custom_banner() {

        $labels = array(

            'name'               => _x( 'Banners', 'post type general name' ),

            'singular_name'      => _x( 'Banner', 'post type singular name' ),

            'add_new'            => _x( 'Add New', 'Banner' ),

            'add_new_item'       => __( 'Add New Banner' ),

            'edit_item'          => __( 'Edit Banner' ),

            'new_item'           => __( 'New Banner' ),

            'all_items'          => __( 'All Banners' ),

            'view_item'          => __( 'View Banner' ),

            'search_items'       => __( 'Search Banners' ),

            'not_found'          => __( 'No Banners found' ),

            'not_found_in_trash' => __( 'No Banners found in the Trash' ), 

            'parent_item_colon'  => '',

            'menu_name'          => 'Home Banners'

        );



        $args = array(

            'labels'        => $labels,

            'description'   => 'Holds our banners and banner specific data',

            'public'        => true,

            'menu_position' => 5,

            'menu_icon'     => 'dashicons-slides',

            'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields'),

            'has_archive'   => true,

        );

        register_post_type( 'banner', $args );  

    }

    add_action( 'init', 'asn_custom_banner' );