<?php

/* Load frontend scripts and styles */
add_action( 'wp_enqueue_scripts', 'pinhole_load_scripts' );

/**
 * Load scripts and styles on frontend
 *
 * It just wraps two other separate functions for loading css and js files
 *
 * @since  1.0
 */

function pinhole_load_scripts() {
	pinhole_load_css();
	pinhole_load_js();
}

/**
 * Load frontend css files
 *
 * @since  1.0
 */

function pinhole_load_css() {

	//Load google fonts
	if ( $fonts_link = pinhole_generate_fonts_link() ) {
		wp_enqueue_style( 'pinhole-fonts', $fonts_link, false, PINHOLE_THEME_VERSION );
	}

	//Check if is minified option active and load appropriate files
	if ( pinhole_get_option( 'minify_css' ) ) {

		wp_enqueue_style( 'pinhole-main', get_parent_theme_file_uri( '/assets/css/min.css' ) , false, PINHOLE_THEME_VERSION );

	} else {

		$styles = array(
			'font-awesome' => 'font-awesome.css',
			'bootstrap' => 'bootstrap.css',
			'main' => 'main.css'
		);

		foreach ( $styles as $id => $style ) {
			wp_enqueue_style( 'pinhole-' . $id, get_parent_theme_file_uri( '/assets/css/'. $style ) , false, PINHOLE_THEME_VERSION );
		}
	}

	//Append dynamic css
	wp_add_inline_style( 'pinhole-main', pinhole_generate_dynamic_css() );
	
	//Load RTL css
	if ( pinhole_is_rtl() ) {
		wp_enqueue_style( 'pinhole-rtl', get_parent_theme_file_uri('/assets/css/rtl.css' ) , array( 'pinhole-main' ), PINHOLE_THEME_VERSION );
	}

	//Do not load font awesome from our shortcodes plugin
	wp_dequeue_style( 'mks_shortcodes_fntawsm_css' );

}


/**
 * Load frontend js files
 *
 * @since  1.0
 */

function pinhole_load_js() {

	//Load comment reply js
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Check if is minified option active and load appropriate files
	if ( pinhole_get_option( 'minify_js' ) ) {

		wp_enqueue_script( 'pinhole-main', get_parent_theme_file_uri('/assets/js/min.js') , array( 'jquery', 'jquery-masonry', 'imagesloaded' ), PINHOLE_THEME_VERSION, true );

	} else {

		$scripts = array(
			'fitvid-js' => 'fitvids.js',
			'justified-gallery' => 'justified-gallery.js',
			'photoswipe' => 'photoswipe.js',
			'photoswipe-ui' => 'photoswipe-ui-default.js',
			'owl-carousel' => 'owl-carousel.js',
			'objectfit-images' => 'ofi.js',
			'main' => 'main.js'
		);

		foreach ( $scripts as $id => $script ) {
			wp_enqueue_script( 'pinhole-'.$id, get_parent_theme_file_uri( '/assets/js/'. $script ), array( 'jquery', 'jquery-masonry', 'imagesloaded' ), PINHOLE_THEME_VERSION, true );
		}
	}

	//Load JS settings object
	wp_localize_script( 'pinhole-main', 'pinhole_js_settings', pinhole_get_js_settings() );

	//Add inline JS if user added custom code in theme options
	$additional_js = trim( preg_replace( '/\s+/', ' ', pinhole_get_option( 'additional_js' ) ) );
	if ( !empty( $additional_js ) ) {
		wp_add_inline_script( 'pinhole-main', $additional_js );
	}
	
}
?>