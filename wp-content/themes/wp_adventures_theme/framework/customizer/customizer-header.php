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

function adventures_customize_register_header( $wp_customize ) {

	/** Class Header Slider explaination ***/
	class adventures_customizer_header extends WP_Customize_Control {
        public $type = 'header_custom';
        public $extra = ''; // we add this for the extra description
        public function render_content() {
        	$query_static['autofocus[section]'] = 'adventures_header_img_style_section';
 			$section_link_static = add_query_arg( $query_static, admin_url( 'customize.php' ) );

 			$query_slider['autofocus[panel]'] = 'adventures_slider_panel';
 			$section_link_slider = add_query_arg( $query_slider, admin_url( 'customize.php' ) );
        ?>       
        	<div class="head_desc" style="background: #fff;padding: 10px;border-top: 1px solid #ccc;border-left: 2px solid #1388c0;">
        		<p><a class="btn" href="<?php echo esc_url( $section_link_static ); ?>">Click Here</a> to setup the <strong>Static Image</strong></p>
        		<p><a class="btn" href="<?php echo esc_url( $section_link_slider ); ?>">Click Here</a> to setup the <strong>Slider Images</strong></p>
        	</div>
     	
        <?php
        }
    }

	$wp_customize->add_panel('adventures_header_panel', array(
		'priority'		=> 1,
		'title'			=> __('Header Settings','vikwp_adventures'),
		'description'	=> __('The Header image and the Slider can\'t be both activated. ','vikwp_adventures')
	) );

	$wp_customize->get_section('header_image')->panel = 'adventures_header_panel';

	// Add Header Title	

	$wp_customize->add_setting('adventures_headertitle[custom_title]', array(
		'default'		=> '',
		'type' 			=> 'custom_title_header_control',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(new adventures_customizer_titles($wp_customize, 'custom_title_header_control', array(
	   'label'			=> __( 'Header', 'vikwp_adventures' ),
	   'section'		=> 'adventures_header_activate_section',
	   'settings'		=> 'adventures_headertitle[custom_title]' 
	)));

	/*** Header Activate  ***/
	$wp_customize->add_section('adventures_header_activate_section', array(
		'title'			=> __('Header Options', 'vikwp_adventures'),
		'priority'		=> 10
	) );

	$wp_customize->get_section('adventures_header_activate_section')->panel = 'adventures_header_panel';

	$wp_customize->add_setting( 'adventures_header_activate_settings' , array(
	    'default'		=> 'slider',
	    'type'			=> 'theme_mod',
	    'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'adventures_header_activate_ctrl' , array(
		'label'			=> __('Header Type','vikwp_adventures'),
		'settings'		=> 'adventures_header_activate_settings',
		'section'		=> 'adventures_header_activate_section',
		'type'			=> 'select',
		'choices'		=> array(
			'slider'		=> 'Slider',
			'static'		=> 'Static Image',
			'disabled'		=> 'Disabled'
		)
	) );

	// Slider enabled all pages 
	$wp_customize->add_setting( 'adventures_header_allpages_settings' , array(
	    'default'		=> 'no',
	    'type'			=> 'theme_mod',
	    'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'adventures_header_allpages_ctrl' , array(
		'label'			=> __('Enable Slider in all the pages','vikwp_adventures'),
		'settings'		=> 'adventures_header_allpages_settings',
		'section'		=> 'adventures_header_activate_section',
		'type'			=> 'select',
		'choices'		=> array(
			'yes'		=> 'Yes',
			'no'		=> 'No'
		)
	) );

	// Header Custom Title
	$wp_customize->add_setting('adventures_headertype[header_custom]', array(
		'default'		=> '',
		'type' 			=> 'adventures_headertype_ctrl',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(new adventures_customizer_header($wp_customize, 'adventures_headertype_ctrl', array(
	   'label'			=> __( 'Header', 'vikwp_adventures' ),
	   'section'		=> 'adventures_header_activate_section',
	   'settings'		=> 'adventures_headertype[header_custom]',
	   'extra'			=> '' 
	)));

	// Scroll Wheel Custom Title
	$wp_customize->add_setting('adventures_wheel[custom_title]', array(
		'default'		=> '',
		'type' 			=> 'adventures_wheel_ctrl',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(new adventures_customizer_titles($wp_customize, 'adventures_wheel_ctrl', array(
	   'label'			=> __( 'Scroll Wheel', 'vikwp_adventures' ),
	   'section'		=> 'adventures_header_activate_section',
	   'settings'		=> 'adventures_wheel[custom_title]' 
	)));

	/*** Header mouse scroll symbol ***/
	$wp_customize->add_setting( 'adventures_header_scrol_sett' , array(
	    'default'		=> 'no',
	    'type'			=> 'theme_mod',
	    'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'adventures_header_scroll_ctrl' , array(
		'label'			=> __('Mouse Scroll symbol','vikwp_adventures'),
		'settings'		=> 'adventures_header_scrol_sett',
		'section'		=> 'adventures_header_activate_section',
		'type'			=> 'select',
		'choices'		=> array(
			'yes'		=> 'Yes',
			'no'		=> 'No'		
		)
	) );

	/*** Header mouse scroll Type ***/

	$wp_customize->add_setting( 'adventures_header_scrol_type_sett' , array(
	    'default'		=> 'arrow',
	    'type'			=> 'theme_mod',
	    'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'adventures_header_scroll_type_ctrl' , array(
		'label'			=> __('Scroll Type symbol','vikwp_adventures'),
		'settings'		=> 'adventures_header_scrol_type_sett',
		'section'		=> 'adventures_header_activate_section',
		'type'			=> 'select',
		'choices'		=> array(
			'arrow'		=> 'Arrow',
			'mouse'		=> 'Mouse'		
		)
	) );

	/*** Header Image Options ***/
	$wp_customize->add_section('adventures_header_img_style_section', array(
		'title'			=> __('Static Image Options', 'vikwp_adventures'),
		'description'	=> __('On this section you can manage the static image option, that you can setup in the "Header Options" panel.')
	) );

	$wp_customize->get_section('adventures_header_img_style_section')->panel = 'adventures_header_panel';

	$wp_customize->add_setting( 'adventures_header_img_settings' , array(
	    'default'    		=> 'cover',
	    'sanitize_callback' => 'adventures_header_img_sanitize_settings'
	) );

	// Title Static Image
	$wp_customize->add_setting( 'adventures_static_image_title' , array(
	    'default'		=> __('Static Image Title', 'vikwp_adventures'),
	    'type'			=> 'theme_mod',
	    'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'adventures_static_image_title_ctrl' , array(
		'label'			=> __('Title','vikwp_adventures'),
		'settings'		=> 'adventures_static_image_title',
		'section'		=> 'adventures_header_img_style_section',
		'type'			=> 'text'
	) );

	// Description Static Image
	$wp_customize->add_setting( 'adventures_static_image_desc' , array(
	    'default'		=> __('Static Image Caption', 'vikwp_adventures'),
	    'type'			=> 'theme_mod',
	    'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'adventures_static_image_desc_ctrl' , array(
		'label'			=> __('Image caption','vikwp_adventures'),
		'settings'		=> 'adventures_static_image_desc',
		'section'		=> 'adventures_header_img_style_section',
		'type'			=> 'text'
	) );

	function adventures_header_img_sanitize_settings( $input ) {
		if ( in_array($input, array('contain','cover') ) )
			return $input;
		else
			return 'vikwp_adventures';	
	}

	$wp_customize->add_control('adventures_header_img_ctrl', array(
		'label'		=> __('Header Image Arrangment','vikwp_adventures'),
		'settings'	=> 'adventures_header_img_settings',
		'section'	=> 'adventures_header_img_style_section',
		'type'		=> 'select',
		'choices'	=> array(			
			'cover'		=> 'Cover',
			'fixed' 	=> 'Fixed'
		)
	) );

}
add_action( 'customize_register', 'adventures_customize_register_header' );

function adventures_add_support( $wp_customize ) {
	add_theme_support( 'custom-header', array(
		'default-image'		=> get_template_directory_uri()."/assets/images/header.jpg",
		'width'				=> 1920,
		'height'			=> 500,	
		'flex-width'		=> true,
		'flex-height'		=> true,
	) );
}
add_action( 'after_setup_theme', 'adventures_add_support' );
