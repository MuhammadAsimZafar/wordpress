<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header id="pinhole-header" class="pinhole-header pinhole-header-<?php echo pinhole_get_option('header_layout'); ?>">
			<div class="container-full">
				<div class="row">
					<?php get_template_part('template-parts/header/layout-'.pinhole_get_option('header_layout')); ?>
				</div>
			</div>	
			
			<div class="pinhole-header-sticky">
				<div class="container-full">
				<?php get_template_part('template-parts/header/layout-'.pinhole_get_option('header_layout')); ?>
				</div>
			</div>
		</header>