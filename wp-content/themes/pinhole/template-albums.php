<?php
/**
 * Template Name: Albums
 */
?>
<?php get_header(); ?>

<?php $pinhole_params = pinhole_get_albums_template_params(); ?>

<div class="pinhole-section container">
	
	<div class="row">
		<?php while( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class( 'pinhole-single col-lg-12'); ?>>

			<?php if(!is_front_page()) : ?>
				<div class="section-header">
					<div class="section-title">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</div>
				</div>
		   <?php endif; ?>

			<div class="section-content entry-content">

				<?php the_content(); ?>

				<?php $albums_query =  new WP_Query( $pinhole_params['query'] ); ?>

				<?php if( $albums_query->have_posts() ) : ?>

					<div class="pinhole-gallery pinhole-<?php echo esc_attr( $pinhole_params['layout'] ); ?> items-<?php echo esc_attr($pinhole_params['items']); ?> <?php echo esc_attr($pinhole_params['layout_size']); ?> clearfix row">
						
						<?php while( $albums_query->have_posts() ) : $albums_query->the_post(); ?>

							<?php include( locate_template('template-parts/content-album.php') ); ?>

						<?php endwhile; ?>

					</div>

				<?php else: ?>

					<?php if( !pinhole_has_gallery() ): ?>
						<p class="text-center"><?php esc_html_e('This page has no albums yet. Please create a couple of pages and assign this page as its parent page.', 'pinhole'); ?></p>
					<?php endif; ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>

		</div>

		<?php endwhile; ?>

	</div>
</div>


<?php get_footer(); ?>