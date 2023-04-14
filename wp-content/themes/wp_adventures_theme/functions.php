<?php
/**
 * Adventures functions and definitions
 *
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0.2
 */

defined('ABSPATH') or die('No script kiddies please!');

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'document.php';

if (!defined("ADVENTURES_VERSION")) {
	define("ADVENTURES_VERSION" , "1.2.1");
}
if (!current_user_can("manage_options")) {
	show_admin_bar(false);
}

function adventures_version_callback() {
	return ADVENTURES_VERSION;
}
add_filter("vikwp_vikupdater_adventures_version", "adventures_version_callback");
/*
 * @since 1.1.18
 * Add a new parameter in the customizer to select the Classic Widgets page instead the block one. This to avoid the red notice blocks.
 */
if(get_theme_mod('adventures_classic_widgets', 'yes') == 'yes') {
	add_filter( 'use_widgets_block_editor', '__return_false' );
}
/*
* @since 1.1.2
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded <title> tag in the document head, and expect WordPress to
* provide it for us.
*/
add_theme_support( 'title-tag' );

/**
*
* @since 1.0.3
*
* @wponly
*
* New hooks to force overrides updates through VikUpdater.
*/

add_filter("vikwp_vikupdater_adventures_mainplugin" , "adventures_mainplugin");

function adventures_mainplugin() {
	return 'vikrentcar';
}

add_filter("vikwp_vikupdater_adventures_directory" , "adventures_directory");

function adventures_directory() {
	return dirname(__FILE__);
}
//END

function adventures_path_callback() {
	return get_template_directory().DIRECTORY_SEPARATOR."..";
}
add_filter("vikwp_vikupdater_adventures_path", "adventures_path_callback");


