<?php
/**
 * The template used for display the homepage layout
 *
 * @package WordPress
 * @subpackage Adventures
 */

defined('ABSPATH') or die('No script kiddies please!');

$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';
$show_meta_info_hp = get_theme_mod('adventures_settings_meta_hp', 'no') == 'yes';
$show_meta_info = get_theme_mod('adventures_settings_postmeta_general', 'yes') == 'yes';
$featured_img = has_post_thumbnail();

global $more;
$more = 0;

if($show_page_name) { ?>
	<div class="alert-danger"><?php echo "content-homepage.php"; ?></div>
<?php } ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner homepage-page">
		<div class="post-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-sm-6 col-md-6 homepage-page-img">
						<?php the_post_thumbnail( 'featured-big', array('class' => 'img-fluid') ); ?>
					</div>
					<div class="col-12 col-sm-5 col-md-6 homepage-page-cnt">
						
						<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
						<div class="entry-content">
							<?php

							adventures_excerpt(); 
							
							the_content('Read More');

							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'vikwp_adventures' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
								'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'vikwp_adventures' ) . ' </span>%',
								'separator'   => '<span class="screen-reader-text">, </span>',
							) );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
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
</article><!-- #post-## -->
	

				