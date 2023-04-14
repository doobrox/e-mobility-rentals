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

function adventures_customize_fonts( $wp_customize ) {

	/*** || GOOGLE FONT SELECTION SECTION ||***/

	$wp_customize->add_panel('adventures_fonts_panel', array(
        'title'     => __('Fonts','vikwp_adventures'),
        'priority'  => 41
   	));

	   $wp_customize->add_section('adventures_fonts_options', array(
		'panel'		=> 'adventures_fonts_panel',
		'title'		=> __('Font Families','vikwp_adventures')
	));

	$font_array = array('PT Sans','Open Sans','Droid Sans','Century Gothic','Arial','Lora','Droid Serif','Playfair Display','PT Serif','Lato');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting('adventures_fonts_header', array(
		'default'			=> 'Lato',
		'transport'			=> 'postMessage',
		'sanitize_callback'	=> 'adventures_sanitize_gfont' 
	));
	
	function adventures_sanitize_gfont($input) {
		if (in_array($input, array('PT Sans','Open Sans','Droid Sans','Century Gothic','Arial','Lora','Droid Serif','Playfair Display','PT Serif','Lato')))
			return $input;
		else
			return 'vikwp_adventures';	
	}
	
	$wp_customize->add_control('adventures_fonts_ctrl',array(
		'label'		=> __('Title','vikwp_adventures'),
		'settings'	=> 'adventures_fonts_header',
		'section'	=> 'adventures_fonts_options',
		'type'		=> 'select',
		'choices'	=> $fonts
	));
	
	$wp_customize->add_setting('adventures_bodyfonts_header', array(
		'default'			=> 'Lato',
		'sanitize_callback' => 'adventures_sanitize_gfont',
		'transport'			=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_bodyfonts_ctrl',array(
		'label'		=> __('Body','vikwp_adventures'),
		'settings'	=> 'adventures_bodyfonts_header',
		'section'	=> 'adventures_fonts_options',
		'type'		=> 'select',
		'choices'	=> $fonts
	));

	$wp_customize->add_setting('adventures_fonts_family_head[custom_title]', array(
		'default' => '',
		'type' => 'custom_title_control',
		'capability' => 'edit_theme_options',
		'transport' => 'refresh',
		)
	);
	$wp_customize->add_control( new adventures_customizer_titles( $wp_customize, 'custom_fontfamily_control', array(
		'label' => 'Custom Google Font Family',
		'section' => 'adventures_fonts_options',
		'settings' => 'adventures_fonts_family_head[custom_title]',
		//'extra' => 'For more info check the Knowledge Base'
		) ) 
	);

	/* Custom Google Font Link */
	$wp_customize->add_setting('adventures_titlecustomfam_header', array(
		'default'			=> '',
		'transport'			=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_titlecustomfam_header_ctrl',array(
		'label'		=> __('Paste the font embed code'),
		'settings'	=> 'adventures_titlecustomfam_header',
		'section'	=> 'adventures_fonts_options',
		'type'		=> 'textarea'
	));

	/* Custom Google Font Name */
	$wp_customize->add_setting('adventures_titlecustom_namfam_header', array(
		'default'			=> '',
		'transport'			=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_titlecustom_namfam_header_ctrl',array(
		'label'		=> __('Font Name','vikwp_adventures'),
		'settings'	=> 'adventures_titlecustom_namfam_header',
		'section'	=> 'adventures_fonts_options',
		'type'		=> 'text'
	));

	/* Section Font Size */

	$wp_customize->add_section('adventures_fonts_sizes', array(
		'panel'		=> 'adventures_fonts_panel',
		'title'		=> __('Font Sizes','vikwp_adventures')
	));

	$wp_customize->add_setting('adventures_fontsize_body', array(
		'default'	=> '16',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_body_ctrl',array(
		'label'		=> __('Body Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_body',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_menu', array(
		'default'	=> '14',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_menu_ctrl',array(
		'label'		=> __('Menu Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_menu',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_h1', array(
		'default'	=> '52',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_h1_ctrl',array(
		'label'		=> __('H1 Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_h1',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_h2', array(
		'default'	=> '42',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_h2_ctrl',array(
		'label'		=> __('H2 Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_h2',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_h3', array(
		'default'	=> '32',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_h3_ctrl',array(
		'label'		=> __('H3 Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_h3',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_h4', array(
		'default'	=> '25',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_h4_ctrl',array(
		'label'		=> __('H4 Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_h4',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_h5', array(
		'default'	=> '20',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_h5_ctrl',array(
		'label'		=> __('H5 Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_h5',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('adventures_fontsize_h6', array(
		'default'	=> '18',
		'transport'	=> 'postMessage'
	));
	
	$wp_customize->add_control('adventures_fontsize_h6_ctrl',array(
		'label'		=> __('H6 Font Size','vikwp_adventures'),
		'settings'	=> 'adventures_fontsize_h6',
		'section'	=> 'adventures_fonts_sizes',
		'type'		=> 'text'
	));

}
add_action( 'customize_register', 'adventures_customize_fonts' );

