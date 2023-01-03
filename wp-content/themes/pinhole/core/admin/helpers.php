<?php

/**
 * Get the list of available layouts
 *
 * @param  bool $inherit Wheter to display "inherit" option
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_main_layouts' ) ):
	function pinhole_get_main_layouts( $inherit = false, $exclude = array() ) {

		$layouts = array();

		if( $inherit ){
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/inherit.png' ) );
		}

		$layouts['masonry'] = array( 'title' => esc_html__( 'Masonry', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/layout_masonry.png' ) );
		$layouts['justify'] = array( 'title' => esc_html__( 'Justify', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/layout_justify.png' ) );
		$layouts['grid'] = array( 'title' => esc_html__( 'Grid', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/layout_grid.png' ) );
		$layouts['classic'] = array( 'title' => esc_html__( 'Classic', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/layout_classic.png' ) );

		if (!empty($exclude)) {
			foreach ($exclude as $layout) {
				if (array_key_exists($layout, $layouts)) {
					unset($layouts[$layout]);
				}
			}
		}

		$layouts = apply_filters('pinhole_modify_main_layouts', $layouts ); //Allow child themes or plugins to modify
		
		return $layouts;
		
	}
endif;

/**
 * Get the list of available layout styles
 *
 * @param  bool $inherit Wheter to display "inherit" option
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_layout_styles' ) ):
	function pinhole_get_layout_styles(  $inherit = false ) {

		$styles = array();

		if( $inherit ){
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/inherit.png' ) );
		}

		$layouts['below'] = array( 'title' => esc_html__( 'Below', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/style_below.png' ) );
		$layouts['overlay'] = array( 'title' => esc_html__( 'Overlay', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/style_overlay.png' ) );
		$layouts['gradient'] = array( 'title' => esc_html__( 'Gradient', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/style_gradient.png' ) );
		$layouts['hidden'] = array( 'title' => esc_html__( 'Hidden', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/style_hidden.png' ) );

		$layouts = apply_filters('pinhole_modify_main_layouts', $layouts ); //Allow child themes or plugins to modify
		
		return $layouts;
		
	}
endif;


/**
 * Get the list of available column options for layouts
 *
 * @param  bool $inherit Wheter to display "inherit" option
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_layout_columns' ) ):
	function pinhole_get_layout_columns( $inherit = false ) {

		$columns = array();

		if( $inherit ){
			$columns['inherit'] = esc_html__( 'Inherit', 'pinhole' );
		}

		$columns += array(
			'2' => '2', 
			'3' => '3', 
			'4' => '4'
		);

		$columns = apply_filters('pinhole_modify_layout_columns', $columns ); //Allow child themes or plugins to modify
		
		return $columns;
		
	}
endif;

/**
 * Get the list of available layout size options
 *
 * @param  bool $inherit Wheter to display "inherit" option
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_layout_sizes' ) ):
	function pinhole_get_layout_sizes( $inherit = false ) {

		$sizes = array();

		if( $inherit ){
			$sizes['inherit'] = esc_html__( 'Inherit', 'pinhole' );
		}

		$sizes['small'] = esc_html__( 'Small', 'pinhole' );
		$sizes['medium'] = esc_html__( 'Medium', 'pinhole' );
		$sizes['large'] = esc_html__( 'Large', 'pinhole' );


		$sizes = apply_filters('pinhole_modify_layout_sizes', $sizes ); //Allow child themes or plugins to modify
		
		return $sizes;
		
	}
endif;


/**
 * Get the list of available pagination types
 *
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_pagination_layouts' ) ):
	function pinhole_get_pagination_layouts() {

		$layouts = array();

		$layouts['numeric'] = array( 'title' => esc_html__( 'Numeric pagination links', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/pag_numeric.png' ) );
		$layouts['prev-next'] = array( 'title' => esc_html__( 'Prev/Next page links', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/pag_prev_next.png' ) );
		$layouts['load-more'] = array( 'title' => esc_html__( 'Load more button', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/pag_load_more.png') );
		$layouts['infinite-scroll'] = array( 'title' => esc_html__( 'Infinite scroll', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/pag_infinite.png') );

		$layouts = apply_filters('pinhole_modify_pagination_layouts', $layouts );
		
		return $layouts;
	}
endif;


/**
 * Get the list of header layouts
 *
 * @param  bool $inherit Wheter to display "inherit" option
 * @param  bool $none Wheter to display "none" option
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_header_layouts' ) ):
	function pinhole_get_header_layouts( $inherit = false, $none = false ) {

		$layouts = array();

		if( $inherit ){
			$layouts['inherit'] = array( 'title' => esc_html__( 'Inherit', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/inherit.png' ) );
		}

		$layouts['1'] = array( 'title' => esc_html__( 'Layout 1', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/header_layout_1.png' ) );
		$layouts['2'] = array( 'title' => esc_html__( 'Layout 2', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/header_layout_2.png' ) );
		$layouts['3'] = array( 'title' => esc_html__( 'Layout 3', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/header_layout_3.png' ) );

		if( $inherit ){
			$layouts['none'] = array( 'title' => esc_html__( 'None', 'pinhole' ), 'img' => get_parent_theme_file_uri( '/assets/img/admin/none.png' ) );
		}

		$layouts = apply_filters('pinhole_modify_header_layouts', $layouts ); //Allow child themes or plugins to modify
		
		return $layouts;
		
	}
endif;


/**
 * Get meta options
 *
 * @param   array $default Enable defaults i.e. array('date', 'comments')
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_meta_opts' ) ):
	function pinhole_get_meta_opts( $default = array() ) {

		$options = array();

		$options['date'] = esc_html__( 'Date', 'pinhole' );
		$options['author'] = esc_html__( 'Author', 'pinhole' );
		$options['rtime'] = esc_html__( 'Reading time', 'pinhole' );
		$options['comments'] = esc_html__( 'Comments', 'pinhole' );

		if(!empty($default)){
			foreach($options as $key => $option){
				if(in_array( $key, $default)){
					$options[$key] = 1;
				} else {
					$options[$key] = 0;
				}
			}
		}

		$options = apply_filters('pinhole_modify_meta_opts', $options ); //Allow child themes or plugins to modify

		return $options;
	}
endif;


/**
 * Get image meta options
 *
 * @param   array $default Enable defaults i.e. array('shutter_speed')
 * @return array List of available options
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_image_meta_opts' ) ):
	function pinhole_get_image_meta_opts( $default = array() ) {

		$options = array();

		$options['aperture'] = esc_html__( 'Aperture', 'pinhole' );
		$options['camera'] = esc_html__( 'Camera', 'pinhole' );
		$options['focal_length'] = esc_html__( 'Focal length', 'pinhole' );
		$options['shutter_speed'] = esc_html__( 'Shutter speed', 'pinhole' );
		$options['iso'] = esc_html__( 'ISO', 'pinhole' );
		$options['credit'] = esc_html__( 'Credit', 'pinhole' );
		$options['copyright'] = esc_html__( 'Copyright', 'pinhole' );

		if(!empty($default)){
			foreach($options as $key => $option){
				if(in_array( $key, $default)){
					$options[$key] = 1;
				} else {
					$options[$key] = 0;
				}
			}
		}

		$options = apply_filters('pinhole_modify_image_meta_opts', $options ); //Allow child themes or plugins to modify

		return $options;
	}
endif;


/**
 * Get admin JS settings
 *
 * Function creates list of settings from thme options to pass
 * them to global JS variable so we can use it in JS files
 *
 * @return array List of JS settings
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_admin_js_settings' ) ):
	function pinhole_get_admin_js_settings() {
		$js_settings = array();

		$js_settings['ajax_url'] = admin_url( 'admin-ajax.php');
		$js_settings['is_gutenberg'] = pinhole_is_gutenberg_page();

		return $js_settings;
	}
endif;

/**
 * Check if Envato Market plugin is active
 *
 * @return bool
 * @since  1.3.2
 */
