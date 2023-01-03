<?php

/**
 * Debug (log) function
 *
 * Outputs any content into log file in theme root directory
 *
 * @param mixed   $mixed Content to output
 * @since  1.0
 */

if ( !function_exists( 'pinhole_log' ) ):
    function pinhole_log( $mixed ) {

        if ( !function_exists( 'WP_Filesystem' ) || !WP_Filesystem() ) {
            return false;
        }

        if ( is_array( $mixed ) ) {
            $mixed = print_r( $mixed, 1 );
        } else if ( is_object( $mixed ) ) {
                ob_start();
                var_dump( $mixed );
                $mixed = ob_get_clean();
            }

        global $wp_filesystem;
        $existing = $wp_filesystem->get_contents(  get_parent_theme_file_path( 'log' ) );
        $wp_filesystem->put_contents( get_parent_theme_file_path( 'log' ), $existing. $mixed . PHP_EOL );
    }
endif;

/**
 * Get option value from theme options
 *
 * A wrapper function for WordPress native get_option()
 * which gets an option from specific option key (set in theme options panel)
 *
 * @param string  $option Name of the option
 * @param string  $format How to parse the option based on its type
 * @return mixed Specific option value or "false" (if option is not found)
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_option' ) ):
    function pinhole_get_option( $option, $format = false ) {

        global $pinhole_settings;

        if ( empty( $pinhole_settings ) ) {
            $pinhole_settings = get_option( 'pinhole_settings' );
        }

        if ( !isset( $pinhole_settings[$option] ) ) {
            $pinhole_settings[$option] = pinhole_get_default_option( $option );
        }


        if ( empty( $format ) ) {
            return $pinhole_settings[$option];
        }

        switch ( $format ) {

        case 'image' :
            $value = is_array( $pinhole_settings[$option] ) && isset( $pinhole_settings[$option]['url'] ) ? $pinhole_settings[$option]['url'] : '';
            break;
        case 'multi':
            $value = is_array( $pinhole_settings[$option] ) && !empty( $pinhole_settings[$option] ) ? array_keys( array_filter( $pinhole_settings[$option] ) ) : array();
            break;
        default:
            $value = false;
            break;
        }

        return $value;

    }
endif;


/**
 * Check if RTL mode is enabled
 *
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'pinhole_is_rtl' ) ):
    function pinhole_is_rtl() {

        if ( pinhole_get_option( 'rtl_mode' ) ) {
            $rtl = true;
            //Check if current language is excluded from RTL
            $rtl_lang_skip = explode( ",", pinhole_get_option( 'rtl_lang_skip' ) );
            if ( !empty( $rtl_lang_skip ) ) {
                $locale = get_locale();
                if ( in_array( $locale, $rtl_lang_skip ) ) {
                    $rtl = false;
                }
            }
        } else {
            $rtl = false;
        }

        return $rtl;
    }
endif;


/**
 * Generate dynamic css
 *
 * Function parses theme options and generates css code dynamically
 *
 * @return string Generated css code
 * @since  1.0
 */

if ( !function_exists( 'pinhole_generate_dynamic_css' ) ):
    function pinhole_generate_dynamic_css() {
        ob_start();
        get_template_part( 'assets/css/dynamic-css' );
        $output = ob_get_contents();
        ob_end_clean();
        return pinhole_compress_css_code( $output );
    }
endif;


/**
 * Generate dynamic editor css
 *
 * Function parses theme options and generates css code dynamically
 *
 * @return string Generated css code
 * @since  1.0
 */
if ( !function_exists( 'pinhole_generate_dynamic_editor_css' ) ):
	function pinhole_generate_dynamic_editor_css() {
		ob_start();
		get_template_part( 'assets/css/admin/dynamic-editor-css' );
		$output = ob_get_contents();
		ob_end_clean();
		$output = pinhole_compress_css_code( $output );

		return $output;
	}
endif;


/**
 * Get JS settings
 *
 * Function creates list of settings from thme options to pass
 * them to global JS variable so we can use it in JS files
 *
 * @return array List of JS settings
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_js_settings' ) ):
    function pinhole_get_js_settings() {
        $js_settings = array();

        $js_settings['rtl_mode'] = pinhole_is_rtl() ? true : false;
        $js_settings['logo'] = pinhole_get_option( 'logo', 'image' );
        $js_settings['logo_retina'] = pinhole_get_option( 'logo_retina', 'image' );
        $js_settings['logo_mobile'] = pinhole_get_option( 'logo_mobile', 'image' );
        $js_settings['logo_mobile_retina'] = pinhole_get_option( 'logo_mobile_retina', 'image' );
        $js_settings['header_sticky'] = pinhole_get_option( 'header_sticky' ) ? true : false;
        $js_settings['header_sticky_offset'] = absint( pinhole_get_option( 'header_sticky_offset' ) );
        $js_settings['header_sticky_up'] = pinhole_get_option( 'header_sticky_up' ) ? true : false;
        $js_settings['disable_right_click'] = pinhole_get_option( 'disable_right_click' ) ? true : false;
        $js_settings['gallery_image_counter'] = pinhole_get_option( 'gallery_image_number' ) ? true : false;
        $js_settings['gallery_image_filename'] = pinhole_get_option( 'gallery_image_filename' ) ? true : false;
        $js_settings['gallery_popup_autoplay'] = pinhole_get_option( 'gallery_popup_autoplay' ) ? true : false;

        return $js_settings;
    }
endif;


/**
 * Get all translation options
 *
 * @return array Returns list of all translation strings available in theme options panel
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_translate_options' ) ):
    function pinhole_get_translate_options() {
        global $pinhole_translate;
        get_template_part( 'core/translate' );
        $translate = apply_filters( 'pinhole_modify_translate_options', $pinhole_translate );
        return $translate;
    }
endif;


/**
 * Generate fonts link
 *
 * Function creates font link from fonts selected in theme options
 *
 * @return string
 * @since  1.0
 */

