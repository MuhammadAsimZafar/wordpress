<?php

/**
 * Metaboxes setup
 * 
 * @since  1.0
 */

add_action( 'load-post.php', 'pinhole_meta_boxes_setup' );
add_action( 'load-post-new.php', 'pinhole_meta_boxes_setup' );

if ( !function_exists( 'pinhole_meta_boxes_setup' ) ) :
	function pinhole_meta_boxes_setup() {
		global $typenow;
		if ( $typenow == 'page' ) {
			add_action( 'add_meta_boxes', 'pinhole_load_page_metaboxes' );
			add_action( 'save_post', 'pinhole_save_page_metaboxes', 10, 2 );
		}
	}
endif;

/**
 * Load page metaboxes
 * 
 * Callback function for page metaboxes load
 * 
 * @since  1.0
 */

if ( !function_exists( 'pinhole_load_page_metaboxes' ) ) :
	function pinhole_load_page_metaboxes() {
		
		/* Galleries template options */
		add_meta_box(
			'pinhole_galleries_template_options',
			esc_html__( 'Galleries template options', 'pinhole' ),
			'pinhole_galleries_template_options_metabox',
			'page',
			'side',
			'default'
		);

		/* Galleries select options */
		add_meta_box(
			'pinhole_galleries_select',
			esc_html__( 'Pull galleries from', 'pinhole' ),
			'pinhole_galleries_select_metabox',
			'page',
			'side',
			'default'
		);

		/* Albums template options */
		add_meta_box(
			'pinhole_albums_template_options',
			esc_html__( 'Albums template options', 'pinhole' ),
			'pinhole_albums_template_options_metabox',
			'page',
			'side',
			'default'
		);

	}
endif;


/**
 * Save page meta
 * 
 * Callback function to save page meta data
 * 
 * @since  1.0
 */

