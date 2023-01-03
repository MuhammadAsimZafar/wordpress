<?php

require_once get_parent_theme_file_path( '/inc/merlin/vendor/autoload.php' );
require_once get_parent_theme_file_path( '/inc/merlin/class-merlin.php' );

/**
 * Merlin WP configuration file.
 */

if ( ! class_exists( 'Merlin' ) ) {
	return;
}

$strings = array(
	'admin-menu'               => esc_html__( 'Pinhole Setup Wizard', 'pinhole' ),
	'title%s%s%s%s'            => esc_html__( '%s%s Themes &lsaquo; Theme Setup: %s%s', 'pinhole' ),
	'return-to-dashboard' 	   => esc_html__( 'Return to the dashboard', 'pinhole' ),
	'ignore'                   => esc_html__( 'Disable this wizard', 'pinhole' ),
	
	'btn-skip'                  => esc_html__( 'Skip', 'pinhole' ),
	'btn-next'                  => esc_html__( 'Next', 'pinhole' ),
	'btn-start'                 => esc_html__( 'Start', 'pinhole' ),
	'btn-no'                    => esc_html__( 'Cancel', 'pinhole' ),
	'btn-plugins-install'       => esc_html__( 'Install', 'pinhole' ),

	'btn-child-install'         => esc_html__( 'Install', 'pinhole' ),
	'btn-content-install'       => esc_html__( 'Install', 'pinhole' ),
	'btn-import'                => esc_html__( 'Import', 'pinhole' ),
	'btn-license-activate'     => esc_html__( 'Activate', 'pinhole' ),
	'btn-license-skip'         => esc_html__( 'Later', 'pinhole' ),
	
	'welcome-header%s'         => esc_html__( 'Welcome to %s', 'pinhole' ),
	'welcome-header-success%s' => esc_html__( 'Hi. Welcome back', 'pinhole' ),
	'welcome%s'                => esc_html__( 'This wizard will set up your theme, install plugins, and import content. It is optional & should take only a few minutes.', 'pinhole' ),
	'welcome-success%s'        => esc_html__( 'You may have already run this theme setup wizard. If you would like to proceed anyway, click on the "Start" button below.', 'pinhole' ),
	
	'license-header%s'         => esc_html__( 'Activate %s', 'pinhole' ),
	'license-header-success%s' => esc_html__( '%s is Activated', 'pinhole' ),
	'license%s'                => esc_html__( 'Enter your license key to enable remote updates and theme support.', 'pinhole' ),
	'license-label'            => esc_html__( 'License key', 'pinhole' ),
	'license-success%s'        => esc_html__( 'The theme is already registered, so you can go to the next step!', 'pinhole' ),
	'license-json-success%s'   => esc_html__( 'Your theme is activated! Remote updates and theme support are enabled.', 'pinhole' ),
	'license-tooltip'          => esc_html__( 'Need help?', 'pinhole' ),
	
	'child-header'         => esc_html__( 'Install Child Theme', 'pinhole' ),
	'child-header-success' => esc_html__( 'You\'re good to go!', 'pinhole' ),
	'child'                => esc_html__( 'Let\'s build & activate a child theme so you may easily make theme changes.', 'pinhole' ),
	'child-success%s'      => esc_html__( 'Your child theme has already been installed and is now activated, if it wasn\'t already.', 'pinhole' ),
	'child-action-link'    => esc_html__( 'Learn about child themes', 'pinhole' ),
	'child-json-success%s' => esc_html__( 'Awesome. Your child theme has already been installed and is now activated.', 'pinhole' ),
	'child-json-already%s' => esc_html__( 'Awesome. Your child theme has been created and is now activated.', 'pinhole' ),
	
	'plugins-header'         => esc_html__( 'Install Plugins', 'pinhole' ),
	'plugins-header-success' => esc_html__( 'You\'re up to speed!', 'pinhole' ),
	'plugins'                => esc_html__( 'Let\'s install some essential WordPress plugins to get your site up to speed.', 'pinhole' ),
	'plugins-success%s'      => esc_html__( 'The required WordPress plugins are all installed and up to date. Press "Next" to continue the setup wizard.', 'pinhole' ),
	'plugins-action-link'    => esc_html__( 'Plugins', 'pinhole' ),
	
	'import-header'      => esc_html__( 'Import Content', 'pinhole' ),
	'import'             => esc_html__( 'Let\'s import content to your website, to help you get familiar with the theme.', 'pinhole' ),
	'import-action-link' => esc_html__( 'Details', 'pinhole' ),
	
	'ready-header'      => esc_html__( 'All done. Have fun!', 'pinhole' ),
	'ready%s'           => esc_html__( 'Your theme has been all set up. Enjoy your new theme by %s.', 'pinhole' ),
	'ready-action-link' => esc_html__( 'Extras', 'pinhole' ),
	'ready-big-button'  => esc_html__( 'View your website', 'pinhole' ),
	
	'ready-link-3' => '',
	'ready-link-2' => wp_kses( sprintf( '<a href="%1$s" target="_blank">%2$s</a>', 'https://mekshq.com/documentation/pinhole/', esc_html__( 'Theme Documentation', 'pinhole' ) ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ),
);

if(pinhole_is_redux_active()){
	$strings['ready-link-1'] = wp_kses( sprintf( '<a href="'.admin_url( 'admin.php?page=pinhole_options' ).'" target="_blank">%s</a>', esc_html__( 'Start Customizing', 'pinhole' ) ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) );
}

/**
 * Set directory locations, text strings, and other settings for Merlin WP.
 *
 * @since 1.0
 */
$pinhole_wizard = new Merlin(

	// Configure Merlin with custom settings.
	$config = array(
		'directory'            => 'inc/merlin', // Location / directory where Merlin WP is placed in your theme.
		'merlin_url'           => 'pinhole-importer', // The wp-admin page slug where Merlin WP loads.
		'parent_slug'          => 'themes.php', // The wp-admin parent page slug for the admin menu item.
		'capability'           => 'manage_options', // The capability required for this menu to be displayed to the user.
		'child_action_btn_url' => 'https://codex.wordpress.org/child_themes', // URL for the 'child-action-link'.
		'dev_mode'             => false, // Enable development mode for testing.
		'license_step'         => false, // EDD license activation step.
		'license_required'     => false, // Require the license activation step.
		'license_help_url'     => '', // URL for the 'license-tooltip'.
		'edd_remote_api_url'   => '', // EDD_Theme_Updater_Admin remote_api_url.
		'edd_item_name'        => '', // EDD_Theme_Updater_Admin item_name.
		'edd_theme_slug'       => '', // EDD_Theme_Updater_Admin item_slug.
		'ready_big_button_url' => get_home_url(), // Link for the big button on the ready step.
	),

	// Text strings.
	$strings

);


/**
 * Prepare files to import
 *
 * @since 1.0
 */
add_filter( 'merlin_import_files', 'pinhole_demo_import_files' );

if(!function_exists('pinhole_demo_import_files')):
	function pinhole_demo_import_files() {
			return array(
				array(
					'import_file_name'         => 'Pinhole default',
					'local_import_file'          => get_parent_theme_file_path( '/inc/demos/01_default/content.xml'),
					'local_import_widget_file'   => get_parent_theme_file_path( '/inc/demos/01_default/widgets.json'),
					'local_import_redux'       => array(
						array(
							'file_path'    => get_parent_theme_file_path( '/inc/demos/01_default/options.json'),
							'option_name' => 'pinhole_settings',
						)
					),
					'import_preview_image_url' => get_parent_theme_file_uri( '/screenshot.png' ),
					'import_notice'            => '',
					'preview_url'              => 'https://demo.mekshq.com/pinhole/',
				)
			);
	}
endif;

/**
 * Execute custom code after the whole import has finished.
 *
 * @since 1.0
 */
add_action( 'merlin_after_all_import', 'pinhole_merlin_after_import_setup' );
if(!function_exists('pinhole_merlin_after_import_setup')):
	
	function pinhole_merlin_after_import_setup( ) {
		

        /* Set Menus */

        $menus = array();

        $main_menu = get_term_by( 'name', 'Main menu', 'nav_menu' );
        if ( isset( $main_menu->term_id ) ) {
            $menus['pinhole_main_menu'] = $main_menu->term_id;
        }

        $social_menu = get_term_by( 'name', 'Social menu', 'nav_menu' );
        if ( isset( $social_menu->term_id ) ) {
            $menus['pinhole_social_menu'] = $social_menu->term_id;
        }

        if ( !empty( $menus ) ) {
            set_theme_mod( 'nav_menu_locations', $menus );
        }


        /* Set Home & Blog Page */

        $home_page_title = 'Home 1';

        $page = get_page_by_title( $home_page_title );

        if ( isset( $page->ID ) ) {
            update_option( 'page_on_front', $page->ID );
            update_option( 'show_on_front', 'page' );
        }

        $blog_page_title = 'Blog';

        $page = get_page_by_title( $blog_page_title );

        if ( isset( $page->ID ) ) {
            update_option( 'page_for_posts', $page->ID );
            update_option( 'show_on_front', 'page' );
        }


	}

endif;

/**
 * Unset the default widgets
 *
 * @return array
 * @since 1.0
 */

add_action('merlin_widget_importer_before_widgets_import', 'pinhole_remove_widgets_before_import');

if(!function_exists('pinhole_remove_widgets_before_import')):
	function pinhole_remove_widgets_before_import() {
		delete_option( 'sidebars_widgets' );	
	}
endif;


/**
 * Unset the child theme generator step in merlin welcome panel
 *
 * @param $steps
 * @return mixed
 * @since 1.0
 */

add_filter('pinhole_merlin_steps', 'pinhole_remove_child_theme_generator_from_merlin');

if(!function_exists('pinhole_remove_child_theme_generator_from_merlin')):
    function pinhole_remove_child_theme_generator_from_merlin($steps){
        unset($steps['child']);
        return $steps;
    }
endif;


/**
 * Stop initial redirect after theme is activated
 *
 * @since 1.0
 */

remove_action( 'after_switch_theme', array( $pinhole_wizard, 'switch_theme' ) );
?>