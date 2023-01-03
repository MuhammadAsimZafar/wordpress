<?php

/**
 * body_class callback
 *
 * Checks for specific options and applies additional class to body element
 *
 * @since  1.0
 */

add_filter( 'body_class', 'pinhole_body_class' );

if ( !function_exists( 'pinhole_body_class' ) ):
	function pinhole_body_class( $classes ) {

		$classes[] = 'pinhole-v_' . str_replace( '.', '_', PINHOLE_THEME_VERSION );

		if ( is_child_theme() ) {
			$classes[] = 'pinhole-child';
		}

		return $classes;
	}
endif;


/**
 * protected_title_format callback
 *
 * Removes the default "Protected" word from protected pages (if has a gallery)
 *
 * @since  1.0
 */
add_filter( 'protected_title_format', 'pinhole_protected_title_format' );

if ( !function_exists( 'pinhole_protected_title_format' ) ):
	function pinhole_protected_title_format( $output ) {

		if ( 'page' == get_post_type() && pinhole_has_gallery() ) {

			return '%s';

		}

		return $output;

	}
endif;


/**
 * the_password_form callback
 *
 * Changes the text labels for protected pages if used as galleries, for better user info
 *
 * @since  1.0
 */
add_filter( 'the_password_form', 'pinhole_the_password_form' );

if ( !function_exists( 'pinhole_the_password_form' ) ):
	function pinhole_the_password_form( $output ) {

		if ( 'page' == get_post_type() && pinhole_has_gallery() ) {

			$post = get_post();

			$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
			$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
			<p>' . __pinhole( 'protected_text' ). '</p>
			<p><input name="post_password" id="' . $label . '" type="password" size="20" placeholder="' . __pinhole( 'protected_password' ) . '" /> <input type="submit" name="Submit" value="' . __pinhole( 'protected_submit' ) . '" /></p></form>
			';

		}

		return $output;



	}
endif;



/**
 * post_gallery filter callback
 *
 * Parses gallery parameters and prepares gallery HTML output
 *
 * @since  1.0
 */

add_filter( 'post_gallery', 'pinhole_gallery', 10, 3 );

