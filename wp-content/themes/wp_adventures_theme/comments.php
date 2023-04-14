<?php 

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 * 
 */

defined('ABSPATH') or die('No script kiddies please!');

if (post_password_required()) {
	return;
}

?>

<?php 
$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';
if($show_page_name) { ?>
	<div class="alert-danger"><?php echo "comments.php"; ?></div>
<?php } ?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) { ?>
		<div class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if (1 === $comments_number) {
					/* translators: %s: post title */
					printf(_x('One thought on &ldquo;%s&rdquo;', 'comments title', 'vikwp_adventures'), get_the_title());
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s comment',
							'%1$s comments',
							$comments_number,
							'comments title',
							'vikwp_adventures'
						),
						number_format_i18n($comments_number),
						get_the_title()
					);
				}
			?>
		</div>

		<ol class="comment-list">
			<?php
				wp_list_comments('type=comment&callback=adventures_comment');
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php } // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if(!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) {
	?>
		<div class="no-comments"><?php _e('Comments are closed.', 'vikwp_adventures'); ?></div>
	<?php } ?>

	<?php
		comment_form(array(
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h4>',
		));		
	?>

</div><!-- .comments-area -->
