<?php
/**
 * Template Name: Left and Right Sidebars
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

// call WP header file
get_header();
$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';

if($show_page_name) { ?>
<div class="alert-danger"><?php echo "page-sidebars.php"; ?></div>
<?php } ?>

<main id="main-inner">
	<div id="cnt-container">
		<div id="main-box" class="main-box grid-block <?php echo ( is_active_sidebar( 'sidebar-right' ) || is_active_sidebar( 'sidebarleft' )) ? 'mainbox-sidebarson' : '';?>">
				<?php
				// Start the loop.
				while (have_posts()) : the_post();

					// Include the page content template.
					get_template_part('template-parts/content', 'page-sidebar');

					// If comments are open or we have at least one comment, load up the comment template.
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
				// End the loop.
				endwhile;
				?>
		</div>
	</div>
</main>

<?php

// call WP footer file
get_footer();

// stop the buffer for the HTML body content
echo $document->display();
