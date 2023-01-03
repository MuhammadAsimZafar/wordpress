<?php

/**
 * Load embedded Redux Framework
 */

if ( ! class_exists( 'Redux' ) ) {
    return;
}

/**
 * Redux params
 */

$opt_name = 'pinhole_settings';

$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => wp_kses( sprintf( __( 'Pinhole Options%sTheme Documentation%s', 'pinhole' ), '<a href="https://mekshq.com/documentation/pinhole" target="_blank">', '</a>' ), wp_kses_allowed_html( 'post' )),
    'display_version'      => pinhole_get_update_notification(),
    'menu_type'            => 'menu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__( 'Theme Options', 'pinhole' ),
    'page_title'           => esc_html__( 'Pinhole Options', 'pinhole' ),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    'admin_bar'            => true,
    'admin_bar_icon'       => 'dashicons-admin-generic',
    'admin_bar_priority'   => '100',
    'global_variable'      => '',
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => false,
    'allow_tracking' => false,
    'ajax_save' => false,
    'page_priority'        => '27.11',
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            => 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMjYuOCA2ODAuMyI+PHBhdGggZmlsbD0iIzlGQTRBOSIgZD0iTTE3MyAzMTAuMmMuNi0uOCAxLjMtMS44LjctMi45LjYtMi4xIDEuMS00LjIgMy4xLTUuMy44LS40IDEuNC0xLjEgMi0yIDMuNS01LjYgNS42LTExLjYgNy4zLTE4IC4xLS43LjMtMS41IDAtMi4yLS42LTEuNS0uNC0zLjEtLjQtNC42IDAtMi41LS4zLTQuOS0xLjMtNy4zLS40LTEuMy0xLjEtMi4xLTIuNC0yLjgtMS41LS43LTIuOS0xLjUtNC41LTIuNC0yLTEtNC0xLjMtNi4zLTEtNCAuNC04LjEuMy0xMi0uNi04LjUtMS43LTE3LjItMS43LTI1LjgtMS41LTcuMy4xLTE0LjQgMS43LTIxLjQgMy41LTEuMy4zLTIuNC43LTMuNiAxLTMuNS43LTYuOCAxLjgtMTAuMiAzLjItMi4yIDEtNC42IDEuNy03IDIuNy0zLjQgMS4zLTYuNCAzLjEtOS41IDQuNy02LjMgMy42LTEyLjEgOC0xNy43IDEyLjYtMy44IDMuMi03LjEgNi44LTEwLjYgMTAuMy0xLjUgMS41LTIuOSAzLjItNC4zIDQuOS0zLjYgNC43LTUuNiAxMC4zLTUuNiAxNi4zIDAgNi42IDIuMiAxMi40IDYuNyAxNy4zIDIgMi4yIDMuNCA0LjcgNC41IDcuNCAwIC4xLS4zLjYtLjQuNy0xLjcuMy0zLjEtLjEtNC4zLTEuMy0yLjUtMi4yLTQuOS00LjYtNi44LTcuNC0uNy0xLTEuNC0yLjEtMi40LTIuOC0xLjctMS4zLTIuOC0yLjgtMy44LTQuNi0yLjItMy45LTMuOS04LjEtNS0xMi40LS4zLTEuMS0uNi0yLjQtLjYtMy42IDAtMi45LjEtNS45LjMtOC44IDAtLjcuMy0xLjUuNC0yLjIuNi0xLjggMS4zLTMuNSAyLTUuMi42LTEuNSAxLjMtMi45IDIuNC0zLjkgMi43LTIuMiA0LjctNC43IDYuNi03LjcgMS0xLjQgMi4xLTIuNyAzLjQtMy44IDMuNC0zLjEgNi42LTYuMSAxMC4xLTguOSAyLjgtMi40IDUuOS00LjUgOS4xLTYuNCAyLjctMS41IDUuMi0zLjQgNy44LTQuOSAzLjItMS44IDYuNi0zLjUgOS45LTQuOSAzLjUtMS40IDYuOC0yLjkgMTAuMy00IDIuNy0uOCA1LTIuMiA3LjgtMi44IDQuNS0xLjEgOC45LTIuNCAxMy40LTMuNi42LS4xIDEuMy0uMSAxLjgtLjMgMy41LS40IDctMSAxMC42LTEuNSAxLjgtLjMgMy42LS4zIDUuNC43IDEuNS44IDIgMS44IDEuNCAzLjQuOC44IDEuNSAxLjUgMi44IDEuNCAxLjQgMCAxLjUtLjMgMS41LTIuMWwtLjEuMWMuNC0uMS44LS42IDEuMy0uNCAxLjcgMCAzLjIuOCA1IC4xIDEuNC0uNiAyLjktLjMgNC41LS4zLjMgMCAuNy4xLjggMCAyLjItMS43IDQuNS0uNyA2LjYuMSAyIC44IDQgMS40IDYuMSAxLjggMy45LjggNy41IDIuNyAxMS4yIDQuMyAxLjMuNiAyLjUgMS4zIDMuOCAxLjggNC41IDIuMSA4LjcgNC43IDExLjkgOC41LjggMSAxLjggMS43IDIuNyAyLjcgMy44IDQuNiA1LjQgMTAuMSA2LjMgMTUuNi4zIDIuNC0uMSA0LjYtLjggNi44LTEuMyA0LjctMi44IDkuNS01IDE0LTIuMSA0LjItNC42IDgtNi42IDEyLjEtLjcgMS43LTIgMy4xLTMuNSA0LjMtNC42IDMuNi05LjEgNy40LTEzLjUgMTEuMi0uNC40LTEgLjctMS41IDEtNi43IDMuOS0xMy4zIDgtMjAgMTEuOS0xLjMuOC0yLjcgMS41LTQuMiAyLjEtMS40LjQtMi45IDEuMS00LjIgMi03LjggNC4yLTE1LjkgNy40LTI0LjIgMTAuNS01LjYgMi4xLTExLjQgMy41LTE3LjUgMy4xLTEgLjQtMS4zIDEuMy0xLjQgMi0xLjUgNC43LTIuOSA5LjQtNC41IDE0LjEtLjggMi41LTEuNyA1LTIuNSA3LjQtMi45IDguOC01LjYgMTcuNi04LjEgMjYuNS0uNyAyLjctMS4zIDUuNC0xLjggOC4xLS4xLjgtLjMgMS44LS40IDIuOC0uNyA0LjktLjQgOS41IDIuNyAxMy43LTEuNyAxLjMtMy4yIDItNS4yLjgtMy44LS42LTctMi4yLTEwLjMtMy44LS44LS40LTEuNS0xLTItMi0uNi0xLjMtMS4xLTIuNS0xLjctMy44LS42LTEuNC0uOC0yLjktLjctNC41LjMtMy4yLjQtNi40IDEuNC05LjYuNy0yLjQuOC00LjkgMS41LTcuMyAxLjQtNSAzLjEtMTAuMSA0LjUtMTUuMS43LTIuNCAxLjUtNC43IDIuNS03IC44LTEuOCAxLjQtMy44IDEuNy01LjcuMS0xIC4xLTEuOC42LTIuNyAxLjgtNCAyLjctOC41IDQuMy0xMi43IDEuNy0zLjkgMi40LTggMy41LTEyIDEuMS0zLjkgMi43LTcuNSA0LTExLjMgMS44LTQuNyAzLjUtOS42IDUuMy0xNC4yIDIuNS02LjQgNS4zLTEyLjggNy44LTE5LjMgMS44LTQuNyAzLjgtOS41IDYtMTQuMS4zLS42LjctMS4xLjctMS43LjQtMy4yIDItNi4xIDIuOS05LjIuMy0xLjEuOC0xLjcgMS44LTEuOCAyLjUtLjYgNC45LS43IDcuMSAxLjEuNC40IDEuMS42IDEuNy43IDIuNS44IDQgMi43IDUuNCA0LjcgMSAxLjQgMSAyLjkuNiA0LjUtLjEuNC0uMy44LS42IDEuMy0xLjggMy45LTMuNiA3LjgtNS4zIDExLjctLjcgMS40LTEuMyAyLjgtMiA0LjItLjQuOC0uNyAxLjctMS4xIDIuNS0xLjggMy44LTMuOSA3LjQtNSAxMS40LTMuNCA2LjgtNS42IDE0LTguNSAyMC45LTEuMyAyLjktMiA2LjEtMi45IDkuMi0uMS40LS4zIDEgLjMgMS4zLjQuMSAxIC4zIDEuMy4xIDIuOC0xIDUuNC0yLjEgOC4yLTMuMSA2LjMtMi4yIDEyLjEtNS4yIDE4LjItOC4xIDUuNi0yLjggMTEuMy01LjcgMTYuOC04LjkgNS4yLTMuMSAxMC4yLTYuNCAxNS4yLTkuOCAzLjQtMi4yIDYuNi00LjYgOS42LTcuMyAxLjEtMSAyLjItMS43IDMuNi0xLjgtLjEuNC0uMy44LS4zIDEuMyAwIC4xLjEuMy4zLjMuNi4xLjctLjQgMS0uNy4zLS4zLjEtLjQtLjMtLjYtLjMgMC0uNi0uMy0uOC0uMy0uNC0uNCAwLTEuMi40LTEuOXpNNTQuOSAyODEuNmMtLjEgMCAwIC4zIDAgLjQuMS40LjMuNi42LjMuNi0uNCAxLjEtLjggMS44LTEuNC0xLjMtLjctMS43LjMtMi40Ljd6bTguOC0zLjVzLjEtLjEuMy0uMWMtLjQgMC0uNy0uMS0xLjEtLjEuNy0uNiAxLjMtMS40IDIuMS0xLjggMS44LS44IDMuMS0yLjIgNC4zLTMuOC4zLS4zLjMtLjYtLjEtLjgtMS44IDEtMy42IDItNS4zIDMuMS0xIC43LTEuNyAxLjctMi40IDIuNy0uMS4xLjEuNC4zLjdoLjRjLjMtLjEuNi0uMS44LS4zLjEuMS40LjIuNy40em0zOC4yIDQxLjJjLS43LTEuOCAxLjMtMS43IDItMi43LS42LTEtMS4xLTItMS44LTMuNC0uOCAxLjQtMi4xIDIuNC0yLjUgMy45LS43IDIuNC0xLjQgNC42LTIuNSA2LjgtLjYgMS4zLS43IDIuNy0uNiA0LS4zLjMtLjguNi0xIDEtMS4xIDMuMi0zLjEgNi0zLjkgOS40LTIuNyAzLjktMi43IDguOC00LjIgMTMuMS0uMS42LS4xIDEuMy0uMSAxLjggMCAxIDAgMS44LS4xIDIuOC0uMyAxLjgtLjQgMy44LTIuNSA0LjUtLjQuMS0uNyAxLTEgMS40LS40LjgtLjQgMS44LTEuNSAyLjItLjYuMy0uMy43LS4zIDEuMy40IDIuNyAwIDQuOS0yLjQgNi40LS4zLjEtLjYuNy0uNyAxLjEtLjMgMS4xLS40IDIuMS4xIDMuMi4zLjYuMSAxLjEtLjEgMS44LS43IDEuNS0xLjggMi45LTIuMSA0LjYtLjMgMS41LS44IDIuOS0yIDQtMS4xIDEuMS0xLjcgMi4xLTEuMSAzLjYuMS42LS4xIDEuMy0uNCAxLjgtLjQuOC0uOCAxLjUtMS4xIDIuNS0uNyAyLTEuNyAzLjktMS4xIDYuMS0xLjQgMi4yLS44IDQuNy0uOCA3LjEtMS4xIDEuNC0yLjEgMi44LTMuNCA0LjV2OC4xcy4xLjEuNC4xYy4zLS4zLjctLjYuOC0xIC4zLTEuMS4zLTIuNSAxLjEtMy41IDEuMy0xLjUuNi0zLjYgMS41LTUuMi0uMS0xLS40LTIuMS0uNi0zLjEuOC4xIDEuNy4xIDEuNy0xcy40LTIuMSAxLjMtMi45Yy44LTEgMS0xLjggMC0yLjgtLjEtLjEtLjMtLjctLjMtLjggMS4zLTEuMy42LTMuNCAxLjgtNC42LjYtLjYuOC0xLjMgMS0yLjEuMS0xLjEuNi0yIDEuMy0yLjkuNi0uNy44LTEuNSAxLjMtMi41LjctMS43IDEuMy0zLjUgMS44LTUuMiAxLS42IDEtMS4zIDEtMi40LjEtMiAwLTQgMS4zLTUuNy4zLS40LjMtLjguNC0xLjMuNC0yIDEuMy0zLjggMi43LTUuMy44LTEgMS40LTIuMS44LTMuNC0uNC0xIDAtMS44LjctMi41IDEuMy0xLjUgMS44LTMuMSAxLjMtNSAuNC0xLjcgMC0zLjUuOC01LjIuNi0xLjQuNy0yLjkgMS4xLTQuMyAxLjgtMS4zIDEuOC0xLjMgMS43LTIuOC0uMS0uOC0uMS0xLjUuMy0yLjIuNy0xLjQgMS40LTIuNyAyLjEtNCAuNC0uMSAxIDAgMS40LS4zLjctLjYtLjEtMS0uMS0xLjUgMC0xLjEuMy0yLjEuNC0zLjIgMC0uMS4xLS4zLjMtLjMuNi0uMSAxLjEtLjMgMS44LS40LS43LS43LTEuMS0xLjEtMS43LTEuOC4xLTEgLjEtMi4xLjMtMy4xLjctLjggMS4zLTEuOCAyLjctMS40LjMgMCAuNy0uNC44LS44LjEtLjYgMC0xLjQuMy0xLjguNC0uNiAxLjMtLjcgMS44LTEuMS42LS40IDEuMS0xLjEgMS41LTEuNy40LS42LjEtMS4xLS40LTEuNC0uNC0uMi0uOC0uNC0xLjMtLjV6bS0xMy4yLTU4LjJjLS4xIDAtLjMuMS0uMy4zIDAgLjMuNy40IDEgLjF2LS4zYy0uMyAwLS42LS4xLS43LS4xem0zLjMtLjlsLjMuM2MuMS0uMS4zLS40LjQtLjZsLS4zLS4zYy0uMS4yLS4yLjUtLjQuNnoiLz48L3N2Zz4=',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'pinhole_options',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => false,
    'output_tag'           => true,
    'database'             => '',
    'system_info'          => false
);

