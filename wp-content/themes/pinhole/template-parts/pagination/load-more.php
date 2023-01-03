<?php if ( $more_link = get_next_posts_link( __pinhole('load_more') ) ) : ?>
	<div class="pinhole-pagination alignnone">
		<nav class="navigation load-more">
		    <?php echo wp_kses_post( $more_link ); ?>
		    <div class="pinhole-loader">
				  <div class="dot dot1"></div>
				  <div class="dot dot2"></div>
				  <div class="dot dot3"></div>
				  <div class="dot dot4"></div>
		    </div>
		</nav>
	</div>
<?php endif; ?>