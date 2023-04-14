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
 * @version 1.0
 */

defined('ABSPATH') or die('No script kiddies please!');

if ( function_exists( 'register_sidebar' ) ) {

    function adventures_widgets_init() {

        global $wpdb;

        //wp_die("Here");

        $active_widgets = get_option( 'sidebars_widgets' );
        $canWrite = get_option('vikwp_adventures_write_widgets');
        $counter = 1;

        $sidebars = array(
            'Top Bar Right' => array(
                'name'          => __('Top Bar - Right', 'vikwp_adventures'),
                'id'            => 'topbar',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'Top Bar Left' => array(
                'name'          => __('Top Bar - Left', 'vikwp_adventures'),
                'id'            => 'topbar-left',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'sidebarleft' => array(
                'name'          => __('Sidebar Left', 'vikwp_adventures'),
                'id'            => 'sidebarleft',
                'before_widget' => '<div class="sidebar-widget"><aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'sidebar-right' => array(
                'name'          => __('Sidebar Right', 'vikwp_adventures'),
                'id'            => 'sidebar-right',
                'before_widget' => '<div class="sidebar-widget"><aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'header-inner' => array(
                'name'          => __('Car Rental Search Section', 'vikwp_adventures'),
                'id'            => 'header-inner',
                'description'   => 'Position here the VikRentCar Search widget.',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'module-box-01' => array(
                'name'          => __('Our Cars Section', 'vikwp_adventures'),
                'id'            => 'module-box-01',
                'description'   => 'Position here the VikRentCar Cars widget.',
                'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'module-box-02' => array(
                'name'          => __('Extra Services Section', 'vikwp_adventures'),
                'id'            => 'module-box-02',
                'description'   => 'Position here the VikWP Icons widget.',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'module-box-03' => array(
                'name'          => __('Testimonials Section', 'vikwp_adventures'),
                'id'            => 'module-box-03',
                'description'   => 'Position here the VikWP Text Slide widget.',
                'before_widget' => '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'module-box-04' => array(
                'name'          => __('Who we are Section', 'vikwp_adventures'),
                'id'            => 'module-box-04',
                'description'   => 'Position here the VikWP Grid Content widget.',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'module-box-05' => array(
                'name'          => __('Google Maps and Contacts Section', 'vikwp_adventures'),
                'id'            => 'module-box-05',
                'description'   => 'Position here the VikWP Google Maps widget.',
                'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'aboutus-bottom' => array(
                'name'          => __('About Us - Info Content', 'vikwp_adventures'),
                'id'            => 'aboutus-bottom',
                'description'   => 'This sidebar display the widgets just under the content page.',
                'before_widget' => '<div class="module grid-module"><div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'modulebox-contact' => array(
                'name'          => __('Contact Us - Under Content', 'vikwp_adventures'),
                'id'            => 'modulebox-contact',
                'description'   => 'This sidebar display your widget just below the main content',
                'before_widget' => '<div class="widget module grid-module %2$s"><div id="%1$s">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'upfooter' => array(
                'name'          => __('UpFooter', 'vikwp_adventures'),
                'id'            => 'upfooter',
                'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-inner">',
                'after_widget'  => '</div></div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            ),
            'footer' => array(
                'name'          => __('Footer', 'vikwp_adventures'),
                'id'            => 'sidebar-footer',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

       foreach ($sidebars as $id => $sidebar) {
            register_sidebar($sidebar);
        }
    }

    add_action('widgets_init', 'adventures_widgets_init');
}

/*if (isset($_GET['demo'])) {
    adventures_widgets_init();
}*/

