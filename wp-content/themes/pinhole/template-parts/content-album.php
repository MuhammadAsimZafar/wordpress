<div <?php post_class('pinhole-item ' .  esc_attr( $pinhole_params['col_class'] ) ); ?>>
	<?php if( $fimg = pinhole_get_featured_image( $pinhole_params['img_size'] ) ): ?>
		<a href="<?php the_permalink(); ?>" class="item-link"><?php echo pinhole_wp_kses( $fimg ); ?></a>
	<?php endif; ?>
	<div class="pinhole-info">
		<?php the_title( sprintf( '<h2 class="entry-title h5"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php if( $pinhole_params['gallery_count'] ) : ?>
			<div class="entry-meta"><?php echo pinhole_get_galleries_count(); ?> <?php echo __pinhole('galleries'); ?></div>
		<?php endif; ?>
	</div>
</div>