if ( !function_exists( 'pinhole_gallery' ) ):
	function pinhole_gallery( $x, $attr, $instance ) {

		if ( !pinhole_get_option( 'use_gallery' ) ) {

			return '';
		}

		$gallery_params = pinhole_get_gallery_params( $attr );

		$attr['link'] = 'file';
		$attr['size'] = 'pinhole-'.$gallery_params['img_size'];

		global $post;

		$html5 = current_theme_supports( 'html5', 'gallery' );

		$atts = shortcode_atts( array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post ? $post->ID : 0,
				'itemtag'    => $html5 ? 'figure'     : 'dl',
				'icontag'    => $html5 ? 'div'        : 'dt',
				'captiontag' => $html5 ? 'figcaption' : 'dd',
				'columns'    => 3,
				'size'       => 'thumbnail',
				'include'    => '',
				'exclude'    => '',
				'link'       => ''
			), $attr, 'gallery' );

		//print_r( $atts );


		//print_r( $atts );


		$id = intval( $atts['id'] );

		if ( ! empty( $atts['include'] ) ) {
			$_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}

		} elseif ( ! empty( $atts['exclude'] ) ) {
			$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
		} else {
			$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
		}

		if ( empty( $attachments ) && isset( $atts['include'] ) && count( explode( ",", $atts['include'] ) ) > 1 ) {
			return '<p class="text-center">'.wp_kses_post( sprintf( __( 'Due to licencing rules and technical limitations, demo images are not included in galleries. You just need to %s and add some of your own images to the existing gallery. While on the page edit screen, make sure the content editor is set to visual mode and just click the gallery icon/button.', 'pinhole' ), '<a href="'.esc_url( get_edit_post_link() ).'">edit this page</a>' ) ).'</p>';
		}

		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
			}
			return $output;
		}

		$gallery_div = "<div class='pinhole-gallery pinhole-{$gallery_params['layout']} pinhole-popup items-hidden {$gallery_params['layout_size']} clearfix row'>";

		$output =  $gallery_div;

		$i = 0;

		if ( count( $attachments ) <= $gallery_params['image_limit'] ) {
			$gallery_params['image_limit'] = 0;
		}

		foreach ( $attachments as $id => $attachment ) {

			//print_r( $attachment );
			$image_meta  = wp_get_attachment_metadata( $id );
			//print_r( $image_meta );
			$image_caption = array();

			if ( !empty( $image_meta['sizes']['pinhole-popup']['width'] ) && !empty( $image_meta['sizes']['pinhole-popup']['height'] ) ) {
				$image_popup_size = array( 'width' => $image_meta['sizes']['pinhole-popup']['width'],  'height' => $image_meta['sizes']['pinhole-popup']['height'] );
			}else {
				$image_popup_size = isset( $image_meta['width'] ) && isset( $image_meta['height'] ) ? array( 'width' => $image_meta['width'],  'height' => $image_meta['height'] ) : array( 'width' => 800, 'height' => 600 );
			}

			if ( trim( $attachment->post_excerpt ) ) {
				$image_caption['caption'] = wptexturize( $attachment->post_excerpt );
			}

			$image_info = pinhole_get_image_meta( $gallery_params, $image_meta );

			$image_download = $gallery_params['image_download'] ? array( 'name' => basename( $attachment->guid ), 'url' =>  $attachment->guid ) : array();

			$data_filename = array(
				'name' => $gallery_params['image_name'] ?  pathinfo( $attachment->guid, PATHINFO_FILENAME ) : '',
			);

			$sized = wp_get_attachment_image_src( $id, 'pinhole-popup' );
			$sized_thumbnail = wp_get_attachment_image( $id, $atts['size'] );

			$image_output = '<a class="item-link" href="' . $sized[0] . '" data-caption="'.esc_attr( json_encode( $image_caption ) ).'" data-meta="'.esc_attr( json_encode( $image_info ) ).'"  data-size="'.esc_attr( json_encode( $image_popup_size ) ).'" data-download="'.esc_attr( json_encode( $image_download ) ).'" data-filename="'.esc_attr( json_encode( $data_filename ) ).'">' .$sized_thumbnail .'</a>';

			$limit_class = $gallery_params['image_limit'] && ( $i >= $gallery_params['image_limit'] ) ? 'pinhole-hidden' : '';
			$more_items_class = $gallery_params['image_limit'] && ( $i + 1 ) == $gallery_params['image_limit'] ? 'pinhole-info-more' : '';

			$more_items_info = '';

			if ( $gallery_params['image_limit'] && ( $i + 1 ) == $gallery_params['image_limit'] ) {
				$plus_photos = ( count( $attachments ) - $i - 1 );
				if ( $plus_photos == 1 ) {
					$photo_label = '1 '.__pinhole( 'photo' );
				} else {
					$photo_label = $plus_photos.' '.__pinhole( 'photos' );
				}
				$more_items_info = '<div class="pinhole-info">+'.$photo_label.'</div>';
			}

			$download_info = $gallery_params['image_download'] && !$more_items_info ? '<a class="pinhole-download pinhole-button" href="'.esc_attr( $attachment->guid ) .'" download="'.esc_attr( basename( $attachment->guid ) ).'"><i class="fa fa-download" aria-hidden="true"></i></a>' : '';

			$image_number = $gallery_params['image_number'] ? '<span class="pinhole-image-counter">' . sprintf( "#%'0" . strlen( count( $attachments ) ) . "d", $i + 1 ) . '</span>' : '';
			$image_name = $gallery_params['image_name'] ? '<span class="pinhole-image-counter pinhole-image-name">' . pathinfo( $attachment->guid, PATHINFO_FILENAME ) . '</span>' : '';

			if ( $limit_class ) {
				$image_output = str_replace( 'src="', 'data-src="', $image_output );
				$image_output = str_replace( 'srcset="', 'data-srcset="', $image_output );
			}

			$output .= "<div class='pinhole-item {$gallery_params['col_class']} {$limit_class} {$more_items_class}'>";
			$output .= $image_output . $more_items_info . $download_info . $image_number . $image_name;
			$output .= "</div>";

			$i++;
		}

		$output .= "
		</div>\n";

		return $output;
	}
