<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Adventures
 */

defined('ABSPATH') or die('No script kiddies please!');

$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';
$show_meta_info_hp = get_theme_mod('adventures_settings_meta_hp', 'no') == 'yes';
$show_meta_info = get_theme_mod('adventures_settings_postmeta_general', 'yes') == 'yes';

if($show_page_name) { ?>
<div class="alert-danger"><?php echo "content.php"; ?></div>
<?php } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-blog'); ?>>
	<div class="post-inner <?php echo (!empty($featured_img)  ? 'post-small-thumb' : ''); ?>">
		<div class="pull-left img-thumbnail">
			<?php the_post_thumbnail( 'small-width' ); ?>
		</div>
		<div class="blog-posts-list-text">
			<div class="entry-header">
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php _e( 'Featured', 'vikwp_adventures' ); ?></span>
				<?php endif; ?>
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</div><!-- .entry-header -->

			<?php adventures_excerpt(); ?>		

			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					get_the_title();
					the_content('Continue Reading');

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vikwp_adventures' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'vikwp_adventures' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
			</div><!-- .entry-content -->
		</div>
		<?php
		if(($show_meta_info) && !(is_front_page())) {?>
		<div class="entry-footer">
			<?php adventures_entry_meta(); ?>
		</div><!-- .entry-footer -->					 
		<?php } elseif((is_front_page()) && $show_meta_info_hp == 'yes') { ?>
		<div class="entry-footer">
			<?php adventures_entry_meta(); ?>
		</div><!-- .entry-footer -->
		<?php }  ?>			
		
		<div class="modify-post">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'vikwp_adventures' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div>
	</div>
</article><!-- #post-## -->
