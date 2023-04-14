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

function adventures_customize_register_cookies ($wp_customize) {

	// Adding and assigning sections
	$wp_customize->add_section('adventures_cookies_section', array(
		'panel'			=> 'adventures_settings_panel',
		'title'			=> __('Cookies Policy', 'vikwp_adventures'),
		'description'	=> __('Insert your cookies Policy information', 'vikwp_adventures')
	));

	// Message
	$wp_customize->add_setting('adventures_cookies_sett_textarea' , array(
	    'default'		=> 'This site uses cookies. By continuing to browse you accept their use.',
	    'transport'		=> 'postMessage'
	));

	$wp_customize->add_control('adventures_cookies__ctrl_textarea' , array(
		'label'			=> __('Cookies Description','vikwp_adventures'),
		'settings'		=> 'adventures_cookies_sett_textarea',
		'section'		=> 'adventures_cookies_section',
		'type'			=> 'textarea'
	));

	// Further Information
	$wp_customize->add_setting('adventures_cookies_sett_info' , array(
	    'default'		=> 'Further Information',
	    'transport'		=> 'postMessage'
	));

	$wp_customize->add_control('adventures_cookies_ctrl_info' , array(		
		'label'			=> __('Further Information Button'),
		'settings'		=> 'adventures_cookies_sett_info',
		'section'		=> 'adventures_cookies_section',
		'type'			=> 'text'
	));

	// Button
	$wp_customize->add_setting('adventures_cookies_sett_agree' , array(
	    'default'		=> 'Ok',
	    'transport'		=> 'postMessage'
	));

	$wp_customize->add_control('adventures_cookies_ctrl_agree' , array(
		'label'			=> __('Agree Button','vikwp_adventures'),
		'settings'		=> 'adventures_cookies_sett_agree',
		'section'		=> 'adventures_cookies_section',
		'type'			=> 'text'
	));

	// Select Page
	$wp_customize->add_setting('adventures_cookies_sett_post' , array(
	    'capability'		=> 'edit_theme_options',
  		'sanitize_callback'	=> 'adventures_sanitize_dropdown_pages',
	));

	$wp_customize->add_control( 'adventures_cookies_ctrl_post' , array(
		'type'			=> 'dropdown-pages',
		'settings'		=> 'adventures_cookies_sett_post',
		'section' 		=> 'adventures_cookies_section', // Add a default or your own section
		'label' 		=> __( 'Page Linked' , 'vikwp_adventures'),
		'description' 	=> __( 'Select the article the visitor will be redirected to when requesting further information:' , 'vikwp_adventures'),
	) );

	//Sanitize functions

	function adventures_sanitize_dropdown_pages( $page_id, $setting ) {
		// Ensure $input is an absolute integer.
		$page_id = absint( $page_id );

		// If $page_id is an ID of a published page, return it; otherwise, return the default.
		return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}
}
add_action('customize_register', 'adventures_customize_register_cookies');
