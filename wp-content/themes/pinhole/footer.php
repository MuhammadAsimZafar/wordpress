	<footer id="pinhole-footer" class="pinhole-footer container">

		<div class="row justify-center text-center">

				<div class="col-lg-4"><div class="widget"><?php echo wp_kses_post( str_replace( '{current_year}', date( 'Y' ), pinhole_get_option( 'footer_copyright' ) ) ); ?></div></div>

		</div>

	</footer>

	<?php get_sidebar(); ?>

	<?php get_template_part( 'template-parts/gallery-placeholder' ); ?>

	<?php wp_footer(); ?>


	</body>
</html>