endif;


/**
 * Filter Function for the media attachment link to prepare gallery and image for popup.
 *
 * @since 1.3.
 *
 * @return   $content
 */

add_filter( 'the_content', 'pinhole_popup_filter' );

if ( !function_exists( 'pinhole_popup_filter' ) ) :
	function pinhole_popup_filter( $content ) {

		return pinhole_single_image_popup( $content );

	}
endif;

/**
 * Filter Function to set Gutenberg gallery if exists
 *
 * @since 1.3.2
 *
 * @return   $content
 */

add_filter( 'the_content', 'pinhole_gutenberg_gallery_filter', 5 );

if ( !function_exists( 'pinhole_gutenberg_gallery_filter' ) ) :
	function pinhole_gutenberg_gallery_filter( $content ) {

		if ( !pinhole_get_option( 'use_gallery' ) ) {
			return $content;
		}

		return pinhole_replace_gutenberg_gallery_block( $content );

	}
endif;

/*
 * Add comment form default fields args filter
 * to replace comment fields labels
 */

add_filter( 'comment_form_default_fields', 'pinhole_comment_fields_labels' );

if ( !function_exists( 'pinhole_comment_fields_labels' ) ):
	function pinhole_comment_fields_labels( $fields ) {

		$replace = array(
			'author' => array(
				'old' => esc_html__( 'Name', 'pinhole' ),
				'new' =>__pinhole( 'comment_name' )
			),
			'email' => array(
				'old' => esc_html__( 'Email', 'pinhole' ),
				'new' =>__pinhole( 'comment_email' )
			),
			'url' => array(
				'old' => esc_html__( 'Website', 'pinhole' ),
				'new' =>__pinhole( 'comment_website' )
			),

			'cookies' => array(
				'old' => esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'pinhole' ),
				'new' =>__pinhole( 'comment_cookie_gdpr' )
			)
		);

		foreach ( $fields as $key => $field ) {

			if ( array_key_exists( $key, $replace ) ) {
				$fields[$key] = str_replace( $replace[$key]['old'], $replace[$key]['new'], $fields[$key] );
			}

		}

		return $fields;

	}

endif;

/**
 * Replace gutenberg gallery block
 *
 * Function replace gutenberg gallery block with gallery shortcode
 *
 * @param object
 * @return mixed HTML
 * @since  1.3.2
 */

if ( !function_exists( 'pinhole_replace_gutenberg_gallery_block' ) ):
	function pinhole_replace_gutenberg_gallery_block( $content ) {

		if ( !pinhole_has_gutenberg() ) {
			return $content;
		}

		$function_name = pinhole_which_parse_blocks();

		if ( empty( $content ) ) {
			$post = get_post();
			$content = $post->post_content;
		}

		$blocks = call_user_func( $function_name, $content );

		if ( empty( $blocks ) ) {
			return $content;
		}

		foreach ( $blocks as $block ) {

			if ( $block['blockName'] == 'core/gallery' ) {

				$gallery_ids = [];

				if ( isset( $block['attrs']['ids'] ) && !empty( $block['attrs']['ids'] ) ) {
					$gallery_ids = $block['attrs']['ids'];
				} else {

					preg_match_all( '/data-id="(.*?)"/i', $content, $id_matches );

					if ( empty( $id_matches[1] ) ) {
						continue;
					}

					foreach ( $id_matches[1] as $match ) {
						$gallery_ids[] = $match;
					}
				}

				$pattern = '/<ul class="wp-block-gallery(.*?)<\/ul>/i';
				$shortcode = '[gallery ids="' . implode( ',', $gallery_ids ) . '"]';
				$content = preg_replace( $pattern, $shortcode, $content, 1 );

			}
		}

		return $content;
	}
endif;


/**
 * Single Image Popup
 *
 * Prepare single image that is linked to media file in content for popup
 *
 * @param object
 * @return mixed HTML
 * @since  1.3.2
 */

