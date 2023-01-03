<?php if( $pagination = get_the_posts_pagination( array( 'mid_size' => 2, 'prev_text' => __pinhole( 'previous_posts' ), 'next_text' => __pinhole( 'next_posts' ) ) ) ) : ?>
	<div class="pinhole-pagination alignnone">
		<?php echo wp_kses_post( $pagination ); ?>
	</div>
<?php endif; ?>
