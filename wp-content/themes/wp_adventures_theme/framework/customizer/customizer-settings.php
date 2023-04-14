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

function adventures_customize_register_settings ($wp_customize) {

	/*** || DISPLAY SETTINGS SECTION ||***/

	$wp_customize->add_panel('adventures_settings_panel', array(
		'priority'	=> 20,
		'title'		=> __('Settings','vikwp_adventures')
	));
	$wp_customize->add_section('adventures_settings_section', array(
		'panel'		=> 'adventures_settings_panel',
		'title'		=> __('Layout Settings','vikwp_adventures')
	));

	/*** || DISPLAY HEADER ||***/

    // Show Frontpage - Title page
    $wp_customize->add_setting('adventures_settings_header', array(
        'default'    => 'yes',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_settings_header', array(
        'section'   => 'adventures_settings_section',
        'setting'   => 'adventures_settings_header',
        'label'     => 'Display Homepage title',
        'type'      => 'select',
        'choices'   => array(
            'yes'   => __('Yes'),
            'no'    => __('No')
        )
    ));

    // Display Cookies Policy
    $wp_customize->add_setting('adventures_sett_showcookies', array(
        'default'    => 'no',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_sett_showcookies', array(
        'section'   => 'adventures_settings_section',
        'setting'   => 'adventures_sett_showcookies',
        'label'     => 'Display Cookies Policy',
        'type'      => 'select',
        'choices'   => array(
            'yes'   => __('Yes'),
            'no'    => __('No')
        )
    ));

    /* Font Awesome */

    $wp_customize->add_setting('adventures_fontawes_setting', array(
        'default'   => 'yes',
        'transport' => 'postMessage'
    )); 
    $wp_customize->add_control('adventures_fontawes_ctrl',array(
        'label'     => __('Font Awesome Library','vikwp_adventures'),
        'settings'  => 'adventures_fontawes_setting',
        'section'   => 'adventures_settings_section',
        'type'      => 'select',
        'choices'   => array(
            'yes'   => __('Enabled'),
            'no'    => __('Disabled')
        )
    ));

	// Menu fixed
	$wp_customize->add_setting('adventures_settings_menusticky', array(
		'default'    => 'yes',
		'transport'  => 'refresh'
	));
	$wp_customize->add_control('adventures_settings_menusticky', array(
        'section'   => 'adventures_settings_section',
        'setting'	=> 'adventures_settings_menusticky',
        'label'     => 'Menu Sticky',
        'type'      => 'select',
        'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
	));

	//custom_title - Meta Information
	$wp_customize->add_setting('adventures_meta_headinfo[custom_title]', array(
            'default' => '',
            'type' => 'custom_title_meta_control',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new adventures_customizer_titles( $wp_customize, 'custom_title_meta_control', array(
        'label' => 'Meta',
        'section' => 'adventures_settings_section',
        'settings' => 'adventures_meta_headinfo[custom_title]',
        //'extra' => 'Here is my extra description text ...'
        ) ) 
    );

	// Meta info All the pages
	$wp_customize->add_setting('adventures_settings_postmeta_general', array(
		'default'    => 'yes',
		'transport'  => 'refresh'
	));
	$wp_customize->add_control('adventures_settings_postmeta_general_ctrl', array(
		'label'     => __('Meta information in all the pages', 'vikwp_adventures'),
        'settings'	=> 'adventures_settings_postmeta_general',
        'section'   => 'adventures_settings_section',
        'type'      => 'select',
        'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
    ));

    // Meta info Blog Posts
    $wp_customize->add_setting('adventures_settings_meta_posts', array(
        'default'    => 'no',
        'transport'  => 'refresh'
    ));
    
    $wp_customize->add_control('adventures_settings_meta_posts_ctrl', array(
        'label'     => __('Meta information in Blog Posts', 'vikwp_adventures'),
        'settings'  => 'adventures_settings_meta_posts',
        'section'   => 'adventures_settings_section',
        'type'      => 'select',
        'choices'   => array(
            'yes'   => __('Yes'),
            'no'    => __('No')
        )
    ));

    // Meta info HP
    $wp_customize->add_setting('adventures_settings_meta_hp', array(
		'default'    => 'no',
		'transport'  => 'refresh'
	));
	
	$wp_customize->add_control('adventures_settings_meta_hp_ctrl', array(
		'label'     => __('Homepage Meta information', 'vikwp_adventures'),
        'settings'	=> 'adventures_settings_meta_hp',
        'section'   => 'adventures_settings_section',
        'type'      => 'select',
        'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
   	));

    /*** || LOGO SETTING - SECTION ||***/

    $wp_customize->add_section('adventures_setlogo_section', array(
        'panel'     => 'adventures_settings_panel',
        'title'     => __('Logo Settings','vikwp_adventures')
    ));

    /** Homepage Logo */
    $wp_customize->add_setting('adventures_infohplogo_setting[custom_title]', array(
        'default'       => '',
        'type'          => 'custom_title_hplogo_control',
        'capability'    => 'edit_theme_options',
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new adventures_customizer_titles($wp_customize, 'custom_title_hplogo_control', array(
       'label'          => __( 'Homepage Logo', 'vikwp_adventures' ),
       'description'    => __( 'Insert a logo that will show up just in the Homepage of your website.', 'vikwp_adventures' ),
       'section'        => 'adventures_setlogo_section',
       'settings'       => 'adventures_infohplogo_setting[custom_title]' 
    )));

    /** Add Homepage Logo */
    $wp_customize->add_setting('adventures_hplogo_setting', array(
        'default'    => 'https://vikwp.com/demo/themes/sample-data/vrc/adventures/logo.png',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hplogo', array(
       'description'    => __( 'Insert a logo that will show up just in the Homepage of your website.', 'vikwp_adventures' ),
       'section'        => 'adventures_setlogo_section',
       'settings'       => 'adventures_hplogo_setting' 
    )));

    /** Internal Logo - title */
    $wp_customize->add_setting('adventures_infoseclogo_setting[custom_title]', array(
        'default'       => '',
        'type'          => 'custom_title_logo_control',
        'capability'    => 'edit_theme_options',
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new adventures_customizer_titles($wp_customize, 'custom_title_logo_control', array(
       'label'          => __( 'Internal logo', 'vikwp_adventures' ),
       'description'    => __( 'Insert a logo that will show up just in the internal pages of your website', 'vikwp_adventures' ),
       'section'        => 'adventures_setlogo_section',
       'settings'       => 'adventures_infoseclogo_setting[custom_title]' 
    )));

    /** Add Internal Logo */
    $wp_customize->add_setting('adventures_seclogo_setting', array(
        'default'    => 'https://vikwp.com/demo/themes/sample-data/vrc/adventures/logo.png',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
       'description'    => __( 'Insert a logo that will show up just in the internal pages of your website', 'vikwp_adventures' ),
       'section'        => 'adventures_setlogo_section',
       'settings'       => 'adventures_seclogo_setting' 
    )));

    /** Homepage Logo - alt text */
    $wp_customize->add_setting('adventures_logoalt_setting', array(
        'default'    => 'adventures Hotel Logo Title',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_logoalt_setting', array(
       'description'    => __( '', 'vikwp_adventures' ),
       'section'        => 'adventures_setlogo_section',
       'settings'       => 'adventures_logoalt_setting',
       'label'          => __( 'Alt Text Logo', 'vikwp_adventures' ),
       'type'           => 'text' 
    ));


    /*** || MENU SETTING - SECTION ||***/

    $wp_customize->add_section('adventures_setmenu_section', array(
        'panel'     => 'adventures_settings_panel',
        'title'     => __('Menu Settings','vikwp_adventures')
    ));

    /** Menu fixed */
    $wp_customize->add_setting('adventures_settings_menusticky', array(
        'default'    => 'yes',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_settings_menusticky', array(
        'section'   => 'adventures_setmenu_section',
        'setting'   => 'adventures_settings_menusticky',
        'label'     => 'Menu Sticky',
        'type'      => 'select',
        'choices'   => array(
            'yes'   => __('Yes'),
            'no'    => __('No')
        )
    ));

    /** Header Position - Homepage */
    $wp_customize->add_setting('adventures_headset_hp', array(
        'default'    => 'top',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_headset_hp', array(
        'section'   => 'adventures_setmenu_section',
        'setting'   => 'adventures_headset_hp',
        'label'     => 'Homepage - Header Position',
        //'description' => 'If you select the option Over Slider, the header will appear in the slider with a black background with transparency. If you select the Top option, you\'ll have the header above the slider and will be applied the parameter Header Background color.',
        'type'      => 'select',
        'choices'   => array(
            'over-slider'   => __('Over Slider'),
            'top'   => __('Top')
        )
    ));

    /** Header Position - Internal pages */
    $wp_customize->add_setting('adventures_headset_ip', array(
        'default'    => 'top',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_headset_ip', array(
        'section'   => 'adventures_setmenu_section',
        'setting'   => 'adventures_headset_hp',
        'label'     => 'Internal Pages - Header Position',
        'type'      => 'select',
        'choices'   => array(
            'over-slider'   => __('Over Slider'),
            'top'   => __('Top')
        )
    ));

    /** Header Background */
    $wp_customize->add_setting('adventures_header_bg', array(
        'default'       => '#fff',
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize, 'adventures_header_bg_ctrl', array(
            'label'     => __('Header Background', 'vikwp_adventures'),
            'description' => 'Here you can select the background color of your header.',
            'section'   => 'adventures_setmenu_section',
            'settings'  => 'adventures_header_bg'
        )
    ));

    /** Menu Text Color */
    $wp_customize->add_setting('adventures_menu_color', array(
        'default'       => '#fff',
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize, 'adventures_menu_color_ctrl', array(
            'label'     => __('Menu Text Color', 'vikwp_adventures'),
            'section'   => 'adventures_setmenu_section',
            'settings'  => 'adventures_menu_color'
        )
    ));

    /*** || RESPONSIVE - SECTION ||***/

    $wp_customize->add_section('adventures_responsive_section', array(
        'panel'     => 'adventures_settings_panel',
        'title'     => __('Responsive Settings','vikwp_adventures')
    ));

    /** Title - Responsive Layout */
    $wp_customize->add_setting('adventures_resp_layout[custom_title]', array(
        'default'       => '',
        'type'          => 'custom_resp_layout_ctrl',
        'capability'    => 'edit_theme_options',
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(new adventures_customizer_titles($wp_customize, 'custom_resp_layout_ctrl', array(
       'label'          => __( 'Responsive Menu', 'vikwp_adventures' ),
       'description'    => __( '', 'vikwp_adventures' ),
       'section'        => 'adventures_responsive_section',
       'settings'       => 'adventures_resp_layout[custom_title]' 
    )));

    /** Responsive Icon color */
    $wp_customize->add_setting('adventures_resp_ico_color', array(
        'default'       => '#222',
        'transport'     => 'refresh'
    ));
    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize, 'adventures_resp_ico_color_ctrl', array(
            'label'     => __('Color Menu Icon', 'vikwp_adventures'),
            'description' => 'Select the color of the responsive Sandwitch Menu.',
            'section'   => 'adventures_responsive_section',
            'settings'  => 'adventures_resp_ico_color'
        )
    ));

    /** Menu Text Responsive */
    $wp_customize->add_setting('adventures_resp_ico_text', array(
        'default'    => 'MENU',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_resp_ico_text', array(
        'section'   => 'adventures_responsive_section',
        'setting'   => 'adventures_resp_ico_text',
        'label'     => 'Menu Text',
        'description' => 'This text will be displayed next to the menu icon.',
        'type'      => 'text'
    ));

    /** Size Container */
    $wp_customize->add_setting('adventures_resp_size', array(
        'default'    => '1280',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_resp_size', array(
        'section'   => 'adventures_responsive_section',
        'setting'   => 'adventures_resp_size',
        'label'     => 'Responsive Width (in px)',
        'description' => '',
        'type'      => 'number'
    ));

    /** Copyright Section **/
    $wp_customize->add_section('adventures_copyright_section', array(
        'panel'     => 'adventures_settings_panel',
        'title'     => __('Copyright Settings','vikwp_adventures')
    ));

    /** Copyright message */
    $wp_customize->add_setting('adventures_settings_copyright', array(
        'default'    => __('© Adventures Theme | Sed nulla metus, varius ac aliquet vitae','vikwp_adventures'),
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_settings_copyright', array(
        'section'   => 'adventures_copyright_section',
        'setting'   => 'adventures_settings_copyright',
        'label'     => 'Copyright Message',
        'description' => 'This text will be displayed under the Footer area.',
        'type'      => 'textarea'
    ));

    /** Copyright message alignment */
    $wp_customize->add_setting('adventures_settings_copyright_algn', array(
        'default'    => 'right',
        'transport'  => 'refresh'
    ));
    $wp_customize->add_control('adventures_settings_copyright_algn', array(
        'section'   => 'adventures_copyright_section',
        'setting'   => 'adventures_settings_copyright_algn',
        'label'     => 'Text Alignment',
        'type'      => 'select',
        'choices'   => array(
            'right'   => __('Right'),
            'center'   => __('Center'),
            'left'   => __('Left')
        )
    ));

}
add_action('customize_register', 'adventures_customize_register_settings');
