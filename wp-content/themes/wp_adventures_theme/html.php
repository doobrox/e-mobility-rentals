<?php 

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 * 
 */

defined('ABSPATH') or die('No script kiddies please!');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="HandheldFriendly" content="true">

		<style>
		<?php 
		$css_string = "";
		echo $css_string;

		/*
		 *	@since 1.1.16
		 * If the Google Custom Font textarea is NOT empty, print just the custom Google Font family link.
		 */
		 
		if(!empty(get_theme_mod('adventures_titlecustomfam_header', ''))) {
			echo get_theme_mod('adventures_titlecustomfam_header');
		}
		?>

		</style>
		<?php wp_head(); ?>
	</head>
	<body class="vikwp-body">
		<?php
		$show_page_name = get_theme_mod('adventures_show_page_name', 'no') == 'yes';
		if($show_page_name) { ?>
			<div class="alert-danger"><?php echo "html.php"; ?></div>
		<?php } ?>
		<!-- Start Main box -->
		<div id="main-container">
			<div id="container">
				<?php 
				//Just enabled in the plugin demo website
				//get_template_part('vikinfodemo', ''); ?>
				<?php echo $this->page; ?>

			</div>
		</div>
		<div id="nav-menu-devices" class="nav-devices-content">
			<?php get_template_part('template-parts/navigation/navigation', 'responsive'); ?>
		</div>
		
		<!-- End Main box -->
		<?php wp_footer(); ?>
	</body>

</html>