if ( !function_exists( 'pinhole_generate_fonts_link' ) ):
    function pinhole_generate_fonts_link() {

        $fonts = array();
        $fonts[] = pinhole_get_option( 'main_font' );
        $fonts[] = pinhole_get_option( 'h_font' );
        $fonts[] = pinhole_get_option( 'nav_font' );
        $unique = array(); //do not add same font links
        $native = pinhole_get_native_fonts();
        $protocol = is_ssl() ? 'https://' : 'http://';
        $link = array();

        foreach ( $fonts as $font ) {
            if ( !in_array( $font['font-family'], $native ) ) {
                $temp = array();
                if ( isset( $font['font-style'] ) ) {
                    $temp['font-style'] = $font['font-style'];
                }
                if ( isset( $font['subsets'] ) ) {
                    $temp['subsets'] = $font['subsets'];
                }
                if ( isset( $font['font-weight'] ) ) {
                    $temp['font-weight'] = $font['font-weight'];
                }
                $unique[$font['font-family']][] = $temp;
            }
        }

        $subsets = array( 'latin' ); //latin as default

        foreach ( $unique as $family => $items ) {

            $link[$family] = $family;

            $weight = array( '400' );

            foreach ( $items as $item ) {

                //Check weight and style
                if ( isset( $item['font-weight'] ) && !empty( $item['font-weight'] ) ) {
                    $temp = $item['font-weight'];
                    if ( isset( $item['font-style'] ) && empty( $item['font-style'] ) ) {
                        $temp .= $item['font-style'];
                    }

                    if ( !in_array( $temp, $weight ) ) {
                        $weight[] = $temp;
                    }
                }

                //Check subsets
                if ( isset( $item['subsets'] ) && !empty( $item['subsets'] ) ) {
                    if ( !in_array( $item['subsets'], $subsets ) ) {
                        $subsets[] = $item['subsets'];
                    }
                }
            }

            $link[$family] .= ':' . implode( ",", $weight );
            //$link[$family] .= '&subset='.implode( ",", $subsets );
        }

        if ( !empty( $link ) ) {

            $query_args = array(
                'family' => urlencode( implode( '|', $link ) ),
                'subset' => urlencode( implode( ',', $subsets ) )
            );


            $fonts_url = add_query_arg( $query_args, $protocol . 'fonts.googleapis.com/css' );

            return esc_url_raw( $fonts_url );
        }

        return '';

    }
endif;


/**
 * Get native fonts
 *
 *
 * @return array List of native fonts
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_native_fonts' ) ):
    function pinhole_get_native_fonts() {

        $fonts = array(
            "Arial, Helvetica, sans-serif",
            "'Arial Black', Gadget, sans-serif",
            "'Bookman Old Style', serif",
            "'Comic Sans MS', cursive",
            "Courier, monospace",
            "Garamond, serif",
            "Georgia, serif",
            "Impact, Charcoal, sans-serif",
            "'Lucida Console', Monaco, monospace",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "'MS Sans Serif', Geneva, sans-serif",
            "'MS Serif', 'New York', sans-serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "Tahoma,Geneva, sans-serif",
            "'Times New Roman', Times,serif",
            "'Trebuchet MS', Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif"
        );

        return $fonts;
    }
endif;


/**
 * Get font option
 *
 * @return string Font-family
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_font_option' ) ):
    function pinhole_get_font_option( $option = false ) {

        $font = pinhole_get_option( $option );
        $native_fonts = pinhole_get_native_fonts();
        if ( !in_array( $font['font-family'], $native_fonts ) ) {
            $font['font-family'] = "'" . $font['font-family'] . "'";
        }

        return $font;
    }
endif;


/**
 * Get background
 *
 * @return string background CSS
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_bg_option' ) ):
    function pinhole_get_bg_option( $option = false ) {

        $style = pinhole_get_option( $option );
        $css = '';

        if ( !empty( $style ) && is_array( $style ) ) {
            foreach ( $style as $key => $value ) {
                if ( !empty( $value ) && $key != "media" ) {
                    if ( $key == "background-image" ) {
                        $css .= $key . ":url('" . $value . "');";
                    } else {
                        $css .= $key . ":" . $value . ";";
                    }
                }
            }
        }

        return $css;
    }
endif;


/**
 * Get list of image sizes
 *
 * @return array
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_image_sizes' ) ):
    function pinhole_get_image_sizes() {

        $sizes = array(
            'pinhole-col-1' => array( 'title' => esc_html__( '1 column', 'pinhole' ), 'w' => 1194, 'h' => 9999, 'crop' => false ),
            'pinhole-col-2' => array( 'title' => esc_html__( '2 columns', 'pinhole' ), 'w' => 582, 'h' => 9999, 'crop' => false ),
            'pinhole-col-3' => array( 'title' => esc_html__( '3 columns', 'pinhole' ), 'w' => 378, 'h' => 9999, 'crop' => false ),
            'pinhole-col-4' => array( 'title' => esc_html__( '4 columns', 'pinhole' ), 'w' => 276, 'h' => 9999, 'crop' => false ),
            'pinhole-col-2-square' => array( 'title' => esc_html__( '2 columns - square', 'pinhole' ), 'w' => 582, 'h' => 582, 'crop' => true ),
            'pinhole-col-3-square' => array( 'title' => esc_html__( '3 columns - square', 'pinhole' ), 'w' => 378, 'h' => 378, 'crop' => true ),
            'pinhole-col-4-square' => array( 'title' => esc_html__( '4 columns square', 'pinhole' ), 'w' => 276, 'h' => 276, 'crop' => true ),
            'pinhole-justify' => array( 'title' => esc_html__( 'Justify medium', 'pinhole' ), 'w' => 9999, 'h' => 450, 'crop' => false ),
        );

        $popup_image_size = absint( pinhole_get_option( 'gallery_popup_image_size' ) );
        if ( !empty( $popup_image_size ) ) {
            $sizes['pinhole-popup'] = array( 'title' => esc_html__( 'Gallery popup', 'pinhole' ), 'w' => $popup_image_size, 'h' => $popup_image_size, 'crop' => false );
        }

        $disable_img_sizes = pinhole_get_option( 'disable_img_sizes' );

        if ( !empty( $disable_img_sizes ) ) {
            $disable_img_sizes = array_keys( array_filter( $disable_img_sizes ) );
        }

        if ( !empty( $disable_img_sizes ) ) {
            foreach ( $disable_img_sizes as $size_id ) {
                unset( $sizes['pinhole-' . $size_id] );
            }
        }

        $sizes = apply_filters( 'pinhole_modify_image_sizes', $sizes );

        return $sizes;
    }
endif;

/**
 * Get editor font sizes
 *
 * @since  1.5
 */