if ( !function_exists( 'pinhole_single_image_popup' ) ):
	function pinhole_single_image_popup( $content ) {

		if ( !pinhole_get_option( 'on_single_img_popup' ) ) {
			return $content;
		}

		preg_match_all( "/<a href=\"(?P<href>.*?).(?P<img_type>bmp|gif|jpeg|jpg|png)\">/i", $content, $matches );

		if ( empty( $matches['href'] ) ) {
			return $content;
		}

		foreach ( $matches['href'] as $key => $value ) {

			$old_value = $value;
			$new_value = preg_replace( '/\-*(\d+)x(\d+)/', '', $value );

			$gallery_params = pinhole_get_gallery_params();
			$img_url = $new_value . '.' . $matches['img_type'][$key];
			$img_id = pinhole_get_image_id_by_url( $img_url );

			$img_size = wp_get_attachment_image_src( $img_id, 'full' );
			$data_size = !empty( $img_size ) ? array( "width" => $img_size[1], "height" => $img_size[2] ) : array( "width" => 1920, "height" => 1280 );

			$caption = get_post( $img_id );
			$data_caption = !empty( $caption ) && $gallery_params['image_caption'] ?  array( "caption" => $caption->post_excerpt ) : $data_caption = array( "caption" => '' );

			$image_meta  = wp_get_attachment_metadata( $img_id );
			$data_image_info = pinhole_get_image_meta( $gallery_params, $image_meta );

			$url_pattern = '/(\/)/';
			$url_rgx = preg_replace( $url_pattern, "\/", $old_value );

			$pattern = '/<a(.*?)href=\"('.$url_rgx.').(bmp|gif|jpeg|jpg|png)\">/i';
			$replacement = '<a$1class="pinhole-popup-img" href='.$new_value.'.$3 data-caption="'.esc_attr( json_encode( $data_caption, JSON_FORCE_OBJECT ) ).'" data-size="'.esc_attr( json_encode( $data_size, JSON_FORCE_OBJECT ) ).'" data-meta="'.esc_attr( json_encode( $data_image_info, JSON_FORCE_OBJECT ) ).'">';
			$content = preg_replace( $pattern, $replacement, $content );

		}

		return $content;
	}
endif;

/**
 * Filter to replace search field placeholder
 *
 * @param array $options - Array of options 
 * @return array
 * @since  1.5
 */
add_filter( 'get_search_form', 'pinhole_search_form_placeholder' );

if ( !function_exists( 'pinhole_search_form_placeholder' ) ):
	function pinhole_search_form_placeholder( $html ) {
		$html = str_replace( 'placeholder="Search ', 'placeholder="Type here to search', $html );
		return $html;
	}
endif;

/**
 * Filter for social share options on frontend in the_content filter
 *
 * @param array $options - Array of options 
 * @return array
 * @since  1.5
 */
add_filter( 'meks_ess_modify_options', 'pinhole_social_share_modify_options' );

if ( !function_exists( 'pinhole_social_share_modify_options' ) ):
	function pinhole_social_share_modify_options( $options ) {

		$options['style'] = '1';
		$options['variant'] = '1';
		$options['color']['type'] = 'custom';
		$options['color']['custom_color'] = 'rgba(51, 51, 51, 0.1)';
		$options['location'] = 'custom';
		$options['post_type'] = array('post');
		$options['label_share']['active'] = '0';

		return $options;
	}
endif;

/**
 * Remove social share plugin page in admin ( Settings -> Meks Easy Social Share )
 *
 * @param array $options - Array of options 
 * @return array
 * @since  1.5
 */
add_action( 'admin_init', 'pinhole_social_share_menu_page_remove' );

if ( !function_exists( 'pinhole_social_share_menu_page_remove' ) ):
	function pinhole_social_share_menu_page_remove() {
		remove_submenu_page( 'options-general.php', 'meks-easy-social-share' );
	}
endif;

/**
 * Remove social share plugin settings link
 *
 * @param array $options - Array of options 
 * @return array
 * @since  1.5
 */
add_action( 'plugin_action_links', 'pinhole_social_share_remove_setting_link', 100, 1 );

if ( !function_exists( 'pinhole_social_share_remove_setting_link' ) ):
	function pinhole_social_share_remove_setting_link( $actions ) {
		unset($actions['meks_ess_settings']);
		return $actions;
	}
endif;



?>