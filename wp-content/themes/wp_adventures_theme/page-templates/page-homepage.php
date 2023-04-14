<?php
/**
 * Template Name: Home Page
 *
 * If the user select this template, the page will have all the sidebars enabled.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

// start the buffer to include the HTML body content
$document = VikWpDocument::getInstance();
?>
<div class="main-content-container">
	<div id="cnt-main-part" class="cnt-main-part">
		<?php
		// call WP header file
		get_header();
		$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';

		if($show_page_name) { ?>
			<div class="alert-danger"><?php echo "page-homepage.php"; ?></div>
		<?php } ?>
		<main id="main-inner">
			<div id="cnt-container">
				<div class="main-box grid-block">
					<section class="main grid-box">
						<div class="main-body">
							<?php
							// Start the loop.
							while (have_posts()) : the_post();

								// Include the page content template.
								get_template_part('template-parts/content', 'page');

								// If comments are open or we have at least one comment, load up the comment template.
								if (comments_open() || get_comments_number()) {
									comments_template();
								}

							// End the loop.
							endwhile;
							?>
						</div>
					</section>
				</div>
			</div>
		</main>
		<?php if ( is_active_sidebar( 'module-box-01' ) ) { ?>
			<?php get_template_part( 'template-parts/modules/module-box-01', '' ); ?>
		<?php } ?>
	</div>
</div>
<?php if ( is_active_sidebar( 'module-box-02' ) ) { ?>
	<?php get_template_part( 'template-parts/modules/module-box-02', '' ); ?>
<?php } ?>
<?php if ( is_active_sidebar( 'module-box-03' ) ) { ?>
	<?php get_template_part( 'template-parts/modules/module-box-03', '' ); ?>
<?php } ?>
<?php if ( is_active_sidebar( 'module-box-04' ) ) { ?>
	<?php get_template_part( 'template-parts/modules/module-box-04', '' ); ?>
<?php } ?>
<?php if ( is_active_sidebar( 'module-box-05' ) ) { ?>
	<?php get_template_part( 'template-parts/modules/module-box-05', '' ); ?>
<?php } ?>

<?php if ( is_active_sidebar( 'upfooter' ) ) { ?>
	<?php get_template_part( 'template-parts/modules/upfooter', '' ); ?>
<?php } ?>

<?php

// call WP footer file
get_footer();

// stop the buffer for the HTML body content
echo $document->display();
