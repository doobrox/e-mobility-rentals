<?php
/**
 * Template Name: Blank Page
 *
 * If the user select this template, the page will not have any content (menu, sidebars, etc.) except the main content.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

/*
 * Hide the admin bar for administrators.
 */
add_filter('show_admin_bar', '__return_false');

// start the buffer to include the HTML body content
$document = VikWpDocument::getInstance();

// call WP header file
get_header();
$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';

if($show_page_name) { ?>
<div class="alert-danger"><?php echo "page-blank.php"; ?></div>
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

<?php

// stop the buffer for the HTML body content
echo $document->display();
