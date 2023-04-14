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
$featured_img = has_post_thumbnail();

if($show_page_name) { ?>
<div class="alert-danger"><?php echo "content-single.php"; ?></div>
<?php } ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner <?php echo (!empty($featured_img)  ? 'post-full-thumb' : ''); ?>">
		<?php //Start Thumbnails part		
		if (!empty($featured_img)) { ?>
		<div class="featured-container full-featured">
			<?php 
			//the_post_thumbnail( 'featured-big', array('class' => 'img-thumbnail') );
		 	$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'featured-big');
			?>
		 	<div class="featured-container-img" style="background-image: url(<?php echo $featured_img_url; ?>);">
		 		<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div>
				<div class="featured-container-mask"></div>		
		 	</div>
		</div>
		<?php } //End Thumbnails part ?>

		<?php adventures_excerpt(); ?>

		<div class="entry-content">
			<?php if (empty($featured_img)){ ?>
				<div class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</div><!-- .entry-header -->
			<?php } ?>
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

				if( is_single() ) :
	    			comments_template();
				endif;
			?>
		</div><!-- .entry-content -->

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
