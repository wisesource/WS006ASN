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



