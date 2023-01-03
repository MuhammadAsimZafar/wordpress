<?php get_header(); ?>

<?php $pinhole_params = pinhole_get_archive_template_params(); ?>

<div class="pinhole-section container">
	
	<div class="row">
		<div class="col-lg-12">

			<?php if(!empty( $pinhole_params['heading'] ) ): ?>
				<div class="section-header">						
					<?php if(!empty( $pinhole_params['heading']['title'] ) ): ?>
						<div class="section-title">
							<h1 class="entry-title"><?php echo wp_kses_post( $pinhole_params['heading']['title'] ); ?></h1>
						</div>
					<?php endif; ?>
					<?php if(!empty( $pinhole_params['heading']['desc'] ) ): ?>
							<div class="section-desc">
								<?php echo wp_kses_post( $pinhole_params['heading']['desc'] ); ?>
							</div>
					<?php endif; ?>
				</div>

			<?php endif; ?>

			<div class="section-content">

				<?php if( have_posts() ) : ?>

					<div class="pinhole-gallery pinhole-posts pinhole-<?php echo esc_attr( $pinhole_params['layout'] ); ?> items-<?php echo esc_attr( $pinhole_params['items'] ); ?> <?php echo esc_attr($pinhole_params['layout_size']); ?> clearfix row row-eq-height">
						
						<?php while( have_posts() ) : the_post(); ?>

							<?php include( locate_template('template-parts/content-post.php') ); ?>

						<?php endwhile; ?>

					</div>

					<?php get_template_part('template-parts/pagination/'. $pinhole_params['pagination'] ); ?>

				<?php else: ?>

					<?php get_template_part('template-parts/content-none' ); ?>

				<?php endif; ?>

			</div>

		</div>
	</div>
</div>


<?php get_footer(); ?>