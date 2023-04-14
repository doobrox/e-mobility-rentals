<?php
/**
 * The template used for displaying post content
 *
 * @package WordPress
 * @subpackage Adventures
 */

defined('ABSPATH') or die('No script kiddies please!');

$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';
$show_meta_info_hp = get_theme_mod('adventures_settings_meta_hp', 'no') == 'yes';
$show_meta_info = get_theme_mod('adventures_settings_postmeta_general', 'yes') == 'yes';
$show_meta_info_blog = get_theme_mod('adventures_settings_postmeta_posts', 'no') == 'no';

$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
$template_homepage = "page-templates/page-homepage.php";
$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'blog-thumb');

if($show_page_name) { ?>
<div class="alert-danger"><?php echo "content-blog.php"; ?></div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-blog'); ?>>
	<div class="bloglist-layout post-inner <?php echo ( !empty( $featured_img )  ? 'post-small-thumb' : '' ); ?>">
		<?php		
		if($template == $template_homepage) {
			get_template_part('template-parts/content', 'homepage');
		} else {
		?>
		<div class="blog-cnt-text">
			<div class="blog-cnt-text-inner">
				<?php
				if ( ( $show_meta_info_blog ) || ( $show_meta_info ) ) { ?>
				<div class="article-info">
					<?php adventures_entry_meta(); ?>
				</div><!-- .entry-footer -->
				<?php }  ?>	
				<div class="page-header">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<?php if ( has_excerpt( $post->ID ) ) { ?>
					<?php adventures_excerpt(); ?>
				<?php } else { ?>			
					<div class="entry-content">
						<?php
							/* translators: %s: Name of current post */
							get_the_title();
							the_content( 'Continue Reading' );

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
				<?php } ?>
			</div>
		</div>
		<div class="pull-right img-thumbnail">
			<?php the_post_thumbnail( 'medium-height' ); ?>
		</div>
		<?php }
		?>
	</div>
</article><!-- #post-## -->
