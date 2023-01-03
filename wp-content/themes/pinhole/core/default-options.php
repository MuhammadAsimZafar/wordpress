<?php
/**
 * Get default option by passing option id
 *
 * @param string  $option
 * @return array|mixed|false
 * @param since   1.5
 */

if ( !function_exists( 'pinhole_get_default_option' ) ):
	function pinhole_get_default_option( $option = null ) {

		if ( empty( $option ) ) {
			return false;
		}

		$defaults = array(

			'logo'   => array( 'url' => esc_url( get_parent_theme_file_uri('/assets/img/pinhole_logo.png' ) ) ),
			'logo_retina'   => array( 'url' => esc_url( get_parent_theme_file_uri('/assets/img/pinhole_logo@2x.png' ) ) ),
			'logo_mobile'   => array( 'url' => esc_url( get_parent_theme_file_uri('/assets/img/pinhole_logo_mobile.png' ) ) ),
			'logo_mobile_retina'   => array( 'url' => esc_url( get_parent_theme_file_uri('/assets/img/pinhole_logo_mobile@2x.png' ) ) ),
			'logo_custom_url'   => '',
			'default_fimg'   => array( 'url' => esc_url( get_parent_theme_file_uri('/assets/img/pinhole_default.png' ) ) ),

			'color_bg' => '#ffffff',
			'background_gradient' => false,
			'background_gradient_color'  => '#000000',
			'background_gradient_orientation'  => 'to right top',
			'color_txt' => '#333333',
			'color_overlay' => '#000000',
			'color_overlay_txt' => '#ffffff',
			'color_image_overlay' => '#000000',
			'color_image_overlay_txt' => '#ffffff',

			'header_layout'   => 1,
			'header_elements'   => array(
                    'nav' => 1,
                    'social' => 1,
                    'sidebar' => 1
                ),
			'header_sticky'   => true,
			'header_sticky_offset'   => 300,
			'header_sticky_up'   => false,

			'gallery_layout'   => 'masonry',
			'gallery_columns'   => 3,
			'gallery_layout_size'   => 'medium',
			'gallery_prevnext' => true,
			'gallery_share' => array(
                    'facebook' => 1,
                    'twitter' => 1,
                    'pinterest' => 1
            ),
			'gallery_image_limit' => 12,
			'gallery_popup_image_size' => 1920,
			'gallery_image_caption' => true,
			'gallery_image_meta' => array( 
				'aperture' => 1, 
				'camera' => 1, 
				'focal_length' => 1, 
				'shutter_speed' => 1
			),
			'gallery_image_drawer_open' => false,
			'gallery_popup_autoplay' => false,
			'gallery_image_download' => true,
			'gallery_image_number' => false,
			'gallery_image_filename' => false,

			'galleries_layout'   => 'justify',
			'galleries_columns'   => 3,
			'galleries_layout_size'   => 'medium',
			'galleries_items'   => 'below',
			'galleries_image_count' => true,

			'albums_layout'   => 'grid',
			'albums_columns'   => 3,
			'albums_layout_size'   => 'large',
			'albums_items'   => 'overlay',
			'albums_gallery_count' => true,

			'archive_layout'   => 'grid',
			'archive_columns'   => 3,
			'archive_layout_size'   => 'large',
			'archive_items'   => 'below',
			'archive_category' => true,
			'archive_meta' => array( 
				'date' => 1, 
				'rtime' => 1 
			),
			'archive_excerpt' => true,
			'archive_excerpt_limit' => 150,
			'archive_pagination'   => 'load-more',

			'single_category' => true,
			'single_meta' => array(
				'author' => 1, 
				'comments' => 1, 
				'date' => 1, 
				'rtime' => 1
			),
			'single_fimg' => true,
			'single_tags' => true,
			'single_share' => array(
                    'facebook' => 1,
                    'twitter' => 1,
                    'pinterest' => 1
                ),
			'single_author' => true,
			'single_prevnext' => true,
			'footer_copyright' => wp_kses_post( '<p>' . sprintf( __('Created by %s &#183; Powered by %s<br/>Copyright {current_year} &#183; All rights reserved', 'pinhole' ), '<a href="https://mekshq.com" target="_blank">Meks</a>', '<a href="https://www.wordpress.org" target="_blank">WordPress</a>' ) . '</p>'),
			'main_font'     => array(
				'google'      => true,
                    'font-weight'  => '400',
                    'font-family' => 'Nunito',
                    'subsets' => 'latin-ext'
			),
			'h_font'     => array(
				'google'      => true,
                    'font-weight'  => '400',
                    'font-family' => 'Nunito',
                    'subsets' => 'latin-ext'
			),
			'nav_font'     => array(
				'google'      => true,
				'font-weight'  => '400',
                    'font-family' => 'Nunito Sans',
                    'subsets' => 'latin-ext'
			),
			'font_size_p'  => '14',
			'font_size_nav'  => '13',
			'font_size_section_title'  => '20',
			'font_size_widget_title'  => '16',
			'font_size_meta'  => '12',
			'font_size_h1'  => '30',
			'font_size_h2'  => '26',
			'font_size_h3'  => '22',
			'font_size_h4'  => '20',
			'font_size_h5'  => '18',
			'font_size_h6'  => '16',

			'uppercase' => array(
				'.site-title' => 1,
                    '.site-description' => 0,
                    '.pinhole-nav > li > a' => 1,
                    '.section-title .entry-title, .widget-title' => 1,
                    '.entry-category a, .entry-meta, .section-actions a, .entry-tags a' => 1,
                    'h1, h2, h3, h4, h5, h6' => 0,
			),
			
			'rtl_mode' => false,
			'rtl_lang_skip' => '',
			'more_string' => '...',
			'use_gallery' => true,
			'disable_right_click' => false,
			'words_read_per_minute' => 200,
			'on_single_img_popup' => false,

			'enable_translate' => '1',

			'minify_css' => true,
			'minify_js' => true,
			'disable_img_sizes' => array()


		);

		$defaults = apply_filters( 'pinhole_modify_default_options', $defaults );

		if ( isset( $defaults[$option] ) ) {
			return $defaults[$option];
		}

		return false;
	}
endif;

?>