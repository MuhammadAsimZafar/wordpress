<div <?php post_class('pinhole-item '. esc_attr( $pinhole_params['col_class'] ) ); ?>>
	<?php if( $fimg = pinhole_get_featured_image( $pinhole_params['img_size'] ) ): ?>
		<a href="<?php the_permalink(); ?>" class="item-link"><?php echo pinhole_wp_kses( $fimg ); ?></a>
	<?php endif; ?>
	<div class="pinhole-info">
		<?php if( $pinhole_params['category'] ) : ?>
			<div class="entry-category"><?php echo pinhole_get_category(); ?></div>
		<?php endif; ?>
		<?php $pinhole_heading_class = $pinhole_params['layout'] == 'classic' ? '' : ' h5'; ?>
		<?php the_title( sprintf( '<h2 class="entry-title'.$pinhole_heading_class.'"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if( !empty( $pinhole_params['meta'] ) ) : ?>
			<div class="entry-meta"><?php echo pinhole_get_meta_data( $pinhole_params['meta'] ); ?></div>
		<?php endif; ?>
		<?php if( $pinhole_params['excerpt'] ) : ?>
			<div class="entry-content"><?php echo pinhole_get_excerpt( $pinhole_params['excerpt_limit'] ); ?></div>
		<?php endif; ?>
	</div>
</div>