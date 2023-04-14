<?php 

/**
 * The header for our theme
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

<div class="mainmenu">
	<nav class="l-inline">
		<div class="mainmenu-items">
			<div class="moduletable">
				<?php 
				if ( has_nav_menu( 'main-menu-right' ) ) {
					wp_nav_menu(array(
						'theme_location' => 'main-menu-right',
						'container_class' => 'logo-align-cnt',
						'menu_class'	=> 'nav menu',
						'walker' => new Nav_Walker_Nav_Menu()
					));
				}
				?>
			</div>
		</div>
	</nav>
</div>