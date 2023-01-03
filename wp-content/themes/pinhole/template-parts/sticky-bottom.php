<?php if( $pinhole_params['prevnext'] ) : ?>

	<?php $items = pinhole_get_prev_next_items(); ?>

	<?php if( !empty($items) ) : ?>

			<div class="pinhole-sticky-bottom">	
				<div class="sticky-bottom-slot">	
					<?php if ( !empty($items['prev']) ): ?>
					<a href="<?php echo esc_url( get_permalink( $items['prev']['id'] ) );?>" class="slot-left">					
						<span><?php echo wp_kses_post( $items['prev']['label']); ?></span>
						<i class="fa fa-angle-left"></i><?php echo get_the_title( $items['prev']['id'] );?></a>					
					<?php endif; ?>
				</div>

				<div class="sticky-bottom-slot">
					<?php if ( !empty( $items['next']) ): ?>	
					<a href="<?php echo esc_url( get_permalink( $items['next']['id'] ) ); ?>" class="slot-right">				
						<span><?php echo wp_kses_post( $items['next']['label']); ?></span>
						<?php echo get_the_title( $items['next']['id'] );?><i class="fa fa-angle-right"></i></a>						
					<?php endif; ?>
				</div>
			</div>

	<?php endif; ?>

<?php endif; ?>