<?php if ( !empty( $pinhole_params['share'] ) && function_exists('meks_ess_share') ) : ?>

	<div class="section-content">
		
		<div class="pinhole-share">

			<?php meks_ess_share( array_values( $pinhole_params['share'] ), true, '<div class="meks_ess rectangle no-labels">', '</div>' ); ?>
			
		</div>

	</div>

<?php endif; ?>