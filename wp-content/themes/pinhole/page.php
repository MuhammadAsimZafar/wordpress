<?php get_header(); ?>

<?php $pinhole_params = pinhole_get_page_template_params(); ?>

<div class="pinhole-section container">
	
	<div class="row">
		
		<?php while( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class( 'pinhole-single col-lg-12'); ?>>

				<?php if(!is_front_page()) : ?>
					<div class="section-header">
						<div class="section-title">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</div>
						<?php if( $pinhole_params['image_count'] ) : ?>
							<div class="entry-meta"><?php echo pinhole_get_images_count(); ?> <?php echo __pinhole('photos'); ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="section-content entry-content">
						 <?php if( $pinhole_params['fimg'] && $fimg = pinhole_get_featured_image('col-1', true ) ): ?>
							<div class="entry-media align-none">
								<?php echo pinhole_wp_kses( $fimg ); ?>
							</div>
						<?php endif; ?>
	
						<?php the_content(); ?>
				</div>

				<?php include( locate_template('template-parts/share.php') ); ?>

				<?php comments_template(); ?>

			</div>

		<?php endwhile; ?>

	</div>
</div>

<?php include( locate_template('template-parts/sticky-bottom.php') ); ?>

<?php get_footer(); ?>