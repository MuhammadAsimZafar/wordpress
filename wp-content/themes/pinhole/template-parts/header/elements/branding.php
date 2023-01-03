<div class="pinhole-site-branding">
	<?php echo pinhole_get_branding(); ?>
	<?php if( in_array('desc', pinhole_get_option('header_elements', 'multi') ) ) : ?>
		<span class="site-description"><?php bloginfo( 'description' ); ?></span>
	<?php endif; ?>
</div>