$GLOBALS['redux_notice_check'] = 1;

/* Footer social icons */

$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/mekshq',
    'title' => 'Like us on Facebook',
    'icon'  => 'el-icon-facebook'
);

$args['share_icons'][] = array(
    'url'   => 'http://twitter.com/mekshq',
    'title' => 'Follow us on Twitter',
    'icon'  => 'el-icon-twitter'
);

$args['intro_text'] = '';
$args['footer_text'] = '';


/**
 * Initialize Redux
 */

Redux::setArgs( $opt_name , $args );


/**
 * Include redux option fields (settings)
 */

include_once get_parent_theme_file_path( '/core/admin/options-fields.php' );


/**
 * Check if there is available theme update
 *
 * @return string HTML output with update notification and the link to change log
 * @since  1.0
 */


function pinhole_get_update_notification() {
    $current = get_site_transient( 'update_themes' );
    $message_html = '';
    if ( isset( $current->response['pinhole'] ) ) {
        $message_html = '<span class="update-message">New update available!</span>
            <span class="update-actions">Version '.$current->response['pinhole']['new_version'].': <a href="https://mekshq.com/docs/pinhole-change-log" target="blank">See what\'s new</a><a href="'.admin_url( 'update-core.php' ).'">Update</a></span>';
    } else {
        $message_html = '<a class="theme-version-label" href="https://mekshq.com/docs/pinhole-change-log" target="blank">Version '.PINHOLE_THEME_VERSION.'</a>';
    }

    return $message_html;
}