// Theme CSS and Scripts Files
function add_theme_scripts() {

	wp_register_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.css', false, ADVENTURES_VERSION, 'all');
	wp_enqueue_style('bootstrap');

	wp_register_style('style', get_template_directory_uri() . '/style.css', false, ADVENTURES_VERSION, 'all');
	wp_enqueue_style('style');	

	/**
	*
	* @since 1.0.7
	*
	* Load FontAwesome just from the theme and VikRentCar plugin. Removed load from the VikWidgetsLoader
	*/

	if(get_theme_mod('adventures_fontawes_setting', 'yes') == 'yes') {
		wp_register_style('adventure-fontawesome', get_template_directory_uri() . '/assets/font-awesome/css/all.min.css', false, ADVENTURES_VERSION, 'all');
		wp_enqueue_style('adventure-fontawesome');
	}

	wp_register_style('animate', get_template_directory_uri() . '/assets/css/animate.css', false, ADVENTURES_VERSION, 'all');
	wp_enqueue_style('animate');	

	wp_register_style('theme-colors', get_template_directory_uri() . '/assets/css/theme-colors.css', false,time(),'all');
	wp_enqueue_style('theme-colors');

	if(empty(get_theme_mod('seasons_titlecustomfam_header', ''))) {
		wp_register_style('-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('adventures_fonts_header', '')).':100,300,400,700');
		wp_enqueue_style('-title-font');

		wp_register_style('-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('adventures_bodyfonts_header', '')).':100,300,400,700');
		wp_enqueue_style('-body-font');
	}

	if(get_theme_mod('adventures_header_activate_settings', 'slider') == 'slider') {
		wp_register_style('bootstrap-touchslider', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap-touch-slider.css', false, ADVENTURES_VERSION, 'all');
		wp_enqueue_style('bootstrap-touchslider');

		wp_enqueue_script('slider_effects', get_template_directory_uri() . '/assets/js/effects.js', array('jquery'));
		wp_enqueue_script('slider_bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'));
		wp_enqueue_script('slider_touchsliderjs', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap-touch-slider.js', array('jquery'));
	}

	/* Start Device Responsive - Mobile */
	wp_register_style('responsive_device', get_template_directory_uri() . '/assets/css/responsive_device.css', false, ADVENTURES_VERSION, 'only screen and (min-device-width : 80px) and (max-device-width : 1400px)');
	wp_enqueue_style('responsive_device');

	wp_register_style('responsive_general', get_template_directory_uri() . '/assets/css/responsive_general.css', false, ADVENTURES_VERSION, 'only screen and (min-device-width : 80px) and (max-device-width : 1400px)');
	wp_enqueue_style('responsive_general');	

	/* Start Device Responsive - Desktop */
	wp_register_style('responsive_desktop', get_template_directory_uri() . '/assets/css/responsive_device.css', false, ADVENTURES_VERSION, 'only screen and (min-width : 80px) and (max-width : 1400px)');
	wp_enqueue_style('responsive_desktop');

	wp_register_style('responsive_desktop_general', get_template_directory_uri() . '/assets/css/responsive_general.css', false, ADVENTURES_VERSION, 'only screen and (min-width : 80px) and (max-width : 1400px)');
	wp_enqueue_style('responsive_desktop_general');	

	/* End Responsive */
	
	wp_enqueue_script('themekit', get_template_directory_uri() . '/assets/js/themekit.js', array ('jquery'), ADVENTURES_VERSION, false);
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

// Compile the less files via PHP and then served the cached file.
add_action( 'wp_print_styles', 'compile_less_files_to_css' );

function compile_less_files_to_css() {
	require(dirname(__FILE__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'lessc.inc.php');
	$less = new lessc;

	$to_cache = array(
		realpath(dirname(__FILE__) . "/assets/css/less/variables.less") => get_bloginfo('wpurl'),
		realpath(dirname(__FILE__) . "/assets/css/less/vikwp-plugin.less") => get_bloginfo('wpurl')
	);
	Less_Cache::$cache_dir = realpath(dirname(__FILE__) . "/assets/css/less/cache");
	Less_Cache::CleanCache();
	$parser_options['compress'] = true;
	$css_file_name = Less_Cache::Get( $to_cache, $parser_options );
	wp_enqueue_style('variables', get_template_directory_uri() . "/assets/css/less/cache/" . $css_file_name);
}

/** Add custom css to the head of the Administrator side **/
add_action('admin_head', 'adventures_custom_admin_css');


function adventures_custom_admin_css() {
  echo '<style>
  	.vikwp-widget-cnt {  		
  		display: flex;
  		flex-wrap: wrap;
  	}
	.vikwp-widget-col {
		flex: 1;
	}
	.vikwp-widget-col-inner {
		background: #f6f6f6;
  		border: 1px solid #ddd;
  		padding: 10px;
  		margin: 5px;
	}
  	.vikwp_widget_more.open {
  		margin-left: -200px;
  	}
  	.vikwp-widget-box {
  		background: #eee;
		border: 1px solid #ddd;
		padding: 10px;
  	}
  	.vikwp-widget-cnt label {
  		margin-bottom: 3px;
  		display: inline-block;
  	}
    
  </style>';
}


// Start Menu Positions 
function register_my_menus() {
	register_nav_menus(
		array(
		'main-menu'  => __('Main Menu Left'),
		'main-menu-right'  => __('Main Menu Right')
		)
	);
}
add_action('init', 'register_my_menus');

/* @since v1.1.5 
 * New function to get the IMG url from the Customizer. 
 * In this way we are going to avoid problems with IMG url protocol (http/https) with some servers.
 */
function get_theme_mod_img($mod_name){
	return str_replace(array('http:', 'https:'), '', get_theme_mod($mod_name));
}

// Add a custom logo
function adventures_custom_logo_setup() {
	$defaults = array(
		'width'			=> 250,
		'flex-width'	=> true,
	);
	add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'adventures_custom_logo_setup');

// Post Format
function adventures_postformat_setup() {
    add_theme_support( 'post-formats', array( 'aside', 'audio', 'gallery', 'image', 'quote', 'link', 'video' ) );
}
add_action( 'after_setup_theme', 'adventures_postformat_setup' );

add_action('switch_theme', 'remove_adventures_mods');

function remove_adventures_mods() {
	delete_option( 'theme_mods_' . get_option( 'theme_switched' ) );
	delete_option( 'vikwp_adventures_write_widgets' );
	delete_option( 'adventures_test_data' );
}

add_action('after_switch_theme', 'initial_functions');

function initial_functions() {
	update_option('vikwp_adventures_write_widgets', true);
}

// Custom Comment template
function adventures_comment($comment, $args, $depth) {

    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li ';
        $add_below = 'div-comment';
    }?>
    <<?php echo $tag; comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
    if ( 'div' != $args['style'] ) { ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
    } ?>
    	<div class="comment-head">
	    	<div class="comment-img-avatar">
	    		<?php 
		    	if ( $args['avatar_size'] != 0 ) {
		                echo get_avatar( $comment, 52 ); 
		            } 
		        ?>
	    	</div>

        	<div class="comment-info">
        		<div class="comment-author vcard">
        		<?php             
           		printf( __( '<span class="fn">%s</span>' ), get_comment_author_link() ); ?>
        		</div>
	        	<?php 
		        if ( $comment->comment_approved == '0' ) { ?>
		            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is waiting moderation.' ); ?></em><br/><?php 
		        } ?>
		        <div class="comment-meta commentmetadata">
		            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
		                /* translators: 1: date, 2: time */
		                printf( 
		                    __('%1$s at %2$s'), 
		                    get_comment_date(),  
		                    get_comment_time() 
		                ); ?>
		            </a>
		            <?php 
		            edit_comment_link( __( 'Edit' ), '  ', '' ); ?>
		        </div>
	    	</div>
    	</div>

        <div class="comment-message"><?php comment_text(); ?></div>

        <div class="reply"> <?php 
                comment_reply_link( 
                    array_merge( 
                        $args, 
                        array( 
                            'add_below' => $add_below, 
                            'depth'     => $depth, 
                            'max_depth' => $args['max_depth'] 
                        ) 
                    ) 
                ); ?>
        </div><?php 
    		if ( 'div' != $args['style'] ) : ?>
        </div><?php 
    endif;
}


// Add theme support for Featured Images
require get_template_directory() . '/framework/customizer/customizer.php';
require get_template_directory() . '/inc/header-functions.php';
require get_template_directory() . '/inc/cookies-functions.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/initialization-functions.php';


/*	Add Polylang compatibility
 *	@since 1.0.1
 */
include get_template_directory() . '/inc/prepare_langs.php';

/* Hook to install the VRC overrides when the theme has been switched ON */
add_action('after_switch_theme', 'adventures_install_vrc_overrides');

function adventures_install_vrc_overrides() {
	if (!class_exists('JLoader')) {
		// Vik Rent Car is not installed
		return false;
	}

	// get the array information of the upload dir
	$upload_dir = wp_upload_dir();
	if (!is_array($upload_dir) || empty($upload_dir['basedir'])) {
		return false;
	}

	// load dependencies
	JLoader::import('adapter.filesystem.folder');

	// read the content of the overrides folder in the Theme's root dir
	$folders = JFolder::folders(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'overrides', $filter = '.', $recurse = false, $full = true);

	$base_dest = $upload_dir['basedir'] . DIRECTORY_SEPARATOR . 'vikrentcar' . DIRECTORY_SEPARATOR . 'overrides' . DIRECTORY_SEPARATOR;

	foreach ($folders as $override_folder) {
		JFolder::copy($override_folder, $base_dest . basename($override_folder));
	}
}

/**
 * Handle overrides update when upgrading the theme to a newer version.
 */
add_action('init', function()
{
	if (!is_admin())
	{
		// do not proceed if we are visiting the theme from the front-end
		return;
	}

	// get current theme version stored in OPTIONS
	$version = get_option('adventures_theme_version', null);

	// check if we have no version or the current version is higher than
	// the one stored in the database
	if (!$version || version_compare(ADVENTURES_VERSION, $version, '>'))
	{
		// update version in database to avoid entering here again
		update_option('adventures_theme_version', ADVENTURES_VERSION);

		// complete overrides update
		adventures_install_vrc_overrides();
	}
});

/**
 * Handle VikUpdater notification on wp-admin/themes.php page.
 */
global $pagenow;
if (defined('VIKUPDATER_VERSION') && is_admin() && $pagenow == 'themes.php')
{
	add_action('admin_print_footer_scripts', function()
	{
		$version = ADVENTURES_VERSION;

		$script = 
<<<JS
jQuery(document).ready(function() {
	VikUpdater.hasNewerVersion('adventures', $version, function(data) {
		jQuery('.theme[data-slug="wp_adventures_theme"] .theme-screenshot').after(data.html);
	});
});
JS
		;

		echo '<script type="text/javascript">' . $script . '</script>';
	});
}
