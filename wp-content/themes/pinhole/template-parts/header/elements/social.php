<?php if( in_array('social', pinhole_get_option('header_elements', 'multi') ) ) : ?>
	<?php if ( has_nav_menu( 'pinhole_social_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'pinhole_social_menu', 'container'=> '', 'menu_class' => 'pinhole-soc-menu', 'link_before' => '<span class="pinhole-social-name">', 'link_after' => '</span>' ) ); ?>
	<?php else: ?>
			<?php if ( current_user_can( 'manage_options' ) ): ?>
				<ul class="pinhole-soc-menu">
					<li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' )); ?>"><?php esc_html_e( 'Click here to add social menu', 'pinhole' ); ?></a></li>
				</ul>
			<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>