/**
 * Append custom css to redux framework admin panel
 *
 * @since  1.0
 */

if ( !function_exists( 'pinhole_redux_custom_css' ) ):
    function pinhole_redux_custom_css() {
        wp_register_style( 'pinhole-redux-custom', get_parent_theme_file_uri( '/assets/css/admin/options.css' ), array( 'redux-admin-css' ), PINHOLE_THEME_VERSION, 'all' );
        wp_enqueue_style( 'pinhole-redux-custom' );
    }
endif;

add_action( 'redux/page/pinhole_settings/enqueue', 'pinhole_redux_custom_css' );


/**
 * Remove redux framework admin page
 *
 * @since  1.0
 */

if ( !function_exists( 'pinhole_remove_redux_page' ) ):
    function pinhole_remove_redux_page() {
        remove_submenu_page( 'tools.php', 'redux-about' );
    }
endif;

add_action( 'admin_menu', 'pinhole_remove_redux_page', 99 );

/* Prevent redux auto redirect */
update_option( 'redux_version_upgraded_from', 100 );


/* More redux cleanup, blah... */

add_action( 'init', 'pinhole_redux_cleanup' );

if ( !function_exists( 'pinhole_redux_cleanup' ) ):
	function pinhole_redux_cleanup() {
		
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
		}
	}
endif;

?>