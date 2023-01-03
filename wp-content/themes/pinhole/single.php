<?php get_header(); ?>

<?php $pinhole_params = pinhole_get_single_template_params(); ?>

<div class="pinhole-section container">
	
	<?php while( have_posts() ) : the_post(); ?>

	<div class="row">

		<div id="post-<?php the_ID(); ?>" <?php post_class( 'pinhole-single col-lg-12'); ?>>

			<div class="section-header">
					
					<?php if( $pinhole_params['category'] ) : ?>
						<div class="entry-category"><?php echo pinhole_get_category(); ?></div>
					<?php endif; ?>

					<div class="section-title">
						 <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>

					<?php if( !empty( $pinhole_params['meta'] ) ) : ?>
						<div class="entry-meta"><?php echo pinhole_get_meta_data( $pinhole_params['meta'] ); ?></div>
					<?php endif; ?>

			</div>

			<div class="section-content entry-content">
				
				<?php if( $pinhole_params['fimg'] && $fimg = pinhole_get_featured_image('col-1', true ) ): ?>
					<div class="entry-media align-none">
						<?php echo pinhole_wp_kses( $fimg ); ?>
					</div>
				<?php endif; ?>

				
					<?php the_content(); ?>

					<?php wp_link_pages(); ?>

					<?php if( $pinhole_params['tags'] ) : ?>
						<div class="entry-tags"><?php the_tags('','',''); ?></div>
					<?php endif; ?>
			
				
			</div>

			<?php include( locate_template('template-parts/share.php') ); ?>

			<?php include( locate_template('template-parts/author.php') ); ?>

			<?php comments_template(); ?>

		</div>

	</div>

	<?php endwhile; ?>

</div>

<?php include( locate_template('template-parts/sticky-bottom.php') ); ?>

<?php get_footer(); ?>