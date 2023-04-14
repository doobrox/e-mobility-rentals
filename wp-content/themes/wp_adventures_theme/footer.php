<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

$copyright = get_theme_mod('adventures_settings_copyright', '');
$copyright_algn = get_theme_mod('adventures_settings_copyright_algn', 'right');
?>
<?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
	<footer>
		<div id="foot-cont">
			<div class="grid-block">		
				<?php get_template_part( 'template-parts/modules/sidebar', 'footer' ); ?>
			</div>
		</div>
	</footer>
<?php } ?>
<?php if(($copyright !== '')) { ?>
	<div id="subfooter">
		<div id="subfoot-cont">
			<div class="subfooter-text <?php echo "text-" . $copyright_algn; ?>">
				<?php echo $copyright; ?>
			</div>
		</div>
	</div>
<?php } ?>
<?php if('yes' === get_theme_mod('adventures_sett_showcookies', 'no')) { ?>
	<div class="cookies-cnt">
		<?php adventures_cookies_policy(); ?>
	</div>
<?php } 