<?php

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
	return;

?>

<div id="comments" class="comments-area hidden-print">

	<?php if ( have_comments() ) : ?>

		<h3 class="comments-title"><?php comments_number( esc_html__('Comments','noo-organici'), esc_html__( 'Comment', 'noo-organici'), esc_html__( 'Comments', 'noo-organici') );?></h3>
		<ol class="comments-list">
			<?php
			wp_list_comments( array(
				'callback'	 => 'noo_organici_list_comments',
				'style'      => 'ol',
				'avatar_size'=> 80,
				) );
				?>
		</ol> <!-- /.comments-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="sr-only"><?php echo esc_html__( 'Comment navigation', 'noo-organici' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'noo-organici' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'noo-organici' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="nocomments"><?php echo esc_html__( 'Comments are closed.' , 'noo-organici' ); ?></p>
		<?php endif; ?>

	<?php endif; // end have_comments() ?>
		<?php
        noo_organici_comment_form( array(
			'comment_notes_after' => '',
			'id_submit'           => 'entry-comment-submit',
			'label_submit'        => esc_html__( 'Submit' , 'noo-organici' )
			) );
			?>
</div> <!-- /#comments.comments-area -->