if ( !function_exists( 'pinhole_get_editor_font_sizes' ) ):
    function pinhole_get_editor_font_sizes( ) {

        $regular = absint( pinhole_get_option( 'font_size_p' ) );

        $s = $regular  * 0.8;
        $l = $regular * 1.3;
        $xl = $regular * 1.8;

        $sizes = array( array(
                'name'      => esc_html__( 'Small', 'pinhole' ),
                'shortName' => esc_html__( 'S', 'pinhole' ),
                'size'      => $s,
                'slug'      => 'small',
            ),

            array(
                'name'      => esc_html__( 'Normal', 'pinhole' ),
                'shortName' => esc_html__( 'M', 'pinhole' ),
                'size'      => $regular,
                'slug'      => 'normal',
            ),

            array(
                'name'      => esc_html__( 'Large', 'pinhole' ),
                'shortName' => esc_html__( 'L', 'pinhole' ),
                'size'      => $l,
                'slug'      => 'large',
            ),
            array(
                'name'      => esc_html__( 'Huge', 'pinhole' ),
                'shortName' => esc_html__( 'XL', 'pinhole' ),
                'size'      => $xl,
                'slug'      => 'huge',
            )
        );

        $sizes = apply_filters( 'pinhole_modify_editor_font_sizes', $sizes );

        return $sizes;

    }
endif;


/**
 * Get editor colors
 *
 * @since  1.5
 */

if ( !function_exists( 'pinhole_get_editor_colors' ) ):
    function pinhole_get_editor_colors() {

        $colors = array(

            array(
                'name'  => esc_html__( 'Text', 'pinhole' ),
                'slug' => 'pinhole-txt',
                'color' => pinhole_get_option( 'color_txt' ),
            ),
     
            array(
                'name'  => esc_html__( 'Background', 'pinhole' ),
                'slug' => 'pinhole-bg',
                'color' => pinhole_get_option( 'color_bg' ),
            )
        );

        $colors = apply_filters( 'pinhole_modify_editor_colors', $colors );

        return $colors;

    }
endif;

