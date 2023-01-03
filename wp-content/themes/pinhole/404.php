<?php get_header(); ?>

<div class="pinhole-section container">
	
	<div class="row">

		<div id="post-0" class="pinhole-single col-lg-12">

			<div class="section-header">

					<div class="section-title">
						 <h1 class="entry-title"><?php echo esc_html( __pinhole( '404_title') ); ?></h1>
					</div>

			</div>

			<div class="section-content entry-content">

					 <p class="text-center"><?php echo esc_html( __pinhole( '404_text') ); ?></p>
		            <?php get_search_form(); ?>
				
			</div>

		</div>

	</div>


</div>

<?php get_footer(); ?>