<?php
/**
 * Template for displaying search forms in Adventures Theme
 *
 * @package Wordpress
 * @subpackage Adventures
 * @since 1.0
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<div class="search-form-cnt">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">	
		<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'vikwp_adventures' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="btn search-submit"><i class="fas fa-search"></i> </button>
	</form>
</div>