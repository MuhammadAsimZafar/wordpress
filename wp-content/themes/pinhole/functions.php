<?php

/* Define Theme Vars */
define( 'PINHOLE_THEME_VERSION', '1.5.2' );

/* Define content width */
if ( !isset( $content_width ) ) {
	$content_width = 1194;
}

/* Localization */
load_theme_textdomain( 'pinhole', get_parent_theme_file_path( '/languages' ) );


/* After theme setup main hook */
add_action( 'after_setup_theme', 'pinhole_theme_setup' );

/**
 * After Theme Setup
 *
 * Callback for after_theme_setup hook
 *
 * @since  1.0
 */

function pinhole_theme_setup() {

	/* Add thumbnails support */
	add_theme_support( 'post-thumbnails' );

	/* Add theme support for title tag */
	add_theme_support( 'title-tag' );

	/* Add image sizes */
	$image_sizes = pinhole_get_image_sizes();
	if ( !empty( $image_sizes ) ) {
		foreach ( $image_sizes as $id => $size ) {
			add_image_size( $id, $size['w'], $size['h'], $size['crop'] );
		}
	}

	/* Support for HTML5 */
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	/* Automatic Feed Links */
	add_theme_support( 'automatic-feed-links' );

	/* Load editor styles */
	add_theme_support( 'editor-styles' );

	/* Load editor styles */
	if ( is_admin() ) {
		pinhole_load_editor_styles();
	}

	/* Support for alignwide elements */
	add_theme_support( 'align-wide' );

	/* Support for responsive embeds */
	add_theme_support( 'responsive-embeds' );

	/* Support for predefined colors in editor */
	add_theme_support( 'editor-color-palette', pinhole_get_editor_colors() );

	/* Support for predefined font-sizes in editor */
	add_theme_support( 'editor-font-sizes', pinhole_get_editor_font_sizes() );

}


/* Helpers and utility functions */
include_once get_parent_theme_file_path( '/core/helpers.php' );

/* Default options */
include_once get_parent_theme_file_path( '/core/default-options.php' );

/* Load frontend scripts */
include_once get_parent_theme_file_path( '/core/enqueue.php' );

/* Template functions */
include_once get_parent_theme_file_path( '/core/template-functions.php');

/* Menus */
include_once get_parent_theme_file_path( '/core/menus.php' );

/* Sidebars */
include_once get_parent_theme_file_path('/core/sidebars.php');

/* Extensions (hooks and filters to add/modify specific features ) */
include_once get_parent_theme_file_path( '/core/extensions.php' );


if ( is_admin() ) {

	/* Admin helpers and utility functions  */
	include_once get_parent_theme_file_path( '/core/admin/helpers.php' );

	/* Load admin scripts */
	include_once get_parent_theme_file_path( '/core/admin/enqueue.php' );

	/* Theme Options */
	include_once get_parent_theme_file_path( '/core/admin/options.php');

	/* Include plugins - TGM */
	include_once get_parent_theme_file_path( '/core/admin/plugins.php' );

	/* Include AJAX action handlers */
	include_once get_parent_theme_file_path( '/core/admin/ajax.php');

	/* Extensions ( hooks and filters to add/modify specific features ) */
	include_once get_parent_theme_file_path( '/core/admin/extensions.php' );

	/* Custom metaboxes */
	include_once get_parent_theme_file_path( '/core/admin/metaboxes.php');

	/* Demo importer panel */
	include_once get_parent_theme_file_path( '/core/admin/demo-importer.php' );

}


?>