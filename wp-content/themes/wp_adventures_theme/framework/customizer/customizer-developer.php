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

function adventures_customize_developer( $wp_customize ) {
	/*** || DEVELOPER SELECTION SECTION ||***/

	$wp_customize->add_section('adventures_developer_options', array(
        'title'     => __('Developer Options','vikwp_adventures'),
        'priority'  => 50
   	));

	$wp_customize->add_setting('adventures_classic_widgets', array(
		'default'	=> 'no',
		'transport'	=> 'refresh'
	));

	$wp_customize->add_control('adventures_classic_widgets_ctrl',array(
		'label'		=> __('Use the classic widgets page','vikwp_adventures'),
		'settings'	=> 'adventures_classic_widgets',
		'section'	=> 'adventures_developer_options',
		'type'		=> 'select',
		'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
	));

	$wp_customize->add_setting('adventures_show_page_name', array(
		'default'	=> 'no',
		'transport'	=> 'refresh'
	));
	
	$wp_customize->add_control('adventures_show_page_name_ctrl',array(
		'label'		=> __('Show the name of the page you are currently on','vikwp_adventures'),
		'settings'	=> 'adventures_show_page_name',
		'section'	=> 'adventures_developer_options',
		'type'		=> 'select',
		'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
	));
}
add_action( 'customize_register', 'adventures_customize_developer' );
