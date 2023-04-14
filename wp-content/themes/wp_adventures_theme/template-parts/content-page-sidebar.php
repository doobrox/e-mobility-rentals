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

$template = get_post_meta( get_the_ID(), '_wp_page_template', true );
$template_homepage = "page-templates/page-homepage.php";
$featured_img = has_post_thumbnail();
$featured_img_url = get_the_post_thumbnail_url(get_the_ID());

if($show_page_name) { ?>

<div class="alert-danger"><?php echo "content-page-sidebar.php"; ?></div>
<?php } ?>

<div id="main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post-inner <?php echo (!empty($featured_img)  ? 'post-full-thumb' : ''); ?>">
		
		<?php
		if( get_post_format() === false ) {
			if(($show_meta_info) && !(is_front_page())) { ?>
			<div class="article-info">
				<?php adventures_entry_meta(); ?>
			</div><!-- .entry-footer -->					 
			<?php } elseif((is_front_page()) && $show_meta_info_hp == 'yes') { ?>
				<div class="article-info">
					<?php adventures_entry_meta(); ?>
				</div><!-- .entry-footer -->
			<?php } 
		} ?>
		
		<?php if (empty($featured_img) || is_single()){ ?>
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div><!-- .entry-header -->
			<?php } ?>
		
		<div class="post-content">
			<?php if (is_single()){ ?>
				<div class="blog-post-featured-img">
					<img src="<?php echo $featured_img_url; ?>" title="<?php the_title(); ?>" />
				</div>
			<?php } ?>

			
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
				?>
			</div><!-- .entry-content -->
		</div>
	</div>
	</article><!-- #post-## -->
</div>
<?php if ( is_active_sidebar( 'sidebar-right' ) ) { ?>
<!-- Sidebar Right -->
	<?php get_template_part( 'template-parts/modules/sidebar', 'right' ); ?>
<?php } ?>

<?php if ( is_active_sidebar( 'sidebarleft' ) ) { ?>
<!-- Sidebar Left -->
	<?php get_template_part( 'template-parts/modules/sidebar', 'left' ); ?>
<?php } ?>
