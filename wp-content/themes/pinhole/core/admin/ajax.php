<?php

/**
 * Hide update notification and update theme version
 *
 * @since  1.0
 */

add_action( 'wp_ajax_pinhole_update_version', 'pinhole_update_version' );

if ( !function_exists( 'pinhole_update_version' ) ):
	function pinhole_update_version() {
		update_option( 'pinhole_theme_version', PINHOLE_THEME_VERSION );
		die();
	}
endif;


/**
 * Hide welcome notification
 *
 * @since  1.0
 */

add_action( 'wp_ajax_pinhole_hide_welcome', 'pinhole_hide_welcome' );

if ( !function_exists( 'pinhole_hide_welcome' ) ):
	function pinhole_hide_welcome() {
		update_option( 'pinhole_welcome_box_displayed', true );
		die();
	}
endif;


/**
 * Hide welcome notification
 *
 * @since  1.0
 */

add_action( 'wp_ajax_pinhole_search', 'pinhole_search' );

if ( !function_exists( 'pinhole_search' ) ):
	function pinhole_search() {
	
		$posts = get_posts( array(
				's' => $_GET['term'],
				'post_type' => 'page'
			) );

		$suggestions = array();

		global $post;
		
		foreach ( $posts as $post ) {
			setup_postdata( $post );
			$suggestion = array();
			$suggestion['label'] = esc_html( $post->post_title );
			$suggestion['id'] = $post->ID;
			$suggestions[]= $suggestion;
		}

		$response = $_GET["callback"] . "(" . json_encode( $suggestions ) . ")";

		echo wp_kses_post( $response );

		die();
	}
endif;

?>
