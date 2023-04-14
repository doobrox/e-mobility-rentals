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

/**
 * Customizer additions.
 */


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

function adventures_customize_register($wp_customize) {

	/** Class Description Controls ***/
	class adventures_customizer_titles extends WP_Customize_Control {
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

	/*** || SLIDER PANEL || ***/
	
	$wp_customize->add_panel('adventures_slider_panel', array(
		'priority'	=> 2,
		'title'		=> __('Header Slider Settings','vikwp_adventures')
	));

	$wp_customize->add_section('adventures_slider_section', array(
		'panel'		=> 'adventures_slider_panel',
		'title'		=> __('Slider Settings','vikwp_adventures')
	));

	$wp_customize->add_setting('adventures_slider_settings' , array(
	    'default'	=> 'true',
	    'transport'	=> 'refresh'
	));

	/* @since v1.1.19 
	 * We disabled this parameter. Now it is automatically disabled or not if you fill up the height parameter. 
	$wp_customize->add_setting('adventures_slider_fullscreen' , array(
		'default'    => 'no',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_fullscreen_control', array(
        'settings'	=> 'adventures_slider_fullscreen',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Enable Fullscreen','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
	));
	 */

	//Image Height
	$wp_customize->add_setting('adventures_slider_image_height' , array(
	    'default'   => '',
	    'transport' => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_image_height_control', array(
        'settings'	=> 'adventures_slider_image_height',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Image Height in px. By default the slider takes the full size.','vikwp_adventures'),
        'type'      => 'text'
	));

	//Backgroun Image type
	$wp_customize->add_setting('adventures_image_bg_type' , array(
		'default'    => 'no',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_image_bg_type_control', array(
        'settings'	=> 'adventures_image_bg_type',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Image Background Type','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'cover'	=> __('Cover'),
        	'contain'	=> __('Fit Height')
        )
	));

	/* Slider Images Start */
	for($i = 1; $i <= 5; $i++) { 
		$wp_customize->add_section('adventures_slider_'.$i.'_section', array(
			'panel'		=> 'adventures_slider_panel',
			'title'		=> sprintf(__('Slider Image %s','vikwp_adventures'), $i)
		));

		//Image
		$wp_customize->add_setting('adventures_slider_'.$i.'_image' , array(
		    'default'   => 'https://vikwp.com/demo/themes/sample-data/vrc/adventures/adventures_slider_01.jpg',
		    'transport'	=> 'postMessage'
		));

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'adventures_slider_'.$i.'_image_control',
				array (
					'label'      => __('Slider Image', 'vikwp_adventures'),
					'section'    => 'adventures_slider_'.$i.'_section',
					'settings'   => 'adventures_slider_'.$i.'_image'
				)
			)
		);

		//Title
		$wp_customize->add_setting('adventures_slider_'.$i.'_title' , array(
		    'default'   => '',
		    'transport'	=> 'refresh'
		));

		$wp_customize->add_control('adventures_slider_'.$i.'_title_control', array(
			'label'		=> __('Title','vikwp_adventures'),
			'settings'	=> 'adventures_slider_'.$i.'_title',
			'section'	=> 'adventures_slider_'.$i.'_section',
			'type'		=> 'text'
		));

		//Description
		$wp_customize->add_setting('adventures_slider_'.$i.'_description' , array(
		    'default'   => '',
		    'transport'	=> 'refresh'
		));

		$wp_customize->add_control('adventures_slider_'.$i.'_description_control', array(
			'label'		=> __('Description','vikwp_adventures'),
			'settings'	=> 'adventures_slider_'.$i.'_description',
			'section'	=> 'adventures_slider_'.$i.'_section',
			'type'		=> 'textarea'
		));

		//Read More Text
		$wp_customize->add_setting('adventures_slider_'.$i.'_readmore' , array(
		    'default'   => '',
		    'transport'	=> 'refresh'
		));

		$wp_customize->add_control('adventures_slider_'.$i.'_readmore_control', array(
			'label'		=> __('Read More Text','vikwp_adventures'),
			'settings'	=> 'adventures_slider_'.$i.'_readmore',
			'section'	=> 'adventures_slider_'.$i.'_section',
			'type'		=> 'text'
		));

		//Read More Link
		$wp_customize->add_setting('adventures_slider_'.$i.'_readmorelink' , array(
		    'default'   => '',
		    'transport' => 'refresh'
		));

		$wp_customize->add_control('adventures_slider_'.$i.'_readmorelink_control', array(
			'label'		=> __('Read More Link','vikwp_adventures'),
			'settings'	=> 'adventures_slider_'.$i.'_readmorelink',
			'section'	=> 'adventures_slider_'.$i.'_section',
			'type'		=> 'text'
		));

		//Title Tag
		$wp_customize->add_setting('adventures_slider_'.$i.'_title_tag' , array(
		    'default'   => '2',
		    'transport'	=> 'refresh'
		));

		$wp_customize->add_control('adventures_slider_'.$i.'_title_tag_control', array(
			'label'		=> __('Title Tag','vikwp_adventures'),
			'settings'	=> 'adventures_slider_'.$i.'_title_tag',
			'section'	=> 'adventures_slider_'.$i.'_section',
			'type'      => 'select',
			'choices'		=> array(
				1	=> 'H1 Title',
				2	=> 'H2 Title',
				3	=> 'H3 Title',
				4	=> 'H4 Title',
				5	=> 'H5 Title',
				6	=> 'H6 Title'
			)
		));
	}

	//Font
	$wp_customize->add_setting('adventures_slider_font' , array(
		'default'    => 0,
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_font_control', array(
        'settings'	=> 'adventures_slider_font',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Choose Text Font','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	0	=> 'Theme Default',
        	1	=> 'Lato',
        	2	=> 'Roboto',
        	3	=> 'Oswald',
        	4	=> 'Convergence'
        )
	));

	//Title Effect
	$wp_customize->add_setting('adventures_slider_teffect' , array(
		'default'    => 'fadeInLeft',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_teffect_control', array(
        'settings'	=> 'adventures_slider_teffect',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Title Effect','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'bounceIn'		=> __('bounceIn', 'vikwp_adventures'),
        	'bounceInDown'	=> __('bounceInDown', 'vikwp_adventures'),
        	'bounceInLeft'	=> __('bounceInLeft', 'vikwp_adventures'),
        	'bounceInRight'	=> __('bounceInRight', 'vikwp_adventures'),
        	'bounceInUp'	=> __('bounceInUp', 'vikwp_adventures'),
        	'bounceOut'		=> __('bounceOut', 'vikwp_adventures'),
        	'bounceOutDown'	=> __('bounceOutDown', 'vikwp_adventures'),
        	'bounceOutLeft'	=> __('bounceOutLeft', 'vikwp_adventures'),
        	'bounceOutRight'=> __('bounceOutRight', 'vikwp_adventures'),
        	'bounceOutUp'	=> __('bounceOutUp', 'vikwp_adventures'),
        	'fadeIn'		=> __('fadeIn', 'vikwp_adventures'),
        	'fadeInDown'	=> __('fadeInDown', 'vikwp_adventures'),
        	'fadeInDownBig'	=> __('fadeInDownBig', 'vikwp_adventures'),
        	'fadeInLeft'	=> __('fadeInLeft', 'vikwp_adventures'),
        	'fadeInLeftBig'	=> __('fadeInLeftBig', 'vikwp_adventures'),
        	'fadeInRight'	=> __('fadeInRight', 'vikwp_adventures'),
        	'fadeInRightBig'=> __('fadeInRightBig', 'vikwp_adventures'),
        	'fadeInUp'		=> __('fadeInUp', 'vikwp_adventures'),
        	'fadeInUpBig'	=> __('fadeInUpBig', 'vikwp_adventures'),
        	'fadeOut'		=> __('fadeOut', 'vikwp_adventures'),
        	'fadeOutDown'	=> __('fadeOutDown', 'vikwp_adventures'),
        	'fadeOutDownBig'=> __('fadeOutDownBig', 'vikwp_adventures'),
        	'fadeOutLeft'	=> __('fadeOutLeft', 'vikwp_adventures'),
        	'fadeOutLeftBig'=> __('fadeOutLeftBig', 'vikwp_adventures'),
        	'fadeOutRight'	=> __('fadeOutRight', 'vikwp_adventures'),
        	'fadeOutRightBig'=> __('fadeOutRightBig', 'vikwp_adventures'),
        	'fadeOutUp'		=> __('fadeOutUp', 'vikwp_adventures'),
        	'fadeOutUpBig'	=> __('fadeOutUpBig', 'vikwp_adventures'),
        	'slideInUp'		=> __('slideInUp', 'vikwp_adventures'),
        	'slideInDown'	=> __('slideInDown', 'vikwp_adventures'),
        	'slideOutUp'	=> __('slideOutUp', 'vikwp_adventures'),
        	'slideOutDown'	=> __('slideOutDown', 'vikwp_adventures'),
        	'slideOutLeft'	=> __('slideOutLeft', 'vikwp_adventures'),
        	'slideOutRight'	=> __('slideOutRight', 'vikwp_adventures')
        )
	));

	//Caption Effect
	$wp_customize->add_setting('adventures_slider_ceffect' , array(
		'default'    => 'fadeInRight',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_ceffect_control', array(
        'settings'	=> 'adventures_slider_ceffect',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Caption Effect','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'bounceIn'		=> __('bounceIn', 'vikwp_adventures'),
        	'bounceInDown'	=> __('bounceInDown', 'vikwp_adventures'),
        	'bounceInLeft'	=> __('bounceInLeft', 'vikwp_adventures'),
        	'bounceInRight'	=> __('bounceInRight', 'vikwp_adventures'),
        	'bounceInUp'	=> __('bounceInUp', 'vikwp_adventures'),
        	'bounceOut'		=> __('bounceOut', 'vikwp_adventures'),
        	'bounceOutDown'	=> __('bounceOutDown', 'vikwp_adventures'),
        	'bounceOutLeft'	=> __('bounceOutLeft', 'vikwp_adventures'),
        	'bounceOutRight'=> __('bounceOutRight', 'vikwp_adventures'),
        	'bounceOutUp'	=> __('bounceOutUp', 'vikwp_adventures'),
        	'fadeIn'		=> __('fadeIn', 'vikwp_adventures'),
        	'fadeInDown'	=> __('fadeInDown', 'vikwp_adventures'),
        	'fadeInDownBig'	=> __('fadeInDownBig', 'vikwp_adventures'),
        	'fadeInLeft'	=> __('fadeInLeft', 'vikwp_adventures'),
        	'fadeInLeftBig'	=> __('fadeInLeftBig', 'vikwp_adventures'),
        	'fadeInRight'	=> __('fadeInRight', 'vikwp_adventures'),
        	'fadeInRightBig'=> __('fadeInRightBig', 'vikwp_adventures'),
        	'fadeInUp'		=> __('fadeInUp', 'vikwp_adventures'),
        	'fadeInUpBig'	=> __('fadeInUpBig', 'vikwp_adventures'),
        	'fadeOut'		=> __('fadeOut', 'vikwp_adventures'),
        	'fadeOutDown'	=> __('fadeOutDown', 'vikwp_adventures'),
        	'fadeOutDownBig'=> __('fadeOutDownBig', 'vikwp_adventures'),
        	'fadeOutLeft'	=> __('fadeOutLeft', 'vikwp_adventures'),
        	'fadeOutLeftBig'=> __('fadeOutLeftBig', 'vikwp_adventures'),
        	'fadeOutRight'	=> __('fadeOutRight', 'vikwp_adventures'),
        	'fadeOutRightBig'=> __('fadeOutRightBig', 'vikwp_adventures'),
        	'fadeOutUp'		=> __('fadeOutUp', 'vikwp_adventures'),
        	'fadeOutUpBig'	=> __('fadeOutUpBig', 'vikwp_adventures'),
        	'slideInUp'		=> __('slideInUp', 'vikwp_adventures'),
        	'slideInDown'	=> __('slideInDown', 'vikwp_adventures'),
        	'slideOutUp'	=> __('slideOutUp', 'vikwp_adventures'),
        	'slideOutDown'	=> __('slideOutDown', 'vikwp_adventures'),
        	'slideOutLeft'	=> __('slideOutLeft', 'vikwp_adventures'),
        	'slideOutRight'	=> __('slideOutRight', 'vikwp_adventures')
        )
	));

	//Read More Effect
	$wp_customize->add_setting('adventures_slider_reffect' , array(
		'default'    => 'fadeInUpBig',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_reffect_control', array(
        'settings'	=> 'adventures_slider_reffect',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Read More Effect','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'bounceIn'		=> __('bounceIn', 'vikwp_adventures'),
        	'bounceInDown'	=> __('bounceInDown', 'vikwp_adventures'),
        	'bounceInLeft'	=> __('bounceInLeft', 'vikwp_adventures'),
        	'bounceInRight'	=> __('bounceInRight', 'vikwp_adventures'),
        	'bounceInUp'	=> __('bounceInUp', 'vikwp_adventures'),
        	'bounceOut'		=> __('bounceOut', 'vikwp_adventures'),
        	'bounceOutDown'	=> __('bounceOutDown', 'vikwp_adventures'),
        	'bounceOutLeft'	=> __('bounceOutLeft', 'vikwp_adventures'),
        	'bounceOutRight'=> __('bounceOutRight', 'vikwp_adventures'),
        	'bounceOutUp'	=> __('bounceOutUp', 'vikwp_adventures'),
        	'fadeIn'		=> __('fadeIn', 'vikwp_adventures'),
        	'fadeInDown'	=> __('fadeInDown', 'vikwp_adventures'),
        	'fadeInDownBig'	=> __('fadeInDownBig', 'vikwp_adventures'),
        	'fadeInLeft'	=> __('fadeInLeft', 'vikwp_adventures'),
        	'fadeInLeftBig'	=> __('fadeInLeftBig', 'vikwp_adventures'),
        	'fadeInRight'	=> __('fadeInRight', 'vikwp_adventures'),
        	'fadeInRightBig'=> __('fadeInRightBig', 'vikwp_adventures'),
        	'fadeInUp'		=> __('fadeInUp', 'vikwp_adventures'),
        	'fadeInUpBig'	=> __('fadeInUpBig', 'vikwp_adventures'),
        	'fadeOut'		=> __('fadeOut', 'vikwp_adventures'),
        	'fadeOutDown'	=> __('fadeOutDown', 'vikwp_adventures'),
        	'fadeOutDownBig'=> __('fadeOutDownBig', 'vikwp_adventures'),
        	'fadeOutLeft'	=> __('fadeOutLeft', 'vikwp_adventures'),
        	'fadeOutLeftBig'=> __('fadeOutLeftBig', 'vikwp_adventures'),
        	'fadeOutRight'	=> __('fadeOutRight', 'vikwp_adventures'),
        	'fadeOutRightBig'=> __('fadeOutRightBig', 'vikwp_adventures'),
        	'fadeOutUp'		=> __('fadeOutUp', 'vikwp_adventures'),
        	'fadeOutUpBig'	=> __('fadeOutUpBig', 'vikwp_adventures'),
        	'slideInUp'		=> __('slideInUp', 'vikwp_adventures'),
        	'slideInDown'	=> __('slideInDown', 'vikwp_adventures'),
        	'slideOutUp'	=> __('slideOutUp', 'vikwp_adventures'),
        	'slideOutDown'	=> __('slideOutDown', 'vikwp_adventures'),
        	'slideOutLeft'	=> __('slideOutLeft', 'vikwp_adventures'),
        	'slideOutRight'	=> __('slideOutRight', 'vikwp_adventures')
        )
	));

	//Text Align
	$wp_customize->add_setting('adventures_slider_textalign' , array(
		'default'    => 'center',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_textalign_control', array(
        'settings'	=> 'adventures_slider_textalign',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Choose Text Align','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'center'=> __('Center','vikwp_adventures'),
        	'left'	=> __('Left','vikwp_adventures'),
        	'right'	=> __('Right','vikwp_adventures')
        )
	));

	//Link Read More Destination
	$wp_customize->add_setting('adventures_slider_linktarget' , array(
		'default'    => '_self',
		'transport'  => 'refresh'
	));
	$wp_customize->add_control('adventures_slider_linktarget_ctrl', array(
        'settings'	=> 'adventures_slider_linktarget',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Open Read More link in a new page','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'_blank'	=> __('Yes'),
        	'_self'	=> __('No')
        )
	));

	//Autoplay
	$wp_customize->add_setting( 'adventures_slider_autoplay' , array(
	    'default'		=> __('true', 'vikwp_adventures'),
	    'transport'		=> 'refresh'
	) );
	$wp_customize->add_control( 'adventures_slider_autoplay_ctrl' , array(
		'label'			=> __('Autoplay','vikwp_adventures'),
		'settings'		=> 'adventures_slider_autoplay',
		'section'		=> 'adventures_slider_section',
		'type'      	=> 'select',
		'choices'		=> array(
			'true'		=> 'Yes',
			'false'		=> 'No'
		)
	) );

	//Interval Time
	$wp_customize->add_setting( 'adventures_slider_interval' , array(
	    'default'		=> __(4000, 'vikwp_adventures'),
	    'transport'		=> 'refresh'
	) );
	$wp_customize->add_control( 'adventures_slider_interval_ctrl' , array(
		'label'			=> __('Transition Time (in ms)','vikwp_adventures'),
		'settings'		=> 'adventures_slider_interval',
		'section'		=> 'adventures_slider_section',
		'type'      	=> 'text'
	) );

	//Navigation
	$wp_customize->add_setting('adventures_slider_navigation' , array(
		'default'    => 'yes',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_navigation_control', array(
        'settings'	=> 'adventures_slider_navigation',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Enable Navigation','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
	));

	//Navigation Dots
	$wp_customize->add_setting('adventures_slider_dotsnav' , array(
		'default'    => 'yes',
		'transport'  => 'refresh'
	));

	$wp_customize->add_control('adventures_slider_dotsnav_control', array(
        'settings'	=> 'adventures_slider_dotsnav',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Enable Navigation Dots','vikwp_adventures'),
        'type'      => 'select',
        'choices'	=> array(
        	'yes'	=> __('Yes'),
        	'no'	=> __('No')
        )
	));

	//Set Mask Opacity
	$wp_customize->add_setting('adventures_slider_maskopacity' , array(
		'default'    => 0.6,
		'transport'  => 'refresh'
	));
	$wp_customize->add_control('adventures_slider_maskopacity_control', array(
        'settings'	=> 'adventures_slider_maskopacity',
		'section'	=> 'adventures_slider_section',
        'label'     => __('Mask Opacity','vikwp_adventures'),
        'type'      => 'number',
        'input_attrs'	=> array(
        	'min'	=> 0,
        	'max'	=> 1,
        	'step'	=> 0.1
        )
	));

	/** Class Recommended Plugins - VikWidgetLoader Area Info ***/
	class adventures_recom_plugins extends WP_Customize_Section {
        public $type = 'adventures_recom_plugins';
        public $extra = ''; // we add this for the extra description
        public function json() {
        	$json = parent::json();

        	return $json;
        } 
        public function render_template() { ?>
        <h3 style="padding: 15px 10px; text-align: center; margin: 0; border-left: 2px solid #1388c0; background: #ddd;">Recommended Plugins</h3>
        <div class="vikwp_grey_content">
        	<h3 class="vikwp_grey_content-title">VikWidgetLoader by VikWP</strong></h3>
        	<?php $url = admin_url(); ?>
        	<div class="vikwp_grey_content-desc"><p>
        		This plugin containes all the widgets that you need for this theme.<br />Please, install and activate <strong>VikWidgetLoader</strong> and discover all the widgets in the main Widget Panel of your WordPress.</p>
        		<p style="padding-top: 10px; border-top: 1px solid #ddd;"><a href="<?php echo $url ?>plugin-install.php?s=VikWidgetsLoader&tab=search&type=term" target="_blank" class="activate-now button button-primary">Install and Activate</a></p>
	        </div>
        </div>
     	
        <?php
        }
    }

	/* VikWP Theme Customizer Doc */

	class adventures_customizer_doc extends WP_Customize_Section {
    	public $type = "adventures_customizer_doc";
    	public $doc_url = "";
    	public $doc_text = "";
    	public $doc_link_text = "";
    	public function json() {
			$json = parent::json();

			$json['doc_text'] = $this->doc_text;
			$json['doc_link_text'] = $this->doc_link_text;
			$json['doc_url']  = esc_url( $this->doc_url );

			return $json;
		}
		public function render_template() {?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				<span>{{data.doc_text}}</span> <a class="adventures_customizer_doc_button btn" href="{{data.doc_url}}" target="_blank">{{data.doc_link_text}}</a>
			</h3>
		</li>
		<?php }
	}

	/* Adventures Update info message */

	class adventures_update extends WP_Customize_Section {
    	public $type = "adventures_update";
    	public $update_url = "";
    	public $update_text = "";
    	public $update_link_text = "";
    	public function json() {
			$json = parent::json();

			$json['update_text'] = $this->update_text;
			$json['update_link_text'] = $this->update_link_text;
			$json['update_url']  = esc_url( $this->update_url );

			return $json;
		}
		public function render_template() {?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				<span style="display: block;">{{data.update_text}}</span> <a class="adventures_update_theme_button btn" href="{{data.update_url}}" target="_blank">{{data.update_link_text}}</a>
			</h3>
		</li>
		<?php }
	}

	/* VikWP Theme Test Data */

	class adventures_test_data extends WP_Customize_Section {
    	public $type = "adventures_test_data";
    	public $test_url = "";
    	public $test_text = "";
    	public $test_link_text = "";

    	public function json() {
			$json = parent::json();

			$json['test_text'] = $this->test_text;
			$json['test_link_text'] = $this->test_link_text;
			$json['test_url']  = esc_url( $this->test_url );

			return $json;
		}

		public function render_template() {?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<form method="POST" action="{{data.test_url}}">
				<input type="hidden" name="vikwptestdatainstall" value="1"/>
				<?php wp_nonce_field('e4jadventures.initialize');?>
				<h3 class="accordion-section-title">
					<span>{{data.test_text}}</span>
					<button type="submit" class="adventures_customizer_doc_button btn">{{data.test_link_text}}</button>
				</h3>
			</form>
		</li>
		<?php }
	}

	// Register custom section types.
	$wp_customize->register_section_type( 'adventures_customizer_doc' );
	$wp_customize->register_section_type( 'adventures_test_data' );
	$wp_customize->register_section_type( 'adventures_update' );
	$wp_customize->register_section_type( 'adventures_recom_plugins' );

	function enqueue_control_scripts() {

		wp_register_style('e4j-adventures-customize-controls', trailingslashit( get_template_directory_uri() ) . 'framework/customizer/documentation/customize-controls.css', false,time(),'all');
		wp_enqueue_style('e4j-adventures-customize-controls');

		wp_enqueue_script( 'e4j-adventures-customize-controls', trailingslashit( get_template_directory_uri() ) . 'framework/customizer/documentation/customize-controls.js', array( 'customize-controls' ) );
	}

	// Register scripts and styles for the controls.
	add_action( 'customize_controls_enqueue_scripts', 'enqueue_control_scripts');

	/* End Adventures Customizer Doc */

	$wp_customize->add_section(new adventures_update($wp_customize, 'adventures_update', array(
		'title'    => __('Section Title', 'vikwp_adventures'),
		'update_url'  => 'https://vikwp.com/support/knowledge-base/vikupdater/what-is-vikupdater',
		'update_text' => __('UPDATE INFORMATION: To update the theme, please download and use our VikUpdater plugin.', 'vikwp_adventures'),
		'update_link_text' => __('More information', 'vikwp_adventures'),
		'priority' => 0
	)));

	$wp_customize->add_section(new adventures_customizer_doc($wp_customize, 'adventures_customizer_doc', array(
		'title'    => __('Section Title', 'vikwp_adventures'),
		'doc_url'  => 'https://vikwp.com/support/documentation/theme-adventures-documentation',
		'doc_text' => __('Adventures', 'vikwp_adventures'),
		'doc_link_text' => __('Documentation', 'vikwp_adventures'),
		'priority' => 999
	)));

	if (!get_option('adventures_test_data')) {
		$wp_customize->add_section(new adventures_test_data($wp_customize, 'adventures_test_data', array(
			'title'    => __('Section Title', 'vikwp_adventures'),
			'test_url'  => admin_url('customize.php'),
			'test_text' => __('Install our Sample Data', 'vikwp_adventures'),
			'test_link_text' => __('Install', 'vikwp_adventures'),
			'priority' => 0
		)));
	}

	// VikWidgetLoader Area Info
	
	if(!is_plugin_active('vikwidgetsloader/vikwidgetsloader.php')) {
	    $wp_customize->add_section(new adventures_recom_plugins($wp_customize, 'adventures_plugins', array(
			'title'    => __('Section Title', 'vikwp_adventures'),
			'priority' => 0
		)));
	}

	// Customize Preview 
	function adventures_customize_preview() {
	    wp_enqueue_script('adventures-theme-customizer', get_template_directory_uri() . '/assets/js/theme-customizer.js', array('jquery', 'customize-preview'), '0.3.0', true);	    
	}

	add_action('customize_preview_init', 'adventures_customize_preview');
    
} // end adventures_customize_register
add_action('customize_register', 'adventures_customize_register');

require get_template_directory() . '/framework/customizer/customizer-widget.php';
require get_template_directory() . '/framework/customizer/customizer-header.php';
require get_template_directory() . '/framework/customizer/customizer-settings.php';
require get_template_directory() . '/framework/customizer/customizer-colors.php';
require get_template_directory() . '/framework/customizer/customizer-settings-cookies.php';
require get_template_directory() . '/framework/customizer/customizer-fonts.php';
require get_template_directory() . '/framework/customizer/customizer-developer.php';
require get_template_directory() . '/framework/customizer/customizer-css.php';
