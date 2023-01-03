<?php if( $pinhole_params['author'] && $author_description = wpautop( get_the_author_meta('description') ) ) : ?>
	<div class="section-header author-header">
		<?php echo get_avatar( get_the_author_meta('ID'), 100); ?>
		<div class="section-title">
			<h3 class="entry-title h4"><?php echo get_the_author_meta('display_name'); ?></h3>
		</div>
		<div class="entry-meta author-entry-meta"><?php echo pinhole_get_author_links( get_the_author_meta('ID') ); ?></div>
	</div>

	<div class="section-content row">
		<div class="text-center">
			<?php echo wp_kses_post($author_description); ?>
		</div>
	</div>
<?php endif; ?>