/**
 * Get previous/next posts or galleries
 *
 * @return array Previous and next post ids
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_prev_next_items' ) ):
    function pinhole_get_prev_next_items() {

        $prev = array();
        $next = array();

        if ( is_single() ) {


            $prev_post = get_adjacent_post( true, '', false, 'category' );
            $next_post = get_adjacent_post( true, '', true, 'category' );

            if ( !empty( $prev_post ) ) {
                $prev['id'] = $prev_post;
                $prev['label'] = __pinhole( 'previous_post' );
            }

            if ( !empty( $next_post ) ) {
                $next['id'] = $next_post;
                $next['label'] = __pinhole( 'next_post' );
            }

        } else if ( is_page() && pinhole_has_gallery() ) {

                global $post;

                if ( !empty( $post->post_parent ) ) {

                    $pagelist = get_pages(
                        array(
                            'child_of' => $post->post_parent,
                            'sort_column' => 'menu_order',
                            'sort_order' => 'asc'
                        )
                    );

                    $pagelist = wp_list_pluck( $pagelist, 'ID' );

                    $current = array_search( get_the_ID(), $pagelist );

                    if ( $current - 1 >= 0 ) {
                        $prev['id'] = $pagelist[$current - 1];
                    } else {
                        $prev['id'] = $pagelist[count( $pagelist ) - 1];
                    }

                    if ( $current < count( $pagelist ) - 1 ) {
                        $next['id'] = $pagelist[$current + 1];
                    } else {
                        $next['id'] = $pagelist[0];
                    }

                    if ( !empty( $prev['id'] ) ) {
                        $prev['label'] = __pinhole( 'previous_gallery' );
                    }

                    if ( !empty( $next['id'] ) ) {
                        $next['label'] = __pinhole( 'next_gallery' );
                    }
                }

            }

        if ( empty( $prev ) && empty( $next ) ) {
            return array();
        }

        return array( 'prev' => $prev, 'next' => $next );

    }
endif;


/**
 * Get list of social options
 *
 * Used for user social profiles
 *
 * @return array
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_social' ) ) :
    function pinhole_get_social() {
        $social = array(
            'behance' => 'Behance',
            'delicious' => 'Delicious',
            'deviantart' => 'DeviantArt',
            'digg' => 'Digg',
            'dribbble' => 'Dribbble',
            'facebook' => 'Facebook',
            'flickr' => 'Flickr',
            'github' => 'Github',
            'google' => 'GooglePlus',
            'instagram' => 'Instagram',
            'linkedin' => 'LinkedIN',
            'pinterest' => 'Pinterest',
            'reddit' => 'ReddIT',
            'rss' => 'Rss',
            'skype' => 'Skype',
            'snapchat' => 'Snapchat',
            'slack' => 'Slack',
            'stumbleupon' => 'StumbleUpon',
            'soundcloud' => 'SoundCloud',
            'spotify' => 'Spotify',
            'tumblr' => 'Tumblr',
            'twitter' => 'Twitter',
            'vimeo-square' => 'Vimeo',
            'vk' => 'vKontakte',
            'vine' => 'Vine',
            'weibo' => 'Weibo',
            'wordpress' => 'WordPress',
            'xing' => 'Xing',
            'yahoo' => 'Yahoo',
            'youtube' => 'Youtube'
        );

        return $social;
    }
endif;


/**
 * Get image ID from URL
 *
 * It gets image/attachment ID based on URL
 *
 * @param string  $image_url URL of image/attachment
 * @return int|bool Attachment ID or "false" if not found
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_image_id_by_url' ) ):
    function pinhole_get_image_id_by_url( $image_url ) {
        global $wpdb;

        $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );

        if ( isset( $attachment[0] ) ) {
            return $attachment[0];
        }

        return false;
    }
endif;

/**
 * Calculate reading time by content length
 *
 * @param string  $text Content to calculate
 * @return int Number of minutes
 * @since  1.0
 */

if ( !function_exists( 'pinhole_read_time' ) ):
    function pinhole_read_time( $text ) {

        $words = count( preg_split( "/[\n\r\t ]+/", wp_strip_all_tags( $text ) ) );
        $number_words_per_minute = pinhole_get_option( 'words_read_per_minute' );
        $number_words_per_minute = !empty( $number_words_per_minute ) ? absint( $number_words_per_minute ) : 200;

        if ( !empty( $words ) ) {
            $time_in_minutes = ceil( $words / $number_words_per_minute );
            return $time_in_minutes;
        }

        return false;
    }
endif;


/**
 * Trim chars of a string
 *
 * @param string  $string Content to trim
 * @param int     $limit  Number of characters to limit
 * @param string  $more   Chars to append after trimed string
 * @return string Trimmed part of the string
 * @since  1.0
 */

if ( !function_exists( 'pinhole_trim_chars' ) ):
    function pinhole_trim_chars( $string, $limit, $more = '...' ) {

        if ( !empty( $limit ) ) {

            $text = trim( preg_replace( "/[\n\r\t ]+/", ' ', $string ), ' ' );
            preg_match_all( '/./u', $text, $chars );
            $chars = $chars[0];
            $count = count( $chars );

            if ( $count > $limit ) {

                $chars = array_slice( $chars, 0, $limit );

                for ( $i = ( $limit - 1 ); $i >= 0; $i-- ) {
                    if ( in_array( $chars[$i], array( '.', ' ', '-', '?', '!' ) ) ) {
                        break;
                    }
                }

                $chars = array_slice( $chars, 0, $i );
                $string = implode( '', $chars );
                $string = rtrim( $string, ".,-?!" );
                $string .= $more;
            }

        }

        return $string;
    }
endif;


/**
 * Parse args ( merge arrays )
 *
 * Similar to wp_parse_args() but extended to also merge multidimensional arrays
 *
 * @param array   $a - set of values to merge
 * @param array   $b - set of default values
 * @return array Merged set of elements
 * @since  1.0
 */

if ( !function_exists( 'pinhole_parse_args' ) ):
    function pinhole_parse_args( &$a, $b ) {
        $a = (array)$a;
        $b = (array)$b;
        $r = $b;
        foreach ( $a as $k => &$v ) {
            if ( is_array( $v ) && isset( $r[$k] ) ) {
                $r[$k] = pinhole_parse_args( $v, $r[$k] );
            } else {
                $r[$k] = $v;
            }
        }
        return $r;
    }
