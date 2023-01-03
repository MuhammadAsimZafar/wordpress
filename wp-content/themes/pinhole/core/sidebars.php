<?php

/**
 * Register sidebars
 *
 * Callback function for theme sidebars registration and init
 * 
 * @since  1.0
 */

add_action( 'widgets_init', 'pinhole_register_sidebars' );

if ( !function_exists( 'pinhole_register_sidebars' ) ) :
	function pinhole_register_sidebars() {
				
		/* Default Sidebar */
		register_sidebar(
			array(
				'id' => 'pinhole_default_sidebar',
				'name' => esc_html__( 'Default Sidebar', 'pinhole' ),
				'description' => esc_html__( 'This is default sidebar', 'pinhole' ),
				'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h4 class="widget-title">',
				'after_title' => '</h4>'
			)
		);

	}

endif;




?>