<?php 

require_once ('includes/wp-bootstrap-navwalker.php');
function out($var) {
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

        function register_my_menus() {
          register_nav_menu('main-menu',__( 'Main Menu' ));
        }
        add_action( 'init', 'register_my_menus' );

   add_theme_support( 'post-thumbnails' ); 
   add_theme_support('title-tag');

   add_action( 'widgets_init', 'asn_sidebars' );

   function asn_sidebars() {

    register_sidebar( array(
        'name' => __( 'Footer Sidebar', 'aissaian' ),
        'id' => 'footer-sidebar',
        'description' => __( 'Widgets in this area will be shown on all pages.', 'syrarbi' ),
        'before_widget' => '<div id="%1$s" class="widget col-12 col-md-3 %2$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h2 class="widgettitle">',
	'after_title'   => '</h2>',
    ) );
   }