endif;


/**
 * Compare two values
 *
 * Fucntion compares two values and sanitazes 0
 *
 * @param mixed   $a
 * @param mixed   $b
 * @return bool Returns true if equal
 * @since  1.0
 */

if ( !function_exists( 'pinhole_compare' ) ):
    function pinhole_compare( $a, $b ) {
        return (string)$a === (string)$b;
    }
endif;


/**
 * Compress CSS Code
 *
 * @param string  $code Uncompressed css code
 * @return string Compressed css code
 * @since  1.0
 */

if ( !function_exists( 'pinhole_compress_css_code' ) ) :
    function pinhole_compress_css_code( $code ) {

        // Remove Comments
        $code = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code );

        // Remove tabs, spaces, newlines, etc.
        $code = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $code );

        return $code;
    }
endif;


/**
 * Check if page/post has a gallery
 *
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'pinhole_has_gallery' ) ):
    function pinhole_has_gallery( $post_id = false ) {

        global $post;

        if ( empty( $post_id ) ) {
            $post_id = get_the_ID();
        }

        $galleries = get_post_galleries_images( $post_id );

        if ( !empty( $galleries ) ) {
            return true;
        }

        if ( function_exists( 'has_block' ) && has_block( 'gallery', $post ) ) {
            return true;
        }

        return false;
    }
endif;

/**
 * Get boostrap column class based on current layout
 *
 * @param string  $layout
 * @param int     $columns
 * @return string
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_column_class' ) ):
    function pinhole_get_column_class( $layout, $columns ) {

        $class = '';

        if ( empty( $layout ) || empty( $columns ) ) {
            return $class;
        }

        if ( $layout == 'justify' ) {

            $class = '';
        } else {

            $class = array();
            $class[] = 'col-xs-12';
            $lg = 12 / $columns;
            $class[] = 'col-lg-' . $lg;
            switch ( $lg ) {

            case 4:
                $class[] = 'col-md-4';
                $class[] = 'col-sm-6';
                break;
            case 3:
                $class[] = 'col-md-4';
                $class[] = 'col-sm-6';
                break;
            case 6:
                $class[] = 'col-md-6';
                $class[] = 'col-sm-6';
                break;
            default:
                break;

            }

            $class = implode( " ", $class );

        }


        return $class;

    }
endif;

/**
 * Get image size for featured images based on current layout
 *
 * @param string  $layout
 * @param int     $columns
 * @param string  $layout_size
 * @return string
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_image_size' ) ):
    function pinhole_get_image_size( $layout, $columns, $layout_size = '' ) {

        if ( empty( $layout ) || empty( $columns ) ) {
            return '';
        }

        $size = $layout != 'justify' ? 'col-' . $columns : 'justify';

        if ( $layout == 'grid' ) {
            $size .= '-square';
        }

        return $size;

    }
endif;


/**
 * Get page meta data
 *
 * @param string  $field specific option array key
 * @return mixed meta data value or set of values
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_page_meta' ) ):
    function pinhole_get_page_meta( $post_id = false, $field = false ) {

        if ( empty( $post_id ) ) {
            $post_id = get_the_ID();
        }

        $defaults = array(
            'galleries' => array(
                'settings' => 'inherit',
                'layout' => pinhole_get_option( 'galleries_layout' ),
                'columns' => pinhole_get_option( 'galleries_columns' ),
                'items' => pinhole_get_option( 'galleries_items' ),
                'layout_size' => pinhole_get_option( 'galleries_layout_size' ),
                'select' => 'hierarchy',
                'ids' => array()
            ),
            'albums' => array(
                'settings' => 'inherit',
                'layout' => pinhole_get_option( 'albums_layout' ),
                'columns' => pinhole_get_option( 'albums_columns' ),
                'items' => pinhole_get_option( 'albums_items' ),
                'layout_size' => pinhole_get_option( 'albums_layout_size' )
            )
        );

        $meta = get_post_meta( $post_id, '_pinhole_meta', true );
        $meta = pinhole_parse_args( $meta, $defaults );


        if ( $field ) {
            if ( isset( $meta[$field] ) ) {
                return $meta[$field];
            } else {
                return false;
            }
        }

        return $meta;
    }
endif;


/**
 * Get archive heading
 *
 * Function gets title and description for current archive template
 *
 * @return array Args
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_archive_heading' ) ):
    function pinhole_get_archive_heading() {


        if ( is_home() && is_front_page() ) {
            return false;
        }

        $defaults = array(
            'title' => '',
            'desc' => ''
        );

        $args = array();

        if ( is_category() ) {

            $args['title'] = __pinhole( 'category' ) . single_cat_title( '', false );
            $args['desc'] = category_description();

        } else if ( is_tag() ) {

                $args['title'] = __pinhole( 'tag' ) . single_tag_title( '', false );
                $args['desc'] = tag_description();

            } else if ( is_author() ) {

                $args['title'] = __pinhole( 'author' ) . get_the_author();

            } else if ( is_tax() ) {

                $args['title'] = __pinhole( 'archive' ) . single_term_title( '', false );

            } else if ( is_search() ) {

                $args['title'] = __pinhole( 'search_results_for' ) . get_search_query();

            } else if ( is_day() ) {

                $args['title'] = __pinhole( 'archive' ) . get_the_date();

            } else if ( is_month() ) {

                $args['title'] = __pinhole( 'archive' ) . get_the_date( 'F Y' );

            } else if ( is_year() ) {

                $args['title'] = __pinhole( 'archive' ) . get_the_date( 'Y' );

            } else if ( is_home() && !is_front_page() && $posts_page = get_option( 'page_for_posts' ) ) {

                $args['title'] = get_the_title( $posts_page );

            } else if ( is_archive() ) {

                $args['title'] = __pinhole( 'archive' );
            }

        return wp_parse_args( $args, $defaults );
    }
endif;


/**
 * Get body background color
 *
 * This function is returning either background for color or background-image for gradient css tag
 *
 * @return string CSS property
 * @since  1.1
 */
