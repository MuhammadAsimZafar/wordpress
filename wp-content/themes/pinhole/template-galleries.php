<?php
/**
 * Template Name: Galleries
 */
?>
<?php get_header(); ?>

<?php $pinhole_params = pinhole_get_galleries_template_params(); ?>

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


				<?php if( $pinhole_params['has_grandchildren'] ): ?>
					<div class="section-actions">
						<ul class="section-filter">
							<li><a href="javascript:void(0);" class="filter-active" data-filter="0">All</a></li>
							<?php foreach( $pinhole_params['sub_albums'] as $sub_album ): ?>
								<li><a href="javascript:void(0);" data-filter="album-<?php echo esc_attr( $sub_album['id'] ); ?>"><?php echo wp_kses_post( $sub_album['title'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
			    <?php endif; ?>



				<div class="section-content entry-content">

					<?php the_content(); ?>

					<?php $galleries_query =  new WP_Query( $pinhole_params['query'] ); ?>

					<?php if( $galleries_query->have_posts() ) : ?>

						<div class="pinhole-gallery pinhole-<?php echo esc_attr($pinhole_params['layout']); ?> items-<?php echo esc_attr($pinhole_params['items']); ?> <?php echo esc_attr($pinhole_params['layout_size']); ?> clearfix row">
							
							<?php while( $galleries_query->have_posts() ) : $galleries_query->the_post(); ?>

								<?php $gallery_item = pinhole_get_additional_gallery_params( $pinhole_params ); ?>

								<?php include( locate_template('template-parts/content-gallery.php') ); ?>

							<?php endwhile; ?>

						</div>

					<?php else: ?>

						<?php if( !pinhole_has_gallery() ): ?>
							<p class="text-center"><?php esc_html_e('No galleries to display, yet. Please create a couple of pages and assign this page as its parent page.', 'pinhole'); ?></p>
						<?php endif; ?>

					<?php endif; ?>

					<?php wp_reset_postdata(); ?>

				</div>

		</div>

		<?php endwhile; ?>

	</div>
</div>


<?php get_footer(); ?>