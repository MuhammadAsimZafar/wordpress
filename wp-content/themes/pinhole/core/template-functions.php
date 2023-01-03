<?php

/**
 * Wrapper function for __()
 *
 * It checks if specific text is translated via options panel
 * If option is set, it returns translated text from theme options
 * If option is not set, it returns default translation string (from language file)
 *
 * @param string  $string_key Key name (id) of translation option
 * @return string Returns translated string
 * @since  1.0
 */

if ( !function_exists( '__pinhole' ) ):
	function __pinhole( $string_key ) {
		if ( ( $translated_string = pinhole_get_option( 'tr_'.$string_key ) ) && pinhole_get_option( 'enable_translate' ) ) {

			if ( $translated_string == '-1' ) {
				return '';
			}

			return wp_kses_post( $translated_string );

		} else {
			$translate = pinhole_get_translate_options();
			return wp_kses_post( $translate[$string_key]['text'] );
		}
	}
endif;


/**
 * Get featured image
 *
 * Function gets featured image depending on the size and post id.
 * If image is not set, it gets the default featured image placehloder from theme options.
 *
 * @param string  $size               Image size ID
 * @param bool    $ignore_default_img Wheter to apply default featured image if post doesn't have featured image
 * @param bool    $ignore_size_prefix Wheter to pass exact size or apply theme prefix
 * @return string Image HTML output
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_featured_image' ) ):
	function pinhole_get_featured_image( $size = 'large', $ignore_default_img = false, $ignore_size_prefix = false ) {

		$post_id = get_the_ID();

		if ( !$ignore_size_prefix ) {
			$size = 'pinhole-'.$size;
		}

		if ( has_post_thumbnail( $post_id ) ) {

			return get_the_post_thumbnail( $post_id, $size );

		} else if ( !$ignore_default_img && ( $placeholder = pinhole_get_option( 'default_fimg', 'image' ) ) ) {

				//If there is no featured image, try to get default from theme options

				global $placeholder_img, $placeholder_imgs;

				if ( empty( $placeholder_img ) ) {
					$img_id = pinhole_get_image_id_by_url( $placeholder );
				} else {
					$img_id = $placeholder_img;
				}

				if ( !empty( $img_id ) ) {
					if ( !isset( $placeholder_imgs[$size] ) ) {
						$def_img = wp_get_attachment_image( $img_id, $size );
					} else {
						$def_img = $placeholder_imgs[$size];
					}

					if ( !empty( $def_img ) ) {
						$placeholder_imgs[$size] = $def_img;
						return pinhole_wp_kses( $def_img );
					}
				}

				return pinhole_wp_kses( '<img src="'.esc_attr( $placeholder ).'" alt="'.esc_attr( get_the_title( $post_id ) ).'" />' );
			}

		return false;
	}
endif;


/**
 * Get meta data
 *
 * Function outputs meta data HTML
 *
 * @param array   $meta_data
 * @return string HTML output of meta data
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_meta_data' ) ):
	function pinhole_get_meta_data( $meta_data = array() ) {

		$output = '';

		if ( empty( $meta_data ) ) {
			return $output;
		}

		foreach ( $meta_data as $mkey ) {


			$meta = '';

			switch ( $mkey ) {

			case 'date':
				$meta = '<span class="updated">'.get_the_date().'</span>';
				break;

			case 'author':
				$author_id = get_post_field( 'post_author', get_the_ID() );
				$meta = __pinhole( 'by' ) . ' <span class="vcard author"><span class="fn"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ).'">'.get_the_author_meta( 'display_name', $author_id ).'</a></span></span>';
				break;

			case 'rtime':
				$meta = pinhole_read_time( get_post_field( 'post_content', get_the_ID() ) );
				if ( !empty( $meta ) ) {
					$meta .= ' '.__pinhole( 'min_read' );
				}
				break;

			case 'comments':
				if ( comments_open() || get_comments_number() ) {
					ob_start();
					comments_popup_link( __pinhole( 'no_comments' ), __pinhole( 'one_comment' ), __pinhole( 'multiple_comments' ) );
					$meta = ob_get_contents();
					ob_end_clean();
				} else {
					$meta = '';
				}
				break;

			default:
				break;
			}

			if ( !empty( $meta ) ) {
				$output .= '<div class="meta-item meta-'.$mkey.'">'.$meta.'</div>';
			}
		}


		return wp_kses_post( $output );

	}
endif;


/**
 * Get post categories data
 *
 * Function outputs buttons data HTML
 *
 * @param int     $post_id
 * @return string HTML output of category links
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_category' ) ):
	function pinhole_get_category( $post_id = false ) {

		if ( empty( $post_id ) ) {

			$post_id = get_the_ID();
		}

		$output = '';

		$cats = get_the_category_list( ', ', '', $post_id );

		if ( !empty( $cats ) ) {
			$output = $cats;
		}

		return $output;

	}
endif;


/**
 * Get post excerpt
 *
 * Function outputs post excerpt for specific layout
 *
 * @param int     $limit Number of characters to limit excerpt
 * @return string HTML output of category links
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_excerpt' ) ):
	function pinhole_get_excerpt( $limit = 250 ) {

		$manual_excerpt = false;

		if ( has_excerpt() ) {
			$content =  get_the_excerpt();
			$manual_excerpt = true;
		} else {
			$text = get_the_content( '' );
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$content = str_replace( ']]>', ']]&gt;', $text );
		}

		if ( !empty( $content ) ) {
			if ( !empty( $limit ) || !$manual_excerpt ) {
				$more = pinhole_get_option( 'more_string' );
				$content = wp_strip_all_tags( $content );
				$content = preg_replace( '/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
				$content = pinhole_trim_chars( $content, $limit, $more );
			}
			return wp_kses_post( wpautop( $content ) );
		}

		return '';

	}
endif;


/**
 * Get total number of images in all galleries for specific page/post
 *
 * @param int     $post_id
 * @return int Images count
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_images_count' ) ):
	function pinhole_get_images_count( $post_id = false ) {

		global $post;

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$count = 0;

		$galleries = get_post_galleries_images( $post_id );

		if ( !empty( $galleries ) ) {
			foreach ( $galleries as $images ) {
				$count += count( $images );
			}
			return $count;
		}

		if ( function_exists( 'has_block' ) && has_block( 'gallery', $post ) ) {

			$function_name = pinhole_which_parse_blocks();

			$blocks = call_user_func( $function_name, $post->post_content );

			foreach ( $blocks as $block ) {

				if ( $block['blockName'] == 'core/gallery' ) {

					if ( isset( $block['attrs']['ids'] ) && !empty( $block['attrs']['ids'] ) ) {
						$count += count( $block['attrs']['ids'] );
					}

				}
			}
		}


		return $count;

	}
endif;

/**
 * Get total number of galleries (child pages) for an album page
 *
 * @param int     $post_id
 * @return int Gallery count
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_galleries_count' ) ):
	function pinhole_get_galleries_count( $post_id = false ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$count = 0;

		$pages  = get_pages( array( 'parent' => $post_id ) );


		if ( !empty( $pages ) ) {
			$count = count( $pages );
		}

		return $count;

	}
endif;



/**
 * Get additional gallery page params to display on frontend
 *
 * @param array   $album List of parameters of a current album
 * @param obj     $obj   WP_Post object
 * @return array
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_additional_gallery_params' ) ):
	function pinhole_get_additional_gallery_params( $album, $obj = false ) {


		if ( empty( $obj ) ) {
			global $post;
			$obj = $post;
		}

		$filter_class = $album['has_grandchildren'] ? 'album'.'-'. $obj->post_parent : '';
		$album_link =  $album['has_grandchildren'] ? '<a href="'.get_permalink( $obj->post_parent ).'">'.get_the_title( $obj->post_parent ).'</a>' : '';

		$args = array(
			'filter_class' => $filter_class,
			'album_link' => $album_link
		);

		return $args;

	}
endif;




/**
 * Get album params
 *
 * Parses the current album page template,
 * check if it has grandchildren galleries and applies proper parameteres
 *
 * @param int     $post_id
 * @return array List of parameters for frontend display
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_galleries_template_params' ) ):
	function pinhole_get_galleries_template_params( ) {

		$post_id = get_the_ID();

		$meta = pinhole_get_page_meta( $post_id, 'galleries' );

		$args = array();

		if ( $meta['select'] == 'manual' ) {

			$args['query'] = array(
				'post__in' => $meta['ids'],
				'posts_per_page' => '-1',
				'orderby' => 'post__in',
				'post_type' => 'page'
			);

			$args['has_grandchildren'] = false;

		} else {

			$has_grandchildren = false;

			$pages = get_pages( array( 'child_of' => $post_id, 'sort_column' => 'menu_order' ) );

			$ids = array();

			foreach ( $pages as $page ) {

				if ( $page->post_parent == $post_id ) {
					$args['sub_albums'][] = array( 'title' => $page->post_title, 'id' => $page->ID );
					$ids[] = $page->ID;
				} else {
					$has_grandchildren = true;
				}
			}

			if ( !$has_grandchildren ) {
				$args['sub_albums'] = array();
				$ids[] = $post_id;
				$args['has_grandchildren'] = false;
			} else {
				$args['has_grandchildren'] = true;
			}

			$args['query'] = array(
				'post_parent__in' => $ids,
				'posts_per_page' => '-1',
				'orderby' => 'menu_order',
				'order' => 'ASC',
				'post_type' => 'page'
			);
		}


		$args['layout'] = $meta['layout'];
		$args['items'] = $meta['items'];
		$args['columns'] = $meta['columns'];
		$args['image_count'] = pinhole_get_option( 'galleries_image_count' );
		$args['col_class'] = pinhole_get_column_class( $args['layout'], $args['columns'] );
		$args['layout_size'] = $args['layout'] == 'justify' ? $meta['layout_size'] : '';
		$args['img_size'] = pinhole_get_image_size( $args['layout'], $args['columns'], $args['layout_size'] );
		$args['prevnext'] = false;

		return apply_filters( 'pinhole_modify_galleries_template_params', $args );

	}
endif;

/**
 * Get albums params
 *
 * Parses the albums page template settings and prepare params to display on frontend
 *
 * @return array List of parameters for frontend display
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_albums_template_params' ) ):
	function pinhole_get_albums_template_params() {

		$args = array();

		$meta = pinhole_get_page_meta( get_the_ID(), 'albums' );

		$args['layout'] = $meta['layout'];
		$args['items'] = $meta['items'];
		$args['columns'] = $meta['columns'];
		$args['gallery_count'] = pinhole_get_option( 'albums_gallery_count' );
		$args['col_class'] = pinhole_get_column_class( $args['layout'], $args['columns'] );
		$args['layout_size'] = $args['layout'] == 'justify' ? $meta['layout_size'] : '';
		$args['img_size'] = pinhole_get_image_size( $args['layout'], $args['columns'],  $args['layout_size'] );
		$args['prevnext'] = false;
		$args['query'] = array(
			'post_parent__in' => array( get_the_ID() ),
			'posts_per_page' => '-1',
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'post_type' => 'page'
		);


		return apply_filters( 'pinhole_modify_albums_template_params', $args );

	}
endif;

/**
 * Get gallery params
 *
 * Parses the gallery params and prepare params to display on frontend
 *
 * @param array   $attr current gallery shortcode attributes to check against theme options
 * @return array List of parameters for frontend display
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_gallery_params' ) ):
	function pinhole_get_gallery_params( $attr = array() ) {

		$args = array();

		global $post;

		$args['layout'] = pinhole_get_option( 'gallery_layout' );
		$args['columns'] = pinhole_get_option( 'gallery_columns' );
		$args['layout_size'] = pinhole_get_option( 'gallery_layout_size' );
		$args['image_limit'] = pinhole_get_option( 'gallery_image_limit' );

		if ( isset( $attr['pinhole_settings'] ) && $attr['pinhole_settings'] == 'custom' ) {

			if ( isset( $attr['pinhole_layout'] ) ) {
				$args['layout'] = $attr['pinhole_layout'];
			}

			if ( isset( $attr['pinhole_columns'] ) ) {
				$args['columns'] = $attr['pinhole_columns'];
			}

			if ( isset( $attr['pinhole_layout_size'] ) ) {
				$args['layout_size'] = $attr['pinhole_layout_size'];
			}

			if ( isset( $attr['pinhole_image_limit'] ) && $attr['pinhole_image_limit'] !== '' ) {
				$args['image_limit'] = $attr['pinhole_image_limit'];
			}

		}

		$args['col_class'] = pinhole_get_column_class( $args['layout'], $args['columns'] );
		$args['layout_size'] = $args['layout'] == 'justify' ? $args['layout_size'] : '';
		$args['img_size'] = pinhole_get_image_size( $args['layout'], $args['columns'], $args['layout_size'] );
		$args['image_meta'] = pinhole_get_option( 'gallery_image_meta', 'multi' );
		$args['image_caption'] = pinhole_get_option( 'gallery_image_caption' );
		$args['image_download'] = pinhole_get_option( 'gallery_image_download' ) && isset( $post->post_password ) && !empty( $post->post_password );
		$args['image_number'] = pinhole_get_option( 'gallery_image_number' ) && isset( $post->post_password ) && !empty( $post->post_password );
		$args['image_name'] = pinhole_get_option( 'gallery_image_filename' ) && isset( $post->post_password ) && !empty( $post->post_password );

		return apply_filters( 'pinhole_modify_gallery_params', $args );

	}
endif;

/**
 * Get archive params
 *
 * Parses the archive settings ane prepare params to display on frontend
 *
 * @return array List of parameters for frontend display
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_archive_template_params' ) ):
	function pinhole_get_archive_template_params() {

		$args = array();

		$args['heading'] = pinhole_get_archive_heading();
		$args['layout'] = pinhole_get_option( 'archive_layout' );
		$args['items'] = pinhole_get_option( 'archive_items' );
		$args['columns'] = $args['layout'] == 'classic' ? absint( 1 ) : pinhole_get_option( 'archive_columns' );
		$args['col_class'] = pinhole_get_column_class( $args['layout'], $args['columns'] );
		$args['layout_size'] = $args['layout'] == 'justify' ? pinhole_get_option( 'archive_layout_size' ) : '';
		$args['img_size'] = pinhole_get_image_size( $args['layout'], $args['columns'], $args['layout_size'] );
		$args['pagination'] = pinhole_get_option( 'archive_pagination' );
		$args['category'] = pinhole_get_option( 'archive_category' );
		$args['excerpt'] = $args['items'] == 'below' && $args['layout'] != 'justify' ? pinhole_get_option( 'archive_excerpt' ) : false;
		$args['excerpt_limit'] = pinhole_get_option( 'archive_excerpt_limit' );
		$args['meta'] = pinhole_get_option( 'archive_meta', 'multi' );

		return apply_filters( 'pinhole_modify_archive_template_params', $args );

	}
endif;

/**
 * Get single post template params
 *
 * Parses single post template settings and prepare params to display on frontend
 *
 * @return array List of parameters for frontend display
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_single_template_params' ) ):
	function pinhole_get_single_template_params() {

		$args = array();

		$args['category'] = pinhole_get_option( 'single_category' );
		$args['tags'] = pinhole_get_option( 'single_tags' ) && has_tag();
		$args['fimg'] = pinhole_get_option( 'single_fimg' );
		$args['meta'] =  pinhole_get_option( 'single_meta', 'multi' );
		$args['author'] = pinhole_get_option( 'single_author' );
		$args['share'] = pinhole_get_option( 'single_share', 'multi' );
		$args['prevnext'] = pinhole_get_option( 'single_prevnext' );

		return apply_filters( 'pinhole_modify_single_template_params', $args );

	}
endif;

/**
 * Get page template params
 *
 * Parses page template settings and prepare params to display on frontend
 *
 * @return array List of parameters for frontend display
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_page_template_params' ) ):
	function pinhole_get_page_template_params() {
		global $post;

		$has_gallery = pinhole_has_gallery();

		$args = array();

		$args['fimg'] = !$has_gallery;
		$args['image_count'] = $has_gallery && empty( $post->post_password );
		$args['share'] = $has_gallery && empty( $post->post_password ) ? pinhole_get_option( 'gallery_share', 'multi' ) : '';
		$args['prevnext'] = $has_gallery ? pinhole_get_option( 'gallery_prevnext' ) : false;

		return apply_filters( 'pinhole_modify_single_template_params', $args );

	}
endif;


/**
 * Get author social links
 *
 * @param int     $author_id ID of an author/user
 * @return string HTML output of social links
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_author_links' ) ):
	function pinhole_get_author_links( $author_id ) {

		$output = '';

		$output .= '<div class="meta-item"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID', $author_id ) ) ).'">'.__pinhole( 'view_all' ).'</a></div>';

		if ( $url = get_the_author_meta( 'url', $author_id ) ) {
			$output .= '<div class="meta-item"><a href="'.esc_url( $url ).'" target="_blank" class="pinhole-icon-social fa fa-link"></a></div>';
		}

		$social = pinhole_get_social();

		if ( !empty( $social ) ) {
			foreach ( $social as $id => $name ) {
				if ( $social_url = get_the_author_meta( $id,  $author_id ) ) {

					if ( $id == 'twitter' ) {
						$pos = strpos( $social_url, '@' );
						$social_url = 'https://twitter.com/'.substr( $social_url, $pos, strlen( $social_url ) );
					}

					$output .=  '<div class="meta-item"><a href="'.esc_url( $social_url ).'" target="_blank" class="pinhole-icon-social fa fa-'.esc_attr( $id ).'"></a></div>';
				}
			}
		}

		return wp_kses_post( $output );
	}
endif;


/**
 * Get branding
 *
 * Returns HTML of logo or website title based on theme options
 *
 * @param string  $element ID of an element to check
 * @return string HTML
 * @since  1.0
 */