if ( !function_exists( 'pinhole_get_background_color' ) ):
    function pinhole_get_background_color() {
        $color_bg = esc_attr( pinhole_get_option( 'color_bg' ) );

        if ( !pinhole_get_option( 'background_gradient' ) )
            return 'background: ' . $color_bg . ';';

        $second_gradient_color = pinhole_get_option( 'background_gradient_color' );
        $hsl_gradient_colors = pinhole_generate_hsl_gradient( $color_bg, $second_gradient_color );
        $orientation = pinhole_get_option( 'background_gradient_orientation' );
        return pinhole_generate_css_gradient_from_hsl( $color_bg, $second_gradient_color, $hsl_gradient_colors, $orientation );
    }
endif;

/**
 * Generate css background gradient attribute
 *
 * @param unknown $start_color
 * @param unknown $end_color
 * @param unknown $hsl_colors
 * @return string
 * @since 1.1
 */
if ( !function_exists( 'pinhole_generate_css_gradient_from_hsl' ) ):
    function pinhole_generate_css_gradient_from_hsl( $start_color, $end_color, $hsl_colors, $orientation = 'to right top' ) {
        $hexes = '';

        foreach ( $hsl_colors as $hsl_color ) {
            $hexes .= ', ' . pinhole_hex_to_rgb( pinhole_hsl_to_rgb( $hsl_color ) );
        }

        if ( !empty( $hexes ) ) {
            $hexes = $hexes . ',';
        }

        if ( $orientation === 'circle' ) {
            return 'background-image: radial-gradient(circle, ' . $start_color . $hexes . $end_color . ');';
        }
        return 'background-image: linear-gradient(' . $orientation . ', ' . $start_color . $hexes . $end_color . ');';
    }
endif;

/**
 * Generating hax gradient
 *
 * It converts everything to rgb calculates steps between gradients and then it converts back gradients to hex.
 *
 * @param unknown $start_color
 * @param unknown $end_color
 * @return string CSS property
 * @since  1.1
 */
if ( !function_exists( 'pinhole_generate_hsl_gradient' ) ):
    function pinhole_generate_hsl_gradient( $start_hex_color, $end_hex_color ) {
        $start_hsl = pinhole_rgb_to_hsl( pinhole_hex_to_rgba( $start_hex_color, false, true ) );
        $end_hsl = pinhole_rgb_to_hsl( pinhole_hex_to_rgba( $end_hex_color, false, true ) );

        if ( absint( $start_hsl[0] - $end_hsl[0] ) > 180 ) {
            if ( $end_hsl[0] == 0 && $start_hsl[0] < 180 ) {
                $end_hsl[0] = 0;
            } elseif ( $end_hsl[0] == 0 && $start_hsl[0] >= 180 ) {
                $end_hsl[0] = 360;
            } elseif ( $start_hsl[0] < 180 && $end_hsl[0] > 180 ) {
                $start_hsl[0] += 360;
            } elseif ( $end_hsl[0] < 180 && $start_hsl[0] > 180 ) {
                $end_hsl[0] += 360;
            }
        }

        if ( $start_hsl[0] > $end_hsl[0] ) {
            $difference_h = absint( $end_hsl[0] - $start_hsl[0] ) / 4;
            $difference_s = ( $end_hsl[1] - $start_hsl[1] ) / 4;
            $difference_l = ( $end_hsl[2] - $start_hsl[2] ) / 4;
            $new_hsl_colors = array(
                array(
                    absint( $start_hsl[0] - $difference_h * 1 ) ,
                    round( $start_hsl[1] + $difference_s * 1, 1 ),
                    round( $start_hsl[2] + $difference_l * 1, 1 ),
                ),
                array(
                    absint( $start_hsl[0] - $difference_h * 2 ),
                    round( $start_hsl[1] + $difference_s * 2, 1 ),
                    round( $start_hsl[2] + $difference_l * 2, 1 ),
                ),
                array(
                    absint( $start_hsl[0] - $difference_h * 3 ),
                    round( $start_hsl[1] + $difference_s * 3, 1 ),
                    round( $start_hsl[2] + $difference_l * 3, 1 ),
                )
            );
        } else {
            $difference_h = absint( ( $start_hsl[0] - $end_hsl[0] ) ) / 4;
            $difference_s = ( $start_hsl[1] - $end_hsl[1] ) / 4;
            $difference_l = ( $start_hsl[2] - $end_hsl[2] ) / 4;
            $new_hsl_colors = array(
                array(
                    absint( $end_hsl[0] - $difference_h * 3 ) ,
                    round( $end_hsl[1] + $difference_s * 3, 1 ),
                    round( $end_hsl[2] + $difference_l * 3, 1 ),
                ),
                array(
                    absint( $end_hsl[0] - $difference_h * 2 ),
                    round( $end_hsl[1] + $difference_s * 2, 1 ),
                    round( $end_hsl[2] + $difference_l * 2, 1 ),
                ),
                array(
                    absint( $end_hsl[0] - $difference_h * 1 ),
                    round( $end_hsl[1] + $difference_s * 1, 1 ),
                    round( $end_hsl[2] + $difference_l * 1, 1 ),
                )
            );
        }

        return $new_hsl_colors;
    }
