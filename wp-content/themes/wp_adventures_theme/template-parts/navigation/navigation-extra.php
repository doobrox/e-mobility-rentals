<?php 

/**
 * The header for our theme
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 * 
 */

defined('ABSPATH') or die('No script kiddies please!');

?>

<div id="tbar-upmenu">
	<div class="upmenu-content">
		<?php if(is_active_sidebar( 'topbar-left')) { ?>
			<div id="tbar-left">
				<?php
					dynamic_sidebar( 'topbar-left' );
				?>
			</div>
		<?php } ?>
		<?php if (is_active_sidebar( 'topbar')) { ?>
			<div id="tbar-right">
				<?php
					dynamic_sidebar( 'topbar' );
				?>
			</div>
		<?php } ?>
	</div>
</div>