if ( !function_exists( 'pinhole_save_page_metaboxes' ) ) :
	function pinhole_save_page_metaboxes( $post_id, $post ) {
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
			return;
		}
			
		if ( ! isset( $_POST['pinhole_page_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['pinhole_page_metabox_nonce'], 'pinhole_page_metabox_save' ) ) {
   			return;
		}

		if ( $post->post_type == 'page' && isset( $_POST['pinhole'] ) ) {
			$post_type = get_post_type_object( $post->post_type );
			if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
				return $post_id;

			$meta = array();

			//Check galleries meta
			//
			$galleries = array();
			
			if( isset( $_POST['pinhole']['galleries']['settings']) && $_POST['pinhole']['galleries']['settings'] == 'custom' ){

				foreach( $_POST['pinhole']['galleries'] as $k => $v ){

					if( !in_array($k, array('select', 'ids') ) ){
						$galleries[$k] = $v;
					}
				}
	
			}

			if( isset( $_POST['pinhole']['galleries']['select']) && $_POST['pinhole']['galleries']['select'] == 'manual' ){

				$galleries['ids'] = explode(',', $_POST['pinhole']['galleries']['ids'] );
				$galleries['select'] = 'manual';
			}

			if(!empty($galleries)){
					$meta['galleries'] = $galleries;
			}

			//Check albums meta
			
			$albums = array();
			
			if( isset( $_POST['pinhole']['albums']['settings']) && $_POST['pinhole']['albums']['settings'] == 'custom' ){

				foreach( $_POST['pinhole']['albums'] as $k => $v ){
						$albums[$k] = $v;
				}
			}

			if(!empty($albums)){
					$meta['albums'] = $albums;
			}

			//Update or delete meta data
			if(!empty($meta)){
				update_post_meta( $post_id, '_pinhole_meta', $meta );
			} else {
				delete_post_meta( $post_id, '_pinhole_meta');
			}

		}
	}
endif;


/**
 * Galleries page template options
 * 
 * Callback function to create metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'pinhole_galleries_template_options_metabox' ) ) :
	function pinhole_galleries_template_options_metabox( $object, $box ) {
		
		wp_nonce_field( 'pinhole_page_metabox_save', 'pinhole_page_metabox_nonce' );

		$meta = pinhole_get_page_meta( $object->ID, 'galleries' );

		//print_r( $meta );
		
		$layouts = pinhole_get_main_layouts(false, array('classic'));
		$columns = pinhole_get_layout_columns();
		$items = pinhole_get_layout_styles();
		$sizes = pinhole_get_layout_sizes();
?>	

		<ul>
			<li><label><input type="radio" class="pinhole-template-settings" name="pinhole[galleries][settings]" value="inherit" <?php checked( 'inherit', $meta['settings'] );?>/> <?php esc_html_e('Inherit from theme options', 'pinhole'); ?></label></li>
			<li><label><input type="radio" class="pinhole-template-settings" name="pinhole[galleries][settings]" value="custom" <?php checked( 'custom', $meta['settings'] );?>/> <?php esc_html_e('Customize', 'pinhole'); ?></label></li>
		</ul>

		<?php $display = $meta['settings'] == 'inherit' ? 'none' : 'block'; ?>

		<div class="pinhole-template-settings-wrap" style="display:<?php echo esc_attr( $display ); ?>;">
			<p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Layout', 'pinhole'); ?></label></p>
		  	<ul class="pinhole-img-select-wrap">
		  	<?php foreach ( $layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = $id == $meta['layout'] ? ' selected': ''; ?>
		  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="pinhole-img-select<?php echo esc_attr($selected_class); ?> pinhole-template-settings-layout">
		  			<span><?php echo esc_html( $layout['title'] ); ?></span>
		  			<input type="radio" class="pinhole-hidden" name="pinhole[galleries][layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout'] );?>/>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>

		   <p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Style', 'pinhole'); ?></label></p>
		  	<ul class="pinhole-img-select-wrap">
		  	<?php foreach ( $items as $id => $item ): ?>
		  		<li>
		  			<?php $selected_class = $id == $meta['items'] ? ' selected': ''; ?>
		  			<img src="<?php echo esc_url($item['img']); ?>" title="<?php echo esc_attr($item['title']); ?>" class="pinhole-img-select<?php echo esc_attr($selected_class); ?>">
		  			<span><?php echo esc_html( $item['title'] ); ?></span>
		  			<input type="radio" class="pinhole-hidden" name="pinhole[galleries][items]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['items'] );?>/>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>

		   <?php $display = $meta['layout'] == 'justify' ? 'none' : 'block'; ?>

			<div class="pinhole-template-settings-field-columns" style="display:<?php echo esc_attr( $display ); ?>;">

				<p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Columns', 'pinhole'); ?></label></p>

				<ul>
					<?php foreach ( $columns as $id => $column ): ?>
						<li>
							<label><input type="radio" name="pinhole[galleries][columns]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['columns'] );?>/> <?php echo esc_html( $column ); ?> </label>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

			<?php $display = $meta['layout'] == 'justify' ? 'block' : 'none'; ?>

			<div class="pinhole-template-settings-field-layout_size" style="display:<?php echo esc_attr( $display ); ?>;">

				<p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Layout size', 'pinhole'); ?></label></p>

				<ul>
					<?php foreach ( $sizes as $id => $size ): ?>
						<li>
							<label><input type="radio" name="pinhole[galleries][layout_size]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout_size'] );?>/> <?php echo esc_html( $size ); ?> </label>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

		</div>

	  <?php
	}
endif;


/**
 * Galleries select options
 * 
 * Callback function to create metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'pinhole_galleries_select_metabox' ) ) :
	function pinhole_galleries_select_metabox( $object, $box ) {
		
		wp_nonce_field( 'pinhole_page_metabox_save', 'pinhole_page_metabox_nonce' );
		$meta = pinhole_get_page_meta( $object->ID, 'galleries' );
		//print_r( $meta );

		$pages = $meta['select'] == 'manual' && !empty($meta['ids']) ? get_posts( array('post__in' => $meta['ids'], 'orderby' => 'post__in', 'post_type' => 'page', 'posts_per_page' => '-1') ) : array();
		$pages = wp_list_pluck( $pages, 'post_title', 'ID' );
		
?>	
		
		<ul>
			<li><label><input class="pinhole-galleries-select" type="radio" name="pinhole[galleries][select]" value="hierarchy" <?php checked( 'hierarchy', $meta['select'] );?>/> <?php esc_html_e('Page hierarchy (default)', 'pinhole'); ?></label></li>
			<li><label><input class="pinhole-galleries-select" type="radio" name="pinhole[galleries][select]" value="manual" <?php checked( 'manual', $meta['select'] );?>/> <?php esc_html_e('Manual selection', 'pinhole'); ?></label></li>
		</ul>


		<?php $display = $meta['select'] == 'manual' ? 'block' : 'none'; ?>

		<div class="pinhole-live-search-opt pinhole-galleries-select-wrap" style="display:<?php echo esc_attr( $display ); ?>;">
			<input class="pinhole-live-search widefat" type="text"/>
			<small class="howto"><?php esc_html_e('Type to search pages', 'pinhole'); ?></small>
			<input class="pinhole-live-search-hidden" type="hidden" name="pinhole[galleries][ids]" value="<?php echo esc_attr(implode(',',$meta['ids'])); ?>"/>
			<div class="pinhole-live-search-items tagchecklist">
				<?php if(!empty($pages) ): ?>
					<?php foreach($pages as $id => $page): ?>
						<span><button type="button" class="ntdelbutton" data-id="<?php echo esc_attr($id); ?>"><span class="remove-tag-icon"></span></button>&nbsp;<?php echo esc_html( $page ); ?></span>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>

	  <?php
	}
endif;

/**
 * Albums page template options
 * 
 * Callback function to create metabox
 * 
 * @since  1.0
 */

if ( !function_exists( 'pinhole_albums_template_options_metabox' ) ) :
	function pinhole_albums_template_options_metabox( $object, $box ) {
		
		wp_nonce_field( 'pinhole_page_metabox_save', 'pinhole_page_metabox_nonce' );

		$meta = pinhole_get_page_meta( $object->ID, 'albums' );

		//print_r( $meta );
		
		$layouts = pinhole_get_main_layouts(false, array('classic'));
		$columns = pinhole_get_layout_columns();
		$items = pinhole_get_layout_styles();
		$sizes = pinhole_get_layout_sizes();
?>	
		
		<ul>
			<li><label><input type="radio" class="pinhole-template-settings" name="pinhole[albums][settings]" value="inherit" <?php checked( 'inherit', $meta['settings'] );?>/> <?php esc_html_e('Inherit from theme options', 'pinhole'); ?></label></li>
			<li><label><input type="radio" class="pinhole-template-settings" name="pinhole[albums][settings]" value="custom" <?php checked( 'custom', $meta['settings'] );?>/> <?php esc_html_e('Customize', 'pinhole'); ?></label></li>
		</ul>

		<?php $display = $meta['settings'] == 'inherit' ? 'none' : 'block'; ?>

		<div class="pinhole-template-settings-wrap" style="display:<?php echo esc_attr( $display ); ?>;">

			<p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Layout', 'pinhole'); ?></label></p>
		  	<ul class="pinhole-img-select-wrap">
		  	<?php foreach ( $layouts as $id => $layout ): ?>
		  		<li>
		  			<?php $selected_class = $id == $meta['layout'] ? ' selected': ''; ?>
		  			<img src="<?php echo esc_url($layout['img']); ?>" title="<?php echo esc_attr($layout['title']); ?>" class="pinhole-img-select<?php echo esc_attr($selected_class); ?> pinhole-template-settings-layout">
		  			<span><?php echo esc_html( $layout['title'] ); ?></span>
		  			<input type="radio" class="pinhole-hidden" name="pinhole[albums][layout]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout'] );?>/>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>

		   
		   <p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Style', 'pinhole'); ?></label></p>
		  	<ul class="pinhole-img-select-wrap">
		  	<?php foreach ( $items as $id => $item ): ?>
		  		<li>
		  			<?php $selected_class = $id == $meta['items'] ? ' selected': ''; ?>
		  			<img src="<?php echo esc_url($item['img']); ?>" title="<?php echo esc_attr($item['title']); ?>" class="pinhole-img-select<?php echo esc_attr($selected_class); ?>">
		  			<span><?php echo esc_html( $item['title'] ); ?></span>
		  			<input type="radio" class="pinhole-hidden" name="pinhole[albums][items]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['items'] );?>/>
		  		</li>
		  	<?php endforeach; ?>
		   </ul>

		   	<?php $display = $meta['layout'] == 'justify' ? 'none' : 'block'; ?>

			<div class="pinhole-template-settings-field-columns" style="display:<?php echo esc_attr( $display ); ?>;">

				<p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Columns', 'pinhole'); ?></label></p>

				<ul>
					<?php foreach ( $columns as $id => $column ): ?>
						<li>
							<label><input type="radio" name="pinhole[albums][columns]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['columns'] );?>/> <?php echo esc_html( $column ); ?> </label>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

			<?php $display = $meta['layout'] == 'justify' ? 'block' : 'none'; ?>

			<div class="pinhole-template-settings-field-layout_size" style="display:<?php echo esc_attr( $display ); ?>;">

				<p class="post-attributes-label-wrapper"><label class="post-attributes-label"><?php esc_html_e('Layout size', 'pinhole'); ?></label></p>

				<ul>
					<?php foreach ( $sizes as $id => $size ): ?>
						<li>
							<label><input type="radio" name="pinhole[albums][layout_size]" value="<?php echo esc_attr($id); ?>" <?php checked( $id, $meta['layout_size'] );?>/> <?php echo esc_html( $size ); ?> </label>
						</li>
					<?php endforeach; ?>
				</ul>

			</div>

		</div>

	  <?php
	}
endif;

?>