endif;

/**
 * Convert RGB to HSL color code
 *
 * @param unknown $rgb
 * @return array HSL color
 * @since  1.1
 */
if ( !function_exists( 'pinhole_rgb_to_hsl' ) ):
    function pinhole_rgb_to_hsl( $rgb ) {
        $r = $rgb[0];
        $g = $rgb[1];
        $b = $rgb[2];
        $r /= 255;
        $g /= 255;
        $b /= 255;
        $max = max( $r, $g, $b );
        $min = min( $r, $g, $b );
        $h = 0;
        $s = 0;
        $l = ( $max + $min ) / 2;
        $d = $max - $min;
        if ( $d == 0 ) {
            $h = $s = 0; // achromatic
        } else {
            $s = $d / ( 1 - abs( 2 * $l - 1 ) );
            switch ( $max ) {
            case $r:
                $h = 60 * fmod( ( ( $g - $b ) / $d ), 6 );
                if ( $b > $g ) {
                    $h += 360;
                }
                break;
            case $g:
                $h = 60 * ( ( $b - $r ) / $d + 2 );
                break;
            case $b:
                $h = 60 * ( ( $r - $g ) / $d + 4 );
                break;
            }
        }
        return array( round( $h, 2 ), round( $s, 2 ), round( $l, 2 ) );
    }
endif;

/**
 * Convert HSL to RGB color code
 *
 * @param unknown $hsl
 * @return array RGB color
 * @since  1.1
 */
if ( !function_exists( 'pinhole_hsl_to_rgb' ) ):
    function pinhole_hsl_to_rgb( $hsl ) {
        $h = $hsl[0];
        $s = $hsl[1];
        $l = $hsl[2];
        $c = ( 1 - abs( 2 * $l - 1 ) ) * $s;
        $x = $c * ( 1 - abs( fmod( ( $h / 60 ), 2 ) - 1 ) );
        $m = $l - ( $c / 2 );
        if ( $h < 60 ) {
            $r = $c;
            $g = $x;
            $b = 0;
        } else if ( $h < 120 ) {
                $r = $x;
                $g = $c;
                $b = 0;
            } else if ( $h < 180 ) {
                $r = 0;
                $g = $c;
                $b = $x;
            } else if ( $h < 240 ) {
                $r = 0;
                $g = $x;
                $b = $c;
            } else if ( $h < 300 ) {
                $r = $x;
                $g = 0;
                $b = $c;
            } else {
            $r = $c;
            $g = 0;
            $b = $x;
        }
        $r = ( $r + $m ) * 255;
        $g = ( $g + $m ) * 255;
        $b = ( $b + $m ) * 255;
        return array( floor( $r ), floor( $g ), floor( $b ) );
    }
endif;

/**
 * Hex to rgba
 *
 * Convert hexadecimal color to rgba
 *
 * @param string  $color   Hexadecimal color value
 * @param float   $opacity Opacity value
 * @return string RGBA color value
 * @since  1.0
 */

