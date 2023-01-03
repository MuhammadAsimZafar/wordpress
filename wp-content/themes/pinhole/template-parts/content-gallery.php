<div <?php post_class('pinhole-item ' . esc_attr( $pinhole_params['col_class'] ). ' ' . esc_attr( $gallery_item['filter_class']) ); ?>>
	<?php if( $fimg = pinhole_get_featured_image( $pinhole_params['img_size'] ) ): ?>
		<a href="<?php the_permalink(); ?>" class="item-link"><?php echo pinhole_wp_kses( $fimg ); ?></a>
	<?php endif; ?>
	<div class="pinhole-info">
		<?php if(!empty($gallery_item['album_link'])): ?>
			<div class="entry-category"><?php echo wp_kses_post( $gallery_item['album_link'] ); ?></div>
		<?php endif; ?>
		<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if( $pinhole_params['image_count'] ) : ?>
			<div class="entry-meta"><?php echo pinhole_get_images_count(); ?> <?php echo __pinhole('photos'); ?></div>
		<?php endif; ?>
	</div>
</div>