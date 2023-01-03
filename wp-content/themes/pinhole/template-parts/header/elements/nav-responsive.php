<?php if( in_array('nav', pinhole_get_option('header_elements', 'multi') ) ) : ?>

	<?php if ( has_nav_menu( 'pinhole_main_menu' ) ) : ?>
		<?php wp_nav_menu( array( 'theme_location' => 'pinhole_main_menu', 'container'=> '', 'menu_class' => 'pinhole-nav-responsive',  ) ); ?>
	<?php else: ?>
		<?php if ( current_user_can( 'manage_options' ) ): ?>
			<ul class="pinhole-main-nav pinhole-nav">
				<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' )); ?>"><?php esc_html_e( 'Click here to add main navigation', 'pinhole' ); ?></a></li>
			</ul>
		<?php endif; ?>
	<?php endif; ?>

<?php endif; ?>