if ( !function_exists( 'pinhole_hex_to_rgba' ) ):
    function pinhole_hex_to_rgba( $color, $opacity = false, $raw = false ) {
        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if ( empty( $color ) )
            return $default;

        //Sanitize $color if "#" is provided
        if ( $color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if ( strlen( $color ) == 6 ) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map( 'hexdec', $hex );

        if ( $raw )
            return $rgb;

        //Check if opacity is set(rgba or rgb)
        if ( $opacity !== false ) {
            if ( abs( $opacity ) > 1 ) {
                $opacity = 1.0;
            }
            $output = 'rgba(' . implode( ",", $rgb ) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode( ",", $rgb ) . ')';
        }

        //Return rgb(a) color string
        return $output;
    }
endif;

/**
 *
 */
if ( !function_exists( 'pinhole_rgb_to_hex' ) ):
    function pinhole_rgb_to_hex( $rgb ) {
        return str_pad( dechex( $rgb * 255 ), 2, '0', STR_PAD_LEFT );
    }
endif;

/**
 * It converts hex to rgb color mode.
 *
 * Function gets title and description for current archive template
 *
 * @param unknown $color_array
 * @return string
 * @since  1.1
 */
if ( !function_exists( 'pinhole_hex_to_rgb' ) ):
    function pinhole_hex_to_rgb( $color_array ) {
        return sprintf( "#%02x%02x%02x", $color_array[0], $color_array[1], $color_array[2] );
    }
endif;


/**
 * Extracts color from sting, hex to rgb
 *
 * Basically it's used for preparing for converting hex to rgb
 *
 * @param unknown $color
 * @return array
 * @since  1.1
 */
if ( !function_exists( 'pinhole_extract_color_array_from_string' ) ):
    function pinhole_extract_color_array_from_string( $color ) {
        if ( $color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if ( strlen( $color ) == 6 ) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } else {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        }

        return $hex;
    }
endif;


/**
 * Get formatted image meta data
 *
 * Format image meta data from database
 *
 * @param unknown $gallery_params
 * @param unknown $image_meta
 * @return array
 */
if ( !function_exists( 'pinhole_get_image_meta' ) ):

    function pinhole_get_image_meta( $gallery_params, $image_meta ) {

        $image_info = array();

        if ( empty( $gallery_params['image_meta'] ) ) {
            return $image_info;
        }

        if ( !isset( $image_meta['image_meta'] ) || empty( $image_meta['image_meta'] ) ) {
            return $image_info;
        }

        foreach ( $gallery_params['image_meta'] as $meta_key ) {

            if ( array_key_exists( $meta_key, $image_meta['image_meta'] ) && !empty( $image_meta['image_meta'][$meta_key] ) ) {

                $meta = $image_meta['image_meta'][$meta_key];

                switch ( $meta_key ) {
                case 'focal_length':
                    $meta .= 'mm';
                    $label = __pinhole( 'focal_length' );
                    break;
                case 'shutter_speed':
                    $label = __pinhole( 'shutter_speed' );
                    if ( $meta >= 1 ) {
                        $meta = ( round( $meta * 10 ) / 10 ) . 's';
                    } else {
                        $denominator = round( 1 / $meta );
                        $meta = '1/' . $denominator . 's';
                    }
                    break;
                case 'aperture':
                    $label = __pinhole( 'aperture' );
                    $meta = 'f/' . $meta;
                    break;
                case 'camera':
                    $label = __pinhole( 'camera' );
                    break;
                case 'iso':
                    $label = 'ISO';
                    break;
                case 'credit':
                    $label = __pinhole( 'credit' );
                    break;
                case 'copyright':
                    $label = __pinhole( 'copyright' );
                    break;
                default:
                    break;
                }
                $image_info[$meta] = $label . ': ' . $meta;
            }
        }

        return $image_info;
    }
endif;

/**
 * Trim text characters with UTF-8
 * for adding to html attributes it's not breaking the code and
 * you are able to have all the kind of characters (Japanese, Cyrillic, German, French, etc.)
 *
 * @param unknown $text
 * @since  1.3
 */
if ( !function_exists( 'pinhole_esc_text' ) ):
    function pinhole_esc_text( $text ) {
        return rawurlencode( html_entity_decode( wp_kses( $text, null ), ENT_COMPAT, 'UTF-8' ) );
    }
endif;

/**
 * Trims URL with special characters like used in (Japanese, Cyrillic, German, French, etc.)
 *
 * @param unknown $url
 * @since  1.3
 */
if ( !function_exists( 'pinhole_esc_url' ) ):
    function pinhole_esc_url( $url ) {
        return rawurlencode( esc_url( esc_attr( $url ) ) );
    }
endif;

/**
 * Check if is Gutenberg page
 *
 * @return bool
 * @since  1.3.1
 */
if ( !function_exists( 'pinhole_is_gutenberg_page' ) ):
    function pinhole_is_gutenberg_page() {

        if ( function_exists( 'is_gutenberg_page' ) ) {
            return is_gutenberg_page();
        }

        global $wp_version;

        if ( version_compare( $wp_version, '5', '<' ) ) {
            return false;
        }

		global $current_screen;

		if ( ( $current_screen instanceof WP_Screen ) && !$current_screen->is_block_editor() ) {
			return false;
		}

        return true;
    }
endif;


/**
 * Check if is Gutenberg exists
 *
 * @return bool
 * @since  1.3.2
 */
if ( !function_exists( 'pinhole_has_gutenberg' ) ):
    function pinhole_has_gutenberg() {

        if ( !function_exists( 'register_block_type' ) ) {
            return false;
        }
        return true;
    }
endif;


/**
 * Check which function for parsing blocks is used
 *
 * @return bool
 * @since  1.3.2
 */
if ( !function_exists( 'pinhole_which_parse_blocks' ) ):
    function pinhole_which_parse_blocks() {

        //Gutenberg plugin
        if ( function_exists( 'gutenberg_parse_blocks' ) ) {
            return 'gutenberg_parse_blocks';
        }

        //WP 5.0
        if ( function_exists( 'parse_blocks' ) ) {
            return 'parse_blocks';
        }

        return '';
    }
endif;

/**
 * Function for escaping through WordPress's KSES API
 * wp_kses() and wp_kses_allowed_html()
 *
 * @param string $content
 * @param bool $echo 
 * @return string 
 * @since  1.2
 */
if ( !function_exists( 'pinhole_wp_kses' ) ):
	function pinhole_wp_kses( $content, $echo = false ) {

		$allowed_tags = wp_kses_allowed_html('post');
		$allowed_tags['img']['srcset'] = array();
		$allowed_tags['img']['sizes'] = array();

		$tags = apply_filters('pinhole_wp_kses_allowed_html', $allowed_tags);

		if ( !$echo ) {
			return wp_kses( $content, $tags );
		}

		echo wp_kses( $content, $tags );

	}
endif;

?>