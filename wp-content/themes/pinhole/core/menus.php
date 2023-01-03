<?php

/**
 * Register menus
 *
 * Callback function theme menus registration and init
 *
 * @since  1.0
 */

add_action( 'init', 'pinhole_register_menus' );

if ( !function_exists( 'pinhole_register_menus' ) ) :
	function pinhole_register_menus() {
		register_nav_menu( 'pinhole_main_menu', esc_html__( 'Main Menu' , 'pinhole' ) );
		register_nav_menu( 'pinhole_social_menu', esc_html__( 'Social Menu' , 'pinhole' ) );
	}
endif;


?>