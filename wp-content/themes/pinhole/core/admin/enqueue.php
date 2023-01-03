<?php

/* Load admin scripts and styles */
add_action( 'admin_enqueue_scripts', 'pinhole_load_admin_scripts' );


/**
 * Load scripts and styles in admin
 *
 * It just wrapps two other separate functions for loading css and js files in admin
 *
 * @since  1.0
 */

function pinhole_load_admin_scripts() {
	pinhole_load_admin_css();
	pinhole_load_admin_js();
}


/**
 * Load admin css files
 *
 * @since  1.0
 */

function pinhole_load_admin_css() {
	
	global $pagenow, $typenow;

	//Load small admin style tweaks
	wp_enqueue_style( 'pinhole-global', get_parent_theme_file_uri( '/assets/css/admin/global.css' ) , false, PINHOLE_THEME_VERSION, 'screen, print' );
}


/**
 * Load admin js files
 *
 * @since  1.0
 */

function pinhole_load_admin_js() {

	global $pagenow, $typenow;

	//Load global js
	wp_enqueue_script( 'pinhole-global', get_parent_theme_file_uri( '/assets/js/admin/global.js' ) , array( 'jquery' ), PINHOLE_THEME_VERSION );

	//Load page js
	if ( in_array($pagenow, array('post.php', 'post-new.php') ) && $typenow == 'page' ) {
			wp_enqueue_script( 'pinhole-page', get_parent_theme_file_uri('/assets/js/admin/metaboxes-page.js'), array( 'jquery', 'jquery-ui-autocomplete', 'jquery-ui-sortable' ), PINHOLE_THEME_VERSION );
			wp_localize_script( 'pinhole-page', 'pinhole_js_settings', pinhole_get_admin_js_settings() );
	}

	if(pinhole_get_option('use_gallery')){
		wp_enqueue_script( 'pinhole-gallery-settings', get_parent_theme_file_uri( '/assets/js/admin/gallery-settings.js' ), array( 'media-views' ), PINHOLE_THEME_VERSION );
	}

}

/**
 * Load editor styles
 *
 * @since  1.0
 */

function pinhole_load_editor_styles() {

	if ( $fonts_link = pinhole_generate_fonts_link() ) {
		add_editor_style( $fonts_link );
	}

	add_editor_style( get_parent_theme_file_uri( '/assets/css/admin/editor-style.css' ) );

}

/**
 * Load dynamic editor styles
 *
 * @since  1.0
 */

add_action( 'enqueue_block_editor_assets', 'pinhole_block_editor_styles', 99 );

function pinhole_block_editor_styles() {
	
	wp_register_style( 'pinhole-editor-styles', false, PINHOLE_THEME_VERSION );

	wp_enqueue_style( 'pinhole-editor-styles');
	wp_add_inline_style( 'pinhole-editor-styles', pinhole_generate_dynamic_editor_css() );

}

?>