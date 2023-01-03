<?php

/**
 * Change customize link to lead to theme options instead of live customizer 
 *
 * @since  1.0
 */

add_filter( 'wp_prepare_themes_for_js', 'pinhole_change_customize_link' );

if ( !function_exists( 'pinhole_change_customize_link' ) ):
	function pinhole_change_customize_link( $themes ) {
		if ( array_key_exists( 'pinhole', $themes ) ) {
			$themes['pinhole']['actions']['customize'] = admin_url( 'admin.php?page=pinhole_options' );
		}
		return $themes;
	}
endif;



/**
 * Outputs a view template for our gallery settings 
 * which can be used with wp.media.template 
 *
 * @since  1.0
 */

add_action( 'print_media_templates', 'pinhole_print_media_templates' );

if ( !function_exists( 'pinhole_print_media_templates' ) ):
	function pinhole_print_media_templates() {

		if(pinhole_get_option('use_gallery')){

		$layouts = pinhole_get_main_layouts(false, array('classic'));
		$columns = pinhole_get_layout_columns();
		$sizes = pinhole_get_layout_sizes();
		$image_limit = pinhole_get_option('gallery_image_limit');

		?>
		<script type="text/html" id="tmpl-pinhole-gallery-settings">
			<label class="setting">
				<span><?php esc_html_e( 'Settings', 'pinhole' ); ?></span>
				<select class="setting pinhole-opt-settings" name="settings" data-setting="pinhole_settings">
						<option value="inherit"><?php esc_html_e('Inherit from theme options', 'pinhole'); ?></option>
						<option value="custom"><?php esc_html_e('Customize', 'pinhole'); ?></option>
				</select>
			</label>
			<label class="setting pinhole-setting">
				<span><?php esc_html_e( 'Layout', 'pinhole' ); ?></span>
				<select class="pinhole-opt-layout" name="layout" data-setting="pinhole_layout">
					<?php foreach ( $layouts as $id => $layout  ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $layout['title'] ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label class="setting pinhole-setting">
				<span><?php esc_html_e( 'Columns', 'pinhole' ); ?></span>
				<select class="pinhole-opt-columns" name="pinhole_columns" data-setting="pinhole_columns">
					<?php foreach ( $columns as $id => $column  ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $column ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label class="setting pinhole-setting">
				<span><?php esc_html_e( 'Size', 'pinhole' ); ?></span>
				<select class="pinhole-opt-layout_size" name="pinhole_layout_size" data-setting="pinhole_layout_size">
					<?php foreach ( $sizes as $id => $size  ) : ?>
						<option value="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $size ); ?></option>
					<?php endforeach; ?>
				</select>
			</label>
			<label class="setting pinhole-setting">
				<span><?php esc_html_e( 'Set image limit', 'pinhole' ); ?></span>
				<input type="text" class="pinhole-opt-image_limit" name="pinhole_image_limit" data-setting="pinhole_image_limit" value="<?php echo esc_attr( $image_limit ); ?>"/>
			</label>
		</script>
		<?php

		}
	}
endif;


/**
 * 
 * Change default arguments of author widget plugin
 *
 * @since  1.0
 */

add_filter( 'mks_author_widget_modify_defaults', 'pinhole_author_widget_defaults' );

if ( !function_exists( 'pinhole_author_widget_defaults' ) ):
	function pinhole_author_widget_defaults( $defaults ) {
		$defaults['avatar_size'] = 100;
		$defaults['display_all_posts'] = 0;
		return $defaults;
	}
endif;


/**
 * Change default arguments of social widget plugin
 *
 * @since  1.0
 */

add_filter( 'mks_social_widget_modify_defaults', 'pinhole_social_widget_defaults' );

if ( !function_exists( 'pinhole_social_widget_defaults' ) ):
	function pinhole_social_widget_defaults( $defaults ) {
		$defaults['size'] = 65;
		return $defaults;
	}
endif;


/**
 * Change default arguments of social widget plugin
 *
 * @since  1.0
 */

add_filter( 'mks_flickr_widget_modify_defaults', 'pinhole_flickr_widget_defaults' );

if ( !function_exists( 'pinhole_flickr_widget_defaults' ) ):
	function pinhole_flickr_widget_defaults( $defaults ) {

		$defaults['count'] = 16;
		$defaults['t_width'] = 65;
		$defaults['t_height'] = 65;
		
		return $defaults;
	}
endif;


/**
 * Display theme admin notices
 *
 * @since  1.0
 */

add_action( 'admin_init', 'pinhole_check_installation' );

if ( !function_exists( 'pinhole_check_installation' ) ):
	function pinhole_check_installation() {
		add_action( 'admin_notices', 'pinhole_welcome_msg', 1 );
		add_action( 'admin_notices', 'pinhole_update_msg', 1 );
		add_action( 'admin_notices', 'pinhole_required_plugins_msg', 1 );
	}
endif;



/**
 * Display welcome message and quick tips after theme activation
 *
 * @since  1.0
 */

if ( !function_exists( 'pinhole_welcome_msg' ) ):
	function pinhole_welcome_msg() {

		if ( get_option( 'pinhole_welcome_box_displayed' ) ||  get_option( 'merlin_pinhole_completed' ) ) {
			return false;
		}

		update_option( 'pinhole_theme_version', PINHOLE_THEME_VERSION );
		include_once get_parent_theme_file_path( '/core/admin/welcome-panel.php' );
	}
endif;


/**
 * Display message when new version of the theme is installed/updated
 *
 * @since  1.0
 */

if ( !function_exists( 'pinhole_update_msg' ) ):
	function pinhole_update_msg() {
		
		if ( !get_option( 'pinhole_welcome_box_displayed' ) && !get_option( 'merlin_pinhole_completed' ) ) {
			return false;
		}

		$prev_version = get_option( 'pinhole_theme_version' );
		$cur_version = PINHOLE_THEME_VERSION;
		if ( $prev_version === false ) { $prev_version = '0.0.0'; }
		
		if ( version_compare( $cur_version, $prev_version, '>' ) ) {
			include_once get_parent_theme_file_path( '/core/admin/update-panel.php' );
		}
		
	}
endif;

/**
 * Display message if required plugins are not installed and activated
 *
 * @since  1.4
 */

if ( !function_exists( 'pinhole_required_plugins_msg' ) ):
	function pinhole_required_plugins_msg() {

		if ( !get_option( 'pinhole_welcome_box_displayed' ) && !get_option( 'merlin_pinhole_completed' ) ) {
			return false;
		}

		if ( !pinhole_is_redux_active() ) {
			$class = 'notice notice-error';
			$message = wp_kses_post( sprintf( __( 'Important: Redux Framework plugin is required to run your theme options panel. Please visit <a href="%s">recommended plugins page</a> to install it.', 'pinhole' ), admin_url( 'admin.php?page=install-required-plugins' ) ) );
			printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
		}

	}
endif;

/**
 * Check for Additional CSS in Theme Options and transfer it to Customize -> Additional CSS
 *
 * @return void
 * @since  1.0.5
 */

if ( !function_exists( 'pinhole_patch_additional_css' ) ) :
	function pinhole_patch_additional_css() {

		$additional_css = pinhole_get_option( 'additional_css' );

		if ( empty( $additional_css ) ) {
			return false;
		}
		
		global $pinhole_settings;

		$pinhole_settings = get_option( 'pinhole_settings' ); 

		$pinhole_settings['additional_css'] = '';

		update_option( 'pinhole_settings', $pinhole_settings ) ;

		$customize_css = wp_get_custom_css_post();
		
		if ( !empty( $customize_css ) && !is_wp_error( $customize_css ) ) {
			$additional_css .= $customize_css->post_content;
		}

		wp_update_custom_css_post($additional_css);
	}
endif;

add_action('admin_init','pinhole_patch_additional_css');

/**
 * Add Meks dashboard widget
 *
 * @since  1.0
 */

add_action( 'wp_dashboard_setup', 'pinhole_add_dashboard_widgets' );

if ( !function_exists( 'pinhole_add_dashboard_widgets' ) ):
	function pinhole_add_dashboard_widgets() {
		add_meta_box( 'pinhole_dashboard_widget', 'Meks - WordPress Themes & Plugins', 'pinhole_dashboard_widget_cb', 'dashboard', 'side', 'high' );
	}
endif;


/**
 * Meks dashboard widget
 *
 * @since  1.0
 */
if ( !function_exists( 'pinhole_dashboard_widget_cb' ) ):
	function pinhole_dashboard_widget_cb() {

		$transient = 'pinhole_mksaw';
		$hide = '<style>#pinhole_dashboard_widget{display:none;}</style>';

		$data = get_transient( $transient );
	
		if ( $data == 'error' ) {
			echo $hide;
			return;
		}

		if ( !empty( $data ) ) {
			echo $data;
			return;
		}

		$url = 'https://demo.mekshq.com/mksaw.php';
		$args = array( 'body' => array( 'key' => md5( 'meks' ), 'theme' => 'pinhole' ) );
		$response = wp_remote_post( $url, $args );

		if ( is_wp_error( $response ) ) {
			set_transient( $transient, 'error', DAY_IN_SECONDS );
			echo $hide;
			return;
		}

		$json = wp_remote_retrieve_body( $response );

		if ( empty( $json ) ) {
			set_transient( $transient, 'error', DAY_IN_SECONDS );
			echo $hide;
			return;
		}

		$json = json_decode( $json );

		if ( !isset( $json->data ) ) {
			set_transient( $transient, 'error', DAY_IN_SECONDS );
			echo $hide;
			return;
		} 

		set_transient( $transient, $json->data, DAY_IN_SECONDS );
		echo $json->data;
		
	}
endif;
?>