if ( !function_exists( 'pinhole_get_branding' ) ):
	function pinhole_get_branding() {

		global $pinhole_h1_used;

		$logo = pinhole_get_option( 'logo', 'image' );
		$brand = !empty( $logo ) ? '<img class="pinhole-logo" src="'.esc_url( $logo ).'" alt="'.esc_attr( get_bloginfo( 'name' ) ).'" >' : get_bloginfo( 'name' );
		$element = is_front_page() && empty( $pinhole_h1_used ) ? 'h1' : 'span';
		$url = pinhole_get_option( 'logo_custom_url' ) ? pinhole_get_option( 'logo_custom_url' ) : home_url( '/' );

		$output = '<'.$element.' class="site-title h1"><a href="'. esc_url( $url ) .'" rel="home">'.wp_kses_post( $brand ).'</a></'.esc_attr( $element ).'>';

		$pinhole_h1_used = true;

		return apply_filters( 'pinhole_modify_branding', $output );

	}
endif;


/**
 * Header display element
 *
 * Checks is specific header element should be displayed based on theme options
 *
 * @param string  $element ID of an element to check
 * @return bool
 * @since  1.0
 */

if ( !function_exists( 'pinhole_header_display' ) ):
	function pinhole_header_display( $element ) {

		$elements = pinhole_get_option( 'header_elements' );

		if ( isset( $elements[$element] ) && $elements[$element] ) {
			return true;
		}

		return false;

	}
endif;

?>
