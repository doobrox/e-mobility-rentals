<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

?>

<?php if (is_active_sidebar('sidebarleft')) { ?>
	<aside id="left" class="sidebar widget-area" role="complementary">
		<?php dynamic_sidebar('sidebarleft'); ?>
	</aside><!-- .sidebar .widget-area -->
<?php } 