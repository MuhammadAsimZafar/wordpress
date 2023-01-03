<?php if ( !post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>

		<div class="section-header">
			<div class="section-title">
				<h3 class="entry-title"><?php comments_number( __pinhole( 'no_comments' ), __pinhole( 'one_comment' ), __pinhole( 'multiple_comments' ) ); ?></h3>
			</div>
			<div class="section-actions"><?php paginate_comments_links( array(  'prev_text' => '<i class="fa fa-chevron-left"></i>', 'next_text' => '<i class="fa fa-chevron-right"></i>', 'type' => 'list' ) ); ?></div>
		</div>

		<div id="comments" class="section-content pinhole-comments">

			<?php 
				$commenter = wp_get_current_commenter();
			    $req = get_option( 'require_name_email' );
			    $aria_req = ( $req ? " aria-required='true'" : '' );

			    $comment_form_args = array(
			        'title_reply' => '',
			        'label_submit' => __pinhole( 'comment_submit' ),
			        'cancel_reply_link' => __pinhole( 'comment_cancel_reply' ),
			        'comment_notes_before' => '',
			        'comment_notes_after' => '',
			        'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __pinhole( 'comment_text' ) .'</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .'</textarea></p>'
			    );

			    comment_form( $comment_form_args );

			  ?>
			
			<?php if ( have_comments() ) : ?>

				<ul class="comment-list">
					<?php $args = array(
						'avatar_size' => 50,
						'reply_text' => __pinhole( 'comment_reply' )
					); ?>
					<?php wp_list_comments( $args ); ?>
				</ul>
			<?php endif; ?>

		</div>

<?php endif; ?>