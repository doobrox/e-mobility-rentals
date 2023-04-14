<?php
/**
 * Adventures Theme Colors Definition
 *
 *
 * @package WordPress
 * @subpackage Adventures
 * @since 1.0
 */

/*
* MAIN COLOR / DEFAULT AND DARKER
* SECOND COLOR / DEFAULT AND DARKER
* TEXT COLOR
*/

defined('ABSPATH') or die('No script kiddies please!');

function adventures_customize_register_colors ($wp_customize) {

	/** Class Description Controls ***/
	class adventures_customizer_desc_colsec extends WP_Customize_Control {
        public $type = 'custom_desc';
        public $extra = ''; // we add this for the extra description
        public function render_content() {
        ?>
        <div style="padding: 10px; background: #fff; border: 1px solid #ddd;"><?php echo esc_html( $this->label ); ?></div>
        <?php
        }
    }

	/** Class Title Custom Section ***/
	class adventures_customizer_col_titles extends WP_Customize_Control {
        public $type = 'custom_title';
        public $extra = ''; // we add this for the extra description
        public function render_content() {
        ?>
        <h3 style="padding: 15px 10px; text-align: center; margin: 0; border-left: 2px solid #1388c0; background: #ddd;"><?php echo esc_html( $this->label ); ?></h3>
        <?php if(!empty($this->extra)) { ?>
        	<div style=""><?php echo esc_html( $this->extra ); ?></div>
     	<?php  } ?>
        <?php
        }
    }


    //DESCRIPTION - Area Customizer
    $wp_customize->add_setting('adventures_customizer_desc_colsec[custom_desc]', array(
            'default' => '',
            'type' => 'adventures_customizer_desc_colsec_control',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new adventures_customizer_desc_colsec( $wp_customize, 'adventures_customizer_desc_colsec_control', array(
        'label' => 'Please, select your main color and its darker variant, this last will be used for backgrounds or over link states.',
        'section' => 'colors',
        'settings' => 'adventures_customizer_desc_colsec[custom_desc]',
        'priority' => 1
    	) ) 
    );
    // 

	//TITLE - MAIN COLOR
	$wp_customize->add_setting('adventures_color_maincol[custom_title]', array(
            'default' => '',
            'type' => 'adventures_color_maincol_control',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new adventures_customizer_col_titles( $wp_customize, 'adventures_color_maincol_control', array(
        'label' => 'MAIN COLOR',
        'section' => 'colors',
        'settings' => 'adventures_color_maincol[custom_title]',
        'priority' => 2
        ) ) 
    );

	// MAIN COLOR
	$wp_customize->add_setting('adventures_main_color', array(
		'default'		=> '#3aa41c',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'adventures_main_color_ctr', array(
		    'label'		=> __('Main Color', 'vikwp_adventures'),
		    'section'	=> 'colors',
		    'settings'	=> 'adventures_main_color'
		)
	));

	// MAIN COLOR - DARKER VARIANT
	$wp_customize->add_setting('adventures_maindark_color', array(
		'default'		=> '#3a8026',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'adventures_maindark_color_ctr', array(
		    'label'		=> __('Main Darker Color', 'vikwp_adventures'),
		    'section'	=> 'colors',
		    'settings'	=> 'adventures_maindark_color'
		)
	));

    //TITLE - BODY COLOR
    $wp_customize->add_setting('adventures_color_bodycol[custom_title]', array(
            'default' => '',
            'type' => 'adventures_color_bodycol_control',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new adventures_customizer_col_titles( $wp_customize, 'adventures_color_bodycol_control', array(
        'label' => 'TEXT COLOR',
        'section' => 'colors',
        'settings' => 'adventures_color_bodycol[custom_title]'
      ) ) 
    );

    // BODY COLOR
    $wp_customize->add_setting('adventures_bodycol_color', array(
        'default'       => '#3c4059',
        'transport'     => 'refresh'
    ));

    $wp_customize->add_control(
        new WP_Customize_Color_Control($wp_customize, 'adventures_bodycol_ctrl', array(
            'label'     => __('Body Text Color', 'vikwp_adventures'),
            'section'   => 'colors',
            'settings'  => 'adventures_bodycol_color'
        )
    ));

	
	/* TITLE - SECOND COLOR
     ** ADVENTURES has just one color variation. 

    $wp_customize->add_setting('adventures_color_secondcol[custom_title]', array(
            'default' => '',
            'type' => 'adventures_color_secondcol_control',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );
    $wp_customize->add_control( new adventures_customizer_col_titles( $wp_customize, 'adventures_color_secondcol_control', array(
        'label' => 'SECOND COLOR',
        'section' => 'colors',
        'settings' => 'adventures_color_secondcol[custom_title]'
      ) ) 
    );

	// SECOND COLOR
	$wp_customize->add_setting('adventures_second_color', array(
		'default'		=> '#ff8432',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'adventures_second_color_ctrl', array(
		    'label'		=> __('Secondary Color', 'vikwp_adventures'),
		    'section'	=> 'colors',
		    'settings'	=> 'adventures_second_color'
		)
	));

	// SECOND COLOR - DARKER VARIANT
	$wp_customize->add_setting('adventures_seconddark_color', array(
		'default'		=> '#ffa366',
		'transport'		=> 'refresh'
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize, 'adventures_seconddark_color_ctrl', array(
		    'label'		=> __('Secondary Darker Color', 'vikwp_adventures'),
		    'section'	=> 'colors',
		    'settings'	=> 'adventures_seconddark_color'
		)
	)); */
}
add_action( 'customize_register', 'adventures_customize_register_colors' );

// Remove the default Header text color Setting
function adventures_theme_colors_section( $wp_customize ) {
	$wp_customize->remove_control('header_textcolor');
}
add_action( 'customize_register', 'adventures_theme_colors_section' );

