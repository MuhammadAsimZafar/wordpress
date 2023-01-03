<div id="welcome-panel" class="welcome-panel pinhole-welcome-panel">
	
	<a href="#" class="welcome-panel-close" id="pinhole_update_box_hide">Dismiss</a>

	<div class="welcome-panel-content">
		
		<h2>Congratulations, your website just got better!</h2>
		<p class="about-description">Pinhole has been successfully updated to version <?php echo PINHOLE_THEME_VERSION; ?></a></p>

		<div class="welcome-panel-column-container">


				<?php if( version_compare( PINHOLE_THEME_VERSION, '1.5', '>=' ) && version_compare( get_option( 'pinhole_theme_version', '0.0.0' ), '1.4', '<=' ) ) : ?>

					<div class="welcome-panel-column important">
					<h3><span class="dashicons dashicons-warning"></span> Important note</h3>
					<p>This version introduces major changes to your theme. Additional actions may be required in order to finish the update process completely. Please check the release notes to make sure everything is set properly.</p>
					<a href="http://mekshq.com/docs/pinhole-change-log" target="_blank" class="button button-primary button-hero">Read more</a>
					</div>

				<?php else: ?>

					<div class="welcome-panel-column">
					<h3>What's new?</h3>
					<p>We do our best to keep our themes up-to-date. Take a few moments to see what's added in the latest version.</p>
					<a href="http://mekshq.com/docs/pinhole-change-log" target="_blank" class="button button-primary button-hero">View change log</a>
					</div>

				<?php endif; ?>

				<div class="welcome-panel-column">
				<h3>We listen to your feedback</h3>
				<p>If you have ideas which might help us make pinhole even better, we would love to hear from you!</p>
				<a href="http://mekshq.com/contact" target="_blank" class="button button-primary button-hero">Get in touch</a>
				</div>

				<?php 
				$tweet_text = "I'm very happy using Pinhole! Check out this great #WordPress theme by @meksHQ";
				$tweet_url = "http://mekshq.com/demo/pinhole";
				?>

				<div class="welcome-panel-column">
				<h3>Happy with Pinhole?</h3>
				<p>Why not share the feeling with the world? We would really appreciate it. </p>
				<a href="javascript:void(0);" data-url="http://twitter.com/intent/tweet?url=<?php echo esc_url($tweet_url); ?>&amp;text=<?php echo urlencode($tweet_text); ?>" class="mks-twitter-share-button button button-primary button-hero">Tweet about it!</a>
				</div>



		</div>

	</div>

</div>