if ( !function_exists( 'pinhole_is_envato_market_active' ) ):
	function pinhole_is_envato_market_active() {

		if ( in_array( 'envato-market/envato-market.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}
		return false;
	}
endif;

/**
 * Check if Redux Framework plugin is active
 *
 * @return bool
 * @since  1.4
 */
if ( !function_exists( 'pinhole_is_redux_active' ) ):
	function pinhole_is_redux_active() {

		if ( in_array( 'redux-framework/redux-framework.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			return true;
		}
		return false;
	}
endif;


/**
 * Social Platforms
 *
 * @return array
 * @since  1.5
 */
if ( !function_exists( 'pinhole_get_social_platforms' ) ) :
	function pinhole_get_social_platforms() {

		if ( function_exists('meks_ess_get_platforms') ) {
			return meks_ess_get_platforms();
		}

		return array(
			'facebook' => esc_html__( 'Facebook', 'pinhole' ),
			'twitter' => esc_html__( 'Twitter', 'pinhole' ),
			'reddit' => esc_html__( 'Reddit', 'pinhole' ),
			'pinterest' => esc_html__( 'Pinterest', 'pinhole' ),
			'email' => esc_html__( 'Email', 'pinhole' ),
			'gplus' => esc_html__( 'Google+', 'pinhole' ),
			'linkedin' => esc_html__( 'LinkedIN', 'pinhole' ),
			'stumbleupon' => esc_html__( 'StumbleUpon', 'pinhole' ),
			'whatsapp' => esc_html__( 'WhatsApp', 'pinhole' )
		);

	}
endif;

?>