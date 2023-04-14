<?php
/**
 * The template used for displaying the internal post blog
 *
 * @package WordPress
 * @subpackage Adventures
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

$show_page_name = get_theme_mod( 'adventures_show_page_name', 'no' ) == 'yes';
$show_meta_info_hp = get_theme_mod( 'adventures_settings_meta_hp', 'no' ) == 'no';
$show_meta_info = get_theme_mod( 'adventures_settings_postmeta_general', 'no' ) == 'yes';
$show_meta_info_blog = get_theme_mod( 'adventures_settings_meta_posts', 'yes' ) == 'yes';

$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
$template_homepage = "page-templates/page-homepage.php";

if ( $show_page_name ) { ?>
<div class="alert-danger"><?php echo "content-blogpage.php"; ?></div>
<?php } ?>

<div id="main">
	<div class="article-main-container item-post-blog">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php		
		if ( $template == $template_homepage ) {
			get_template_part( 'template-parts/content', 'homepage' );
		} else {
		?>

		<div class="post-inner <?php echo ( !empty( $featured_img )  ? 'post-full-thumb' : '' ); ?>">
			
			<div class="post-content">
				<div class="entry-header page-header">
					<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
				</div>
				<div class="entry-img-featured">
				<?php
				 if ( ( $show_meta_info_blog ) || ( $show_meta_info ) ) {
				 	adventures_entry_meta();
				 } 
					
				?>
				<?php the_post_thumbnail('featured-hp'); ?>
				</div>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vikwp_adventures' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'vikwp_adventures' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );

					if ( comments_open() || get_comments_number() ) {
                        comments_template();
                    }
					?>
				</div><!-- .entry-content -->
			</div>				
		</div>
		
		<?php }
		?>
		</article><!-- #post-## -->
	</div>
</div>
	