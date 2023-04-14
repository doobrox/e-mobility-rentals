<?php
/**
 * The menu responsive
 *
 * @package WordPress
 * @subpackage Adventures
 */

defined('ABSPATH') or die('No script kiddies please!');

?>

<nav class="nav-devices-inner">
	<div class="nav-devices-list">
		<div class="mainmenu-items">
			<div class="moduletable">
				<?php
				if ( has_nav_menu( 'main-menu' ) ) {
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'container_class' => 'nav menu',
						'walker' => new Nav_Walker_Nav_Menu()
					));
				}				
				if ( has_nav_menu( 'main-menu-right' ) ) { 
					wp_nav_menu(array(
						'theme_location' => 'main-menu-right',
						'menu_class'	=> 'nav menu',
						'walker' => new Nav_Walker_Nav_Menu()
					)); 
				} 
				?>
			</div>
		</div>
		
		
	</div>
</nav>
