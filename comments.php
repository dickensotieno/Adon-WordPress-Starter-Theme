<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Adon-Theme
 * @since Adon Theme 1.0
 */

if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' === basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die( 'Please do not load this page directly. Thanks!' );
}

if ( post_password_required() ) {
	esc_html_e( 'This post is password protected. Enter the password to view comments.', 'adontheme' );
	return false;
}
?>

<?php if ( have_comments() ) : ?>

	<h2 id="comments"><?php comments_number( __( 'No Responses', 'adontheme' ), __( 'One Response', 'adontheme' ), __( '% Responses', 'adontheme' ) ); ?></h2>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
		<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

<?php else : /* this is displayed if there are no comments so far */ { ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	<?php else : /* comments are closed */ { ?>
		<p><?php esc_html_e( 'Comments are closed.', 'adontheme' ); ?></p>

	<?php } endif; ?>

<?php } endif; ?>

<?php if ( comments_open() ) : ?>

	<div id="respond">

		<h2><?php comment_form_title( __( 'Leave a Reply', 'adontheme' ), __( 'Leave a Reply to %s', 'adontheme' ) ); ?></h2>

		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>

		<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) : ?>
			<p><?php esc_html_e( 'You must be', 'adontheme' ); ?>&nbsp;
				<a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>"><?php esc_html_e( 'logged in', 'adontheme' ); ?></a>&nbsp;
				<?php esc_html_e( 'to post a comment.', 'adontheme' ); ?>
			</p>
		<?php else : ?>

			<form
				action="<?php echo esc_attr( get_option( 'siteurl' ) ); ?>/wp-comments-post.php"
				method="post" id="commentform">

				<?php if ( is_user_logged_in() ) : ?>
					<p>
						<?php esc_html_e( 'Logged in as', 'adontheme' ); ?>
						<a href="<?php echo esc_attr( get_option( 'siteurl' ) ); ?>/wp-admin/profile.php"><?php echo esc_html( $user_identity ); ?></a>.&nbsp;
						<a href="<?php echo esc_attr( wp_logout_url( get_permalink() ) ); ?>"
						   title="Log out of this account"><?php esc_html_e( 'Log out', 'adontheme' ); ?> &raquo;</a>
					</p>

				<?php else : ?>

					<div>
						<input type="text" name="author" id="author"
							   value="<?php echo esc_attr( $comment_author ); ?>"
							   size="22"
							   tabindex="1" <?php echo $req ?: "aria-required='true'"; ?> />
						<label
							for="author"><?php esc_html_e( 'Name', 'adontheme' ); ?> <?php echo $req ?: '(required)'; ?></label>
					</div>

					<div>
						<input type="text" name="email" id="email"
							   value="<?php echo esc_attr( $comment_author_email ); ?>"
							   size="22"
							   tabindex="2" <?php echo $req ?: "aria-required='true'"; ?> />
						<label
							for="email"><?php esc_html_e( 'Mail (will not be published)', 'adontheme' ); ?> <?php echo $req ?: '(required)'; ?></label>
					</div>

					<div>
						<input type="text" name="url" id="url"
							   value="<?php echo esc_attr( $comment_author_url ); ?>"
							   size="22" tabindex="3"/>
						<label
							for="url"><?php esc_html_e( 'Website', 'adontheme' ); ?></label>
					</div>

				<?php endif; ?>

				<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

				<div>
					<textarea name="comment" id="comment" cols="58" rows="10"
							  tabindex="4"></textarea>
				</div>

				<div>
					<input name="submit" type="submit" id="submit" tabindex="5"
						   value="<?php esc_attr_e( 'Submit Comment', 'adontheme' ); ?>"/>
					<?php comment_id_fields(); ?>
				</div>

				<?php do_action( 'comment_form', $post->ID ); ?>

			</form>

		<?php endif; /* If registration required and not logged in */ ?>

	</div>

<